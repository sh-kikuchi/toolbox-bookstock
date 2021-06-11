<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use \App\Exports\ReviewsExport;
use \App\Http\Requests\ReviewRequest;

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
        $reviews = Review::where('book_id', $bookId)-> paginate(10);
        return view('review.all',compact('book','reviews'));
    }

    public function index($themeId,$bookId)
    {
        /*書誌情報 */
        $book = Book::where('id',$bookId)->first();
        /*レビュー一覧 */
        $reviews = Review::where('theme_id', $themeId)->where('book_id', $bookId)-> paginate(10);
        return view('review.index',compact('book','reviews','themeId','bookId'));
    }

    public function store(Request $request)
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

    public function update(Request $request)
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

    /* EXCEL出力 */
    public function export(){
	    return Excel::download(new ReviewsExport, 'reviews.xlsx');
    }
}
