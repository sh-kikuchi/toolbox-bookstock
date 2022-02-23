@extends('layouts.header')
@section('content')
<h4 class="text-center">【タイトル】{{ $book -> title }}</h4>
<form id='csvform' class="text-right mb-2 mr-4" action="{{ route('review.csv.export') }}" method="POST">
    @csrf
    <input hidden name="theme_id" value ="{{ $themeId }}">
    <input hidden name="book_id" value ="{{ $book -> id }}">
    <input hidden name="book_title" value ="{{ $book -> title }}">
    <button type='submit' class="btn btn-success">CSV出力</button>
</form>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="index-tab" data-toggle="tab" href="#index" role="tab" aria-controls="index" aria-selected="true">レビューをさがす</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="store-tab" data-toggle="tab" href="#store" role="tab" aria-controls="store" aria-selected="false">レビューを登録する</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="index" role="tabpanel" aria-labelledby="index-tab">
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-center" style="width: 10%">カテゴリー</th>
              <th scope="col" class="text-center" style="width: 56%">レビュー</th>
              <th scope="col" class="text-center" style="width: 7%">開始頁</th>
              <th scope="col" class="text-center" style="width: 7%">終了頁</th>
              <th scope="col" class="text-center" style="width: 5%">更新</th>
              <th scope="col" class="text-center" style="width: 5%">削除</th>
              <th scope="col" class="text-center" style="width: 10%">更新日</th>
            </tr>
          </thead>
          @foreach($reviews as $review)
          <tbody>
            <tr>
              <th scope="row">{{ $review -> category}}</th>
              <td>{{ $review -> review}}</td>
              <td class="text-center">{{ $review -> s_page}}</td>
              <td class="text-center">{{ $review -> e_page}}</td>
              <td class="text-center"> <a href="{{ route('review.edit',['themeId' => $themeId,'bookId' => $book -> id, 'reviewId' =>  $review -> id] ) }}"><i class="far fa-edit"></i></a></td>
              <td class="text-center"><a  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="{{ route('review.destroy', ['themeId' => $themeId,'bookId' => $book -> id, 'reviewId' =>  $review -> id] ) }}"><i class="far fa-trash-alt"></i></a></td>
              <td class="text-center">{{ $review -> updated_at}}</td>
            </tr>
          </tbody>
          @endforeach
        </table>
        <p class="text-center">{{ $reviews->links() }}</p>
    </div>
    <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">
        <form method="POST" class="row d-block"action="{{ route('review.store',['themeId' => $themeId,'bookId' => $book -> id]) }}">
            {{ csrf_field() }}
              <div class="form-group col-11 mx-auto">
                <input hidden type="number" class="form-control" name="theme_id" value="{{ $themeId }}">
              </div>
              <div class="form-group col-11 mx-auto">
                <label for="category">カテゴリー</label>
                <select class="form-control" name="category">
                    <option value="要約">要約（間接引用含む）</option>
                    <option value="直接引用">直接引用（元の文章をそのまま引用）</option>
                </select>
              </div>
              <div class="form-group col-11 mx-auto">
                <label for="publisher">レビュー</label>
                <textarea class="form-control text-center" name="review" placeholder="レビュー"  row="3" required></textarea>
                @if($errors->has('review')) <span class="text-danger">{{ $errors->first('review') }}</span> @endif
              </div>
              <div class="form-group col-11 mx-auto">
                <label for="s_page">開始頁</label>
                <input type="number" class="form-control text-center" name="s_page" placeholder="開始頁" required>
                @if($errors->has('s_page')) <span class="text-danger">{{ $errors->first('s_page') }}</span> @endif
              </div>
              <div class="form-group col-11 mx-auto">
                <label for="e_page">修了頁</label>
                <input type="number" class="form-control text-center" name="e_page" placeholder="修了頁" required>
                @if($errors->has('e_page')) <span class="text-danger">{{ $errors->first('e_page') }}</span> @endif
              </div>
              <button type="submit" class="btn btn-primary mx-auto d-block" name ="book_id" value="{{ $book -> id }}">登録する</button>
        </form>
      </div>
</div>
@endsection
