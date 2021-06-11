<?php

namespace app\Http\Controllers;

use App\Models\Theme;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;
use \App\Http\Requests\BookRequest;

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

    public function store(Request $request)
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
        $themes = Theme::whereNotIn('id',[$themeId])->get();
        return view('book.edit',compact('themeId','themes','book'));
    }

    public function update(Request $request)
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
        $book->delete();

        /*中間テーブルの削除処理 */
        $book->themes()->detach($themeId);
       return redirect()->route('book.index',$themeId);
    }

    /* EXCEL出力 */
    public function export(){
	    return Excel::download(new BooksExport, 'books.xlsx');
    }

    /* EXCEL出力 */
    public function export_r(){
	    return Excel::download(new ReviewsExport, 'reviews.xlsx');
    }

}
