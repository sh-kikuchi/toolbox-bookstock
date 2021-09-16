@extends('layouts.header')
@section('content')
    <h3 class="text-center">レビューを更新します</h3>
    <form method="POST" class="row d-block mr-0" action="{{ route('review.update') }}">
        {{ csrf_field() }}
          <!-- ブックIDを格納しておく -->
<<<<<<< HEAD
          <div class="form-group">
           <input hidden type="number" class="form-control" name="theme_id" value="{{$theme->id}}" required>
          </div>
          <div class="form-group">
           <input hidden type="number" class="form-control" name="book_id" value="{{$book->id}}" required>
=======
          <div class="form-group col-11 mx-auto">
           <input hidden type="number" class="form-control" name="theme_id" value="{{$themeId}}" required>
          </div>
          <div class="form-group col-11 mx-auto">
           <input hidden type="number" class="form-control" name="book_id" value="{{$bookId}}" required>
>>>>>>> e6e78b6680ac78dcb93280d7433a905c730b9c8e
          </div>
          <div class="form-group col-11 mx-auto">
            <label for="category">カテゴリー</label>
            <select class="form-control" name="category">
                <option value="要約">要約（間接引用含む）</option>
                <option value="直接引用">直接引用（元の文章をそのまま引用）</option>
            </select>
          </div>
          <div class="form-group col-11 mx-auto">
            <label for="s_page">開始頁</label>
            <input type="number" class="form-control" name="s_page" value="{{$review -> s_page}}" required>
            @if($errors->has('s_page')) <span class="text-danger">{{ $errors->first('s_page') }}</span> @endif
          </div>
          <div class="form-group col-11 mx-auto">
            <label for="e_page">修了頁</label>
            <input type="number" class="form-control" name="e_page" value="{{$review -> e_page}}" required>
            @if($errors->has('e_page')) <span class="text-danger">{{ $errors->first('e_page') }}</span> @endif
          </div>
          <div class="form-group col-11 mx-auto">
            <label for="publisher">レビュー</label>
            <input type="text" class="form-control" name="review" value="{{$review -> review}}" required>
            @if($errors->has('review')) <span class="text-danger">{{ $errors->first('review') }}</span> @endif
          </div>
          <button type="submit" class="btn btn-primary mx-auto d-block" name="review_id" value="{{$review -> id}}" >更新</button>
    </form>
@endsection
