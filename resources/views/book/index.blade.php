@extends('layouts.header')
@section('content')
<a class="ml-3" href="{{ url('/')}}">前へ戻る</a>
<h3 class="text-center">【テーマ】{{ $theme -> theme }}</h3>
<form id='csvform' class="text-right mb-2 mr-4" action="{{ route('book.csv.export') }}" method="POST">
    @csrf
    <input hidden name="theme_id" value ="{{ $theme -> id }}">
    <button type='submit' class="btn btn-success">CSV出力</button>
</form>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="index-tab" data-toggle="tab" href="#index" role="tab" aria-controls="index" aria-selected="true">本をさがす</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="store-tab" data-toggle="tab" href="#store" role="tab" aria-controls="store" aria-selected="false">本を追加する</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="index" role="tabpanel" aria-labelledby="index-tab">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 15%">@sortablelink('name', '筆者')</th>
                <th scope="col" class="text-center" style="width: 50%">@sortablelink('title', 'タイトル')</th>
                <th scope="col" class="text-center" style="width: 10%">@sortablelink('publisher', '出版社')</th>
                <th scope="col" class="text-center" style="width: 8%">@sortablelink('year', '出版年')</th>
                <th scope="col" class="text-center" style="width: 7%">レビュー</th>
                <th scope="col" class="text-center" style="width: 5%">編集</th>
                <th scope="col" class="text-center" style="width: 5%">削除</th>
            </tr>
            </thead>
            @foreach($books as $book)
            <tbody>
            <tr>
                <th scope="row" class="text-center">{{ $book -> name }}</th>
                <td class="text-center">{{ $book -> title }}</td>
                <td class="text-center">{{ $book -> publisher }}</td>
                <td class="text-center">{{ $book -> year }}</td>
                <td class="text-center"> <a href="{{ route('review.index',['themeId' => $theme -> id, 'bookId' =>  $book -> id] ) }}"><i class="far fa-check-circle"></i></a></td>
                <td class="text-center"> <a href="{{ route('book.edit',['themeId' => $theme -> id, 'bookId' =>  $book -> id]) }}"><i class="far fa-edit"></i></a>　</td>
                <td class="text-center"> <a  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="{{ route('book.destroy',['themeId' => $theme -> id, 'bookId' =>  $book -> id]) }}"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            </tbody>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            <p>{{ $books->links() }}</p>
        </div>
    </div>
    <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">
        <form method="POST" action="{{ route('book.store', $theme -> id) }}">
            {{ csrf_field() }}
             <h4 class="text-center mt-2">書誌情報を登録する（全項目入力必須）</h4>
            <form class="row">
              <div class="form-group col-11 mx-auto">
                <label for="author" class="ml-2">筆者</label>
                <input type="text" class="form-control" name="author" placeholder="筆者を入力" required>
                @if($errors->has('author')) <span class="text-danger">{{ $errors->first('author') }}</span> @endif
              </div>
              <div class="form-group col-11 mx-auto">
                <label for="author" class="ml-2">タイトル</label>
                <input type="text" class="form-control" name="title" placeholder="タイトルを入力" required>
                @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
              </div>
              <div class="form-group col-11 mx-auto">
                <label for="publisher" class="ml-2">出版社</label>
                <input type="text" class="form-control" name="publisher" placeholder="出版社を入力" required>
                @if($errors->has('publisher')) <span class="text-danger">{{ $errors->first('publisher') }}</span> @endif
              </div>
              <div class="form-group col-11 mx-auto">
                <label for="year" class="ml-2">出版年</label>
                <input type="number" class="form-control" name="year" placeholder="出版年を入力" required>
                @if($errors->has('year')) <span class="text-danger">{{ $errors->first('year') }}</span> @endif
              </div>
              <button type="submit" class="btn btn-primary mx-auto d-block" name="theme_id"value ="{{ $theme -> id }}">登録する</button>
        </form>
      </div>
</div>
@endsection
