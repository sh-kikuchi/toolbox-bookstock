<?php

namespace app\Http\Controllers;

use App\Models\Theme;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\BooksExport;
use \App\Http\Requests\BookRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /*ユーザーのすべてのブックリストを出力 */
    public function all()
    {
        /* 何かしらテーマが存在する本 = すべての本 */
         $books = Book::whereHas('themes', function($query){
            $query->where('user_id', '=', Auth::id());
        })->sortable()->paginate(10);

         return view('book.all',compact('books'));
    }

    public function index($themeId)
    {
        /*テーマ */
        $theme  = Theme::where('id',$themeId)->first();
        /*テーマ毎のブック一覧 */
        $books = Theme::find($themeId)->books()->sortable()->paginate(10);
        return view('book.index',compact('theme','books'));
    }

    public function store(BookRequest $request)
    {
        $book = new Book;
        $book -> user_id    = Auth::id();
        $book -> name       = $request -> author;
        $book -> title      = $request -> title;
        $book -> publisher  = $request -> publisher;
        $book -> year       = $request -> year;
        $book -> save();

        /*中間テーブルの追加処理*/
        $themeId = $request -> theme_id;
        $book->themes()->attach($themeId);

        /*テーマ */
        $theme = Theme::find($themeId)->first();

        return redirect()->route('book.index',$themeId);
    }

    public function edit($themeId,$bookId)
    {
        $book = Book::where('id',$bookId)->first();
        $themes = Theme::whereNotIn('id',[$themeId])->where('user_id', '=', Auth::id())->get();
        return view('book.edit',compact('themeId','themes','book'));
    }

    public function update(BookRequest $request)
    {
        $themeId            = $request -> theme_id;
        $book = Book::find($request -> book_id);
        $book -> name       = $request -> author;
        $book -> title      = $request -> title;
        $book -> publisher  = $request -> publisher;
        $book -> year       = $request -> year;

       #テーマ選択の入力がある場合
        if( $request->theme_select !== ""){
            /*中間テーブルの追加処理*/
            $themeSelect = $request -> theme_select;
            $book->themes()->attach($themeSelect);
        }

        $book -> save();
        return redirect()->route('book.index',$themeId);
    }

    public function destroy($themeId,$bookId)
    {
        $book = Book::find($bookId);

        if(Book::has('themes', '>=', 2)->where('id',$bookId)->exists()){
            //テーマを複数持っている場合、本自体の削除はおこなわない
            Review::where('theme_id', $themeId)
                ->where('book_id', $bookId)
                -> delete();
        }else{
            $book->delete();
        }

        /*中間テーブルの削除処理 */
        $book->themes()->detach($themeId);

       return redirect()->route('book.index',$themeId);
    }

    public function csvExport(Request $request) {
            $theme_id = $request->theme_id;

            $response = new StreamedResponse(function () use ($request, $theme_id) {
                $stream = fopen('php://output','w');
                // 文字化け回避
                stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

                // ここでは仮に「products」というテーブルの全データを取得
                $results  = Theme::find($theme_id)->books()->get();

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
            $response->headers->set('content-disposition', 'attachment; filename=ブックリスト.csv');

            return $response;
        }

        public function _csvRow($row){
            return [
                $row->name,
                '『'.$row->title.'』',
                $row->publisher,
                $row->year
            ];
        }

        public function _csvHeader(){
            return [
                '著者名',
                'タイトル',
                '出版社',
                '出版年'
            ];
        }
}
