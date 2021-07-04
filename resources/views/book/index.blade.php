@extends('layouts.header')
@section('content')
<h3>【テーマ】{{ $theme -> theme }}</h3>
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
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 15%">@sortablelink('name', '筆者')</th>
                <th scope="col" class="text-center" style="width: 50%">@sortablelink('title', 'タイトル')</th>
                <th scope="col" class="text-center" style="width: 10%">@sortablelink('publisher', '出版社')</th>
                <th scope="col" class="text-center" style="width: 10%">@sortablelink('year', '出版年')</th>
                <th scope="col" class="text-center" style="width: 5%">レビュー</th>
                <th scope="col" class="text-center" style="width: 5%">編集</th>
                <th scope="col" class="text-center" style="width: 5%">削除</th>
            </tr>
            </thead>
            @foreach($books as $book)
            <tbody>
            <tr>
                <th scope="row">{{ $book -> name }}</th>
                <td>{{ $book -> title }}</td>
                <td>{{ $book -> publisher }}</td>
                <td>{{ $book -> year }}</td>
                <td class="text-center"> <a href="{{ route('review.index',['theme' => $theme->id, 'book' => $book->id] ) }}"><i class="far fa-check-circle"></i></a></td>
                <td class="text-center"> <a href="{{ route('book.edit',['theme' => $theme -> id, 'book' => $book->id]) }}"><i class="far fa-edit"></i></a>　</td>
                <td class="text-center"> <a  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="{{ route('book.destroy',['theme' => $theme->id, 'book' => $book->id]) }}"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            </tbody>
            @endforeach
        </table>
        <p class="text-center">{{ $books->links() }}</p>
    </div>
    <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">
        <form method="POST" action="{{ route('book.store', $theme->id) }}">
            {{ csrf_field() }}
             <h4 class="text-center">書誌情報を登録する（全項目入力必須）</h4>
            <form>
              <div class="form-group">
                <label for="author">筆者</label>
                <input type="text" class="form-control text-center" name="author" placeholder="筆者を入力" required>
                @if($errors->has('author')) <span class="text-danger">{{ $errors->first('author') }}</span> @endif
              </div>
              <div class="form-group">
                <label for="author">タイトル</label>
                <input type="text" class="form-control text-center" name="title" placeholder="タイトルを入力" required>
                @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
              </div>
              <div class="form-group">
                <label for="publisher">出版社</label>
                <input type="text" class="form-control text-center" name="publisher" placeholder="出版社を入力" required>
                @if($errors->has('publisher')) <span class="text-danger">{{ $errors->first('publisher') }}</span> @endif
              </div>
              <div class="form-group">
                <label for="year">出版年</label>
                <input type="number" class="form-control text-center" name="year" placeholder="出版年を入力" required>
                @if($errors->has('year')) <span class="text-danger">{{ $errors->first('year') }}</span> @endif
              </div>
              <button type="submit" class="btn btn-primary" name="theme_id"value ="{{ $theme -> id }}">Submit</button>
        </form>
      </div>
</div>
@endsection
