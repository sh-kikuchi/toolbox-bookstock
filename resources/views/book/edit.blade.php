@extends('layouts.header')
@section('content')
    <h3 class="text-center mb-0">書誌情報を更新する（※＝入力必須）</h3>
    <form method="POST" action="{{ route('book.update') }}" class="row d-block mr-0">
        {{ csrf_field() }}
        <!-- テーマIDを格納しておく -->
<<<<<<< HEAD
        <div class="form-group">
          <input hidden type="number" class="form-control" name="theme_id" value="{{$theme->id}}" required>
=======
        <div class="form-group col-11 mx-auto">
          <input hidden type="number" class="form-control" name="theme_id" value="{{$themeId}}" required>
>>>>>>> e6e78b6680ac78dcb93280d7433a905c730b9c8e
        </div>
        <div class="form-group col-11 mx-auto">
          <label for="author">筆者（※）</label>
          <input type="text" class="form-control" name="author" value="{{$book->name}}" required>
          @if($errors->has('author')) <span class="text-danger">{{ $errors->first('author') }}</span> @endif
        </div>
        <div class="form-group col-11 mx-auto">
          <label for="author">タイトル（※）</label>
          <input type="text" class="form-control" name="title" value="{{$book->title}}" required>
          @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
        </div>
        <div class="form-group col-11 mx-auto">
          <label for="publisher">出版社（※）</label>
          <input type="text" class="form-control" name="publisher" value="{{$book->publisher}}" required>
          @if($errors->has('publisher')) <span class="text-danger">{{ $errors->first('publisher') }}</span> @endif
        </div>
        <div class="form-group col-11 mx-auto">
          <label for="year">出版年（※）</label>
          <input type="number" class="form-control" name="year" value="{{$book->year}}" required>
          @if($errors->has('year')) <span class="text-danger">{{ $errors->first('year') }}</span> @endif
        </div>
        <div class="form-group col-11 mx-auto">
            <label for="exampleFormControlSelect1">他のテーマにもこの本を追加する（任意）</label>
            <select class="form-control" id="exampleFormControlSelect1" name="theme_select">
              <option value="">選択してください</option>
               @foreach($themes as $themeList)
              <option value="{{$themeList -> id}}">{{$themeList -> theme}}</option>
               @endforeach
            </select>
        </div>
<<<<<<< HEAD
        <button type="submit" class="btn btn-primary" name="book_id" value ="{{$book->id }}">Submit</button>
=======
        <button type="submit" class="btn btn-primary mx-auto d-block" name="book_id" value ="{{$book -> id }}">更新する</button>
>>>>>>> e6e78b6680ac78dcb93280d7433a905c730b9c8e
    </form>
@endsection
