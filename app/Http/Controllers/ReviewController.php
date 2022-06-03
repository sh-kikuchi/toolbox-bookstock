<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Exports\ReviewsExport;
use \App\Http\Requests\ReviewRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;
use \SplFileObject;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function all($bookId)
    {
        /*書誌情報 */
        $book = Book::where('id',$bookId)->first();
        /*レビュー一覧 */
        $reviews = Review::where('book_id', $bookId)
            ->orderBy('s_page')
            -> paginate(10);
        return view('review.all',compact('book','reviews'));
    }

    public function index($themeId,$bookId)
    {
        /*書誌情報 */
        $book = Book::where('id',$bookId)->first();
        /*レビュー一覧 */
        $reviews = Review::where('theme_id', $themeId)
            ->where('book_id', $bookId)
            ->orderBy('s_page')
            -> paginate(10);

        return view('review.index',compact('book','reviews','themeId','bookId'));
    }

    public function store(ReviewRequest $request)
    {
        $themeId  = $request -> theme_id;
        $bookId   = $request  -> book_id;

        $review = new Review;
        $review -> book_id   = $bookId;
        $review -> theme_id  = $themeId;
        $review -> category  = $request -> category;
        $review -> review    = $request -> review;
        $review -> s_page    = $request -> s_page;
        $review -> e_page    = $request -> e_page;
        $review -> save();

        return redirect()->route('review.index', ['themeId' => $themeId,'bookId'=>$bookId]);
    }

    public function edit($themeId,$bookId,$reviewId)
    {
        $review = Review::where('id',$reviewId)->first();
        return view('review.edit',compact('themeId','bookId','review'));
    }

    public function update(ReviewRequest $request)
    {
        $themeId           = $request -> theme_id;
        $bookId            = $request -> book_id;
        $review =  Review::find($request -> review_id);
        $review -> category = $request -> category;
        $review -> review  = $request -> review;
        $review -> s_page  = $request -> s_page;
        $review -> e_page  = $request -> e_page;
        $review -> save();
        //  return view('review.index',compact('themeId','bookId'));
         return redirect()->route('review.index', ['themeId' => $themeId,'bookId'=>$bookId]);
    }

    public function destroy($themeId,$bookId,$reviewId)
    {
        $review = Review::find($reviewId);
        $review->delete();
         return redirect()->route('review.index', ['themeId' => $themeId,'bookId'=>$bookId]);
    }

    public function csvExport(Request $request) {
            $theme_id = $request->theme_id;
            $book_id = $request->book_id;

            $response = new StreamedResponse(function () use ($request, $theme_id, $book_id) {
                $stream = fopen('php://output','w');
                // 文字化け回避
                stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

                // SQL
                $results  = Review::where('theme_id', $theme_id)->where('book_id', $book_id)->get();

                fputcsv($stream, $this->_csvHeader());

                if (empty($results[0])) {
                        fputcsv($stream, [
                            'データが存在しませんでした。',
                        ]);
                } else {
                    foreach ($results as $row) {
                        fputcsv($stream, $this->_csvRow($row));
                    }
                }
                fclose($stream);
            });
            $response->headers->set('Content-Type', 'application/octet-stream');
            $response->headers->set('content-disposition', 'attachment; filename='.$request->book_title.'レビュー.csv');

            return $response;
        }

        public function _csvRow($row){
            return [
                $row->category,
                $row->review,
                $row->s_page,
                $row->e_page
            ];
        }

        public function _csvHeader(){
            return [
                '要約/引用',
                'レビュー',
                '開始頁',
                '終了頁'
            ];
        }

    public function csvImport(Request $request){
        $themeId           = $request -> theme_id;
        $bookId            = $request -> book_id;
        $array= [];
        $csvimport_array = [];

        setlocale(LC_ALL, 'ja_JP.UTF-8');

        // アップロードファイル取得[file(name属性)]
        $uploaded_file = $request->file('csv_file');

        if($uploaded_file===null){
            return redirect()->route('review.index', ['themeId' => $themeId,'bookId'=>$bookId]);
        }

        // アップロードファイルのパス取得
        $file_path = $request->file('csv_file')->path($uploaded_file);

        //SplFileObjectを生成(CSV読み込み)
        $file = new SplFileObject($file_path);
        $file->setFlags(SplFileObject::READ_CSV);

        //行カウント番号
        $row_count = 1;

        //取得したオブジェクトを読み込み
        foreach ($file as $row)
        {
            // 最終行の処理(最終行が空っぽの場合の対策
            if ($row === [null]) continue;

            // 1行目のヘッダーは取り込まない
            if ($row_count > 1)
            {
                // CSVの文字コードがSJISなのでUTF-8に変更
                $category = mb_convert_encoding($row[0], 'UTF-8', 'SJIS');
                $review   = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');
                $s_page   = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');
                $e_page   = mb_convert_encoding($row[3], 'UTF-8', 'SJIS');

                $csvimport_array = [
                    'theme_id' =>  $themeId,
                    'book_id' =>  $bookId,
                    'category' => $category,
                    'review' => $review,
                    's_page' => $s_page,
                    'e_page' => $e_page
                ];

                array_push($array, $csvimport_array);
            }
            $row_count++;
        }

        //追加した配列の数を数える
        $array_count = count($array);

        //100ずつに分割
        $array_partial = array_chunk($array, 100); //配列分割
        $array_partial_count = count($array_partial); //配列の数

        for ($i = 0; $i <= $array_partial_count - 1; $i++){

            Review::insert($array_partial[$i]);
        }

        return redirect()->route('review.index', ['themeId' => $themeId,'bookId'=>$bookId]);
    }
}
