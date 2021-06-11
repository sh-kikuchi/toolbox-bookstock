@extends('layouts.header')
@section('content')
    <form method="POST" action="{{ route('book.update') }}">
        {{ csrf_field() }}
        <h2>書誌情報を更新する</h2>
        <h2>※下記のフォームを入力して下さい（※＝入力必須）</h2>
        <!-- テーマIDを格納しておく -->
        <div class="form-group">
          <input hidden type="number" class="form-control" name="theme_id" value="{{$themeId}}" required>
        </div>
        <div class="form-group">
          <label for="author">筆者（※）</label>
          <input type="text" class="form-control" name="author" value="{{$book -> name}}" required>
          @if($errors->has('author')) <span class="text-danger">{{ $errors->first('author') }}</span> @endif
        </div>
        <div class="form-group">
          <label for="author">タイトル（※）</label>
          <input type="text" class="form-control" name="title" value="{{$book -> title}}" required>
          @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
        </div>
        <div class="form-group">
          <label for="publisher">出版社（※）</label>
          <input type="text" class="form-control" name="publisher" value="{{$book -> publisher}}" required>
          @if($errors->has('publisher')) <span class="text-danger">{{ $errors->first('publisher') }}</span> @endif
        </div>
        <div class="form-group">
          <label for="year">出版年（※）</label>
          <input type="number" class="form-control" name="year" value="{{$book -> year}}" required>
          @if($errors->has('year')) <span class="text-danger">{{ $errors->first('year') }}</span> @endif
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">他のテーマにもこの本を追加する（任意）</label>
            <select class="form-control" id="exampleFormControlSelect1" name="theme_select">
              <option value="">選択してください</option>
               @foreach($themes as $themeList)
              <option value="{{$themeList -> id}}">{{$themeList -> theme}}</option>
               @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="book_id" value ="{{$book -> id }}">Submit</button>
    </form>
@endsection
