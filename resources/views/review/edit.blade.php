@extends('layouts.header')
@section('content')
    <form method="POST" action="{{ route('review.update') }}">
        {{ csrf_field() }}
          <h2>レビューを更新</h2>
          <!-- ブックIDを格納しておく -->
          <div class="form-group">
           <input hidden type="number" class="form-control" name="theme_id" value="{{$theme->id}}" required>
          </div>
          <div class="form-group">
           <input hidden type="number" class="form-control" name="book_id" value="{{$book->id}}" required>
          </div>
          <div class="form-group">
            <label for="category">カテゴリー</label>
            <select class="form-control" name="category">
                <option value="summary">要約（間接引用含む）</option>
                <option value="quote">直接引用（元の文章をそのまま引用）</option>
            </select>
          </div>
          <div class="form-group">
            <label for="s_page">開始頁</label>
            <input type="number" class="form-control" name="s_page" value="{{$review -> s_page}}" required>
            @if($errors->has('s_page')) <span class="text-danger">{{ $errors->first('s_page') }}</span> @endif
          </div>
          <div class="form-group">
            <label for="e_page">修了頁</label>
            <input type="number" class="form-control" name="e_page" value="{{$review -> e_page}}" required>
            @if($errors->has('e_page')) <span class="text-danger">{{ $errors->first('e_page') }}</span> @endif
          </div>
          <div class="form-group">
            <label for="publisher">レビュー</label>
            <input type="text" class="form-control" name="review" value="{{$review -> review}}" required>
            @if($errors->has('review')) <span class="text-danger">{{ $errors->first('review') }}</span> @endif
          </div>
          <button type="submit" class="btn btn-primary" name="review_id" value="{{$review -> id}}" >Submit</button>
    </form>
@endsection
