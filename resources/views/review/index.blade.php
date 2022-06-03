@extends('layouts.header')
@section('content')
 <a class="ml-3" href="{{ url('/book/index', $themeId) }}">前へ戻る</a>
<h4 class="text-center">【タイトル】{{ $book -> title }}</h4>
<div class="csv-area ">
    <!-- CSVエクスポート -->
    <form id='csvform' class="text-right mb-2 mr-4" action="{{ route('review.csv.export') }}" method="POST">
        @csrf
        <input hidden name="theme_id" value ="{{ $themeId }}">
        <input hidden name="book_id" value ="{{ $book -> id }}">
        <input hidden name="book_title" value ="{{ $book -> title }}">
        <button type='submit' class="btn btn-success">CSVエクスポート</button>
    </form>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="index-tab" data-toggle="tab" href="#index" role="tab" aria-controls="index" aria-selected="true">レビューをさがす</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="store-tab" data-toggle="tab" href="#store" role="tab" aria-controls="store" aria-selected="false">レビューを登録する</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="csv-tab" data-toggle="tab" href="#csv" role="tab" aria-controls="csv" aria-selected="false">CSVアップロード</a>
    </li>
</ul>
<div class="tab-content p-3" id="myTabContent">
    <div class="tab-pane fade show active" id="index" role="tabpanel" aria-labelledby="index-tab">
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-center" style="width: 10%">分類</th>
              <th scope="col" class="text-center" style="width: 50%">レビュー</th>
              <th scope="col" class="text-center" style="width: 10%">開始頁</th>
              <th scope="col" class="text-center" style="width: 10%">終了頁</th>
              <th scope="col" class="text-center" style="width: 10%">更新</th>
              <th scope="col" class="text-center" style="width: 10%">削除</th>
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
            </tr>
          </tbody>
          @endforeach
        </table>
        <div class="d-flex justify-content-center">
          <p >{{ $reviews->links() }}</p>
        </div>
    </div>
    <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">
        <form method="POST" class="row d-block"action="{{ route('review.store',['themeId' => $themeId,'bookId' => $book -> id]) }}">
            {{ csrf_field() }}
              <div class="form-group col-11 mx-auto">
                <input hidden type="number" class="form-control" name="theme_id" value="{{ $themeId }}">
              </div>
              <div class="form-group col-6 mx-auto">
                <label for="category">カテゴリー</label>
                <select class="form-control" name="category">
                    <option value="要約">要約（間接引用含む）</option>
                    <option value="直接引用">直接引用（元の文章をそのまま引用）</option>
                </select>
              </div>
              <div class="form-group col-6 mx-auto">
                <label for="publisher">レビュー</label>
                <textarea class="form-control text-center" name="review" placeholder="レビュー"  row="3" required></textarea>
                @if($errors->has('review')) <span class="text-danger">{{ $errors->first('review') }}</span> @endif
              </div>
              <div class="d-flex justify-content-center">
                  <div class="form-group">
                    <label for="s_page">開始頁</label>
                    <input type="text" class="form-control text-center" name="s_page" placeholder="開始頁" pattern="^[1-9][0-9]*$" title="0以上の数字を入力してください。" required>
                    @if($errors->has('s_page')) <span class="text-danger">{{ $errors->first('s_page') }}</span> @endif
                  </div>
                  <div class="form-group  ml-2">
                    <label for="e_page">修了頁</label>
                  <input type="text" class="form-control text-center" name="e_page" placeholder="修了頁"pattern="^[1-9][0-9]*$" title="0以上の数字を入力してください。"  required>
                    @if($errors->has('e_page')) <span class="text-danger">{{ $errors->first('e_page') }}</span> @endif
                  </div>
              </div>
              <button type="submit" class="btn btn-primary mx-auto d-block" name ="book_id" value="{{ $book -> id }}">登録する</button>
        </form>
      </div>
    <div class="tab-pane fade" id="csv" role="tabpanel" aria-labelledby="csv-tab">
        <h3>CSVインポート</h3>
        <p>CSVエクスポートで出力されるCSVと同じ形式でファイルを作成して下さい。</p>
        <form role="form" method="post" action="{{ route('review.csv.import') }}" enctype="multipart/form-data">
            @csrf
            <input hidden name="theme_id" value ="{{ $themeId }}">
            <input hidden name="book_id" value ="{{ $book -> id }}">
            <div class="d-flex mt-3 mb-3">
                <input type="file" name="csv_file" id="csv_file">
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-default btn-success">CSVインポート</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
