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

    public function all(Book $book)
    {
        /*書誌情報 */
        $book = Book::where('id',$book->id)->first();
        /*レビュー一覧 */
        $reviews = Review::where('book_id', $bookId)
            ->orderBy('s_page')
            -> paginate(10);
        return view('review.all',compact('book','reviews'));
    }

    public function index(Theme $theme ,Book $book)
    {
        /*書誌情報 */
        $book = Book::where('id',$book->id)->first();
        /*レビュー一覧 */
        $reviews = Review::where('theme_id', $themeId)
            ->where('book_id', $bookId)
            ->orderBy('s_page')
            -> paginate(10);

        return view('review.index',compact('book','reviews','themeId','bookId'));
    }

    public function store(Request $request)
    {
        $theme  = $request -> theme_id;
        $book   = $request  -> book_id;

        $review = new Review;
        $review -> user_id     = Auth::id();
        $review -> book_id   = $book;
        $review -> theme_id  = $theme;
        $review -> category  = $request -> category;
        $review -> review    = $request -> review;
        $review -> s_page    = $request -> s_page;
        $review -> e_page    = $request -> e_page;
        $review -> save();

        return redirect()->route('review.index', ['theme' => $theme,'book'=>$book]);
    }

    public function edit(Theme $theme, Book $book , Review $review)
    {
        $review = Review::where('id',$review->id)->first();
        return view('review.edit',compact('theme','book','review'));
    }

    public function update(Request $request)
    {
        $theme =   Theme::find($request -> theme_id);
        $book  =   Book::find($request -> book_id);

        $review =  Review::find($request -> review_id);
        $review -> category = $request -> category;
        $review -> review  = $request -> review;
        $review -> s_page  = $request -> s_page;
        $review -> e_page  = $request -> e_page;
        $review -> save();
        return redirect()->route('review.index', ['theme' => $theme,'book'=>$book]);
    }

    public function destroy(Theme $theme, Book $book,Review $review)
    {
        $this->authorize('destroy',$review);
        $review = Review::find($review->id);
        $review->delete();
        return redirect()->route('review.index', ['theme' => $theme->id,'book'=>$book->id]);
    }

    /* EXCEL出力 */
    public function export(){
	    return Excel::download(new ReviewsExport, 'reviews.xlsx');
    }
}
