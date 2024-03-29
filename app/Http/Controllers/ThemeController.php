<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\ThemeRequest;

class ThemeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::where('user_id',Auth::id()) -> get();
        return view('theme.index',compact('themes'));
    }

    public function store(ThemeRequest $request)
    {
        $theme = new theme;
        $theme -> user_id = Auth::id();
        $theme -> theme  = $request -> theme_name;
        $theme -> save();
        return redirect('/');
    }

    public function edit($themeId)
    {
        $theme = Theme::where('id',$themeId)
        ->first();
        return view('theme.edit',compact('theme'));
    }

    public function update(ThemeRequest $request)
    {
        $theme = Theme::find($request -> theme_id);
        $theme -> theme  = $request -> theme_name;
        $theme -> save();
        return redirect('/');
    }

    public function destroy($themeId)
    {
        $theme = Theme::find($themeId);
        $theme->delete();
        return redirect('/');
    }
}
