@extends('layouts.header')
@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="index-tab" data-toggle="tab" href="#index" role="tab" aria-controls="index" aria-selected="true">テーマをさがす</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="store-tab" data-toggle="tab" href="#store" role="tab" aria-controls="store" aria-selected="false">テーマをつくる</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="index" role="tabpanel" aria-labelledby="index-tab">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 76%">テーマ</th>
                <th scope="col" class="text-center" style="width: 8%">選択</th>
                <th scope="col" class="text-center" style="width: 8%">編集</th>
                <th scope="col" class="text-center" style="width: 8%">削除</th>
            </tr>
            </thead>
            @foreach($themes as $theme)
            <tbody>
            <tr>
                <th scope="row">{{ $theme -> theme }}</th>
                <td class="text-center"> <a href="{{ route('book.index', $theme->id ) }}"><i class="far fa-check-circle"></i></a></td>
                <td class="text-center"> <a href="{{ route('theme.edit', $theme->id ) }}"><i class="far fa-edit"></i></a></td>
                <td class="text-center"><a  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="{{ route('theme.destroy', $theme->id ) }}"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">
        <form method="POST" action="{{ route('theme.store') }}">
            {{ csrf_field() }}
            <h3 class="text-center mt-2">テーマをつくりましょう。</h3>
            <div class="form-group d-flex justify-content-center">
                <input class="form-control col-8 col-sm-10 ml-2 " type="text" name = "theme_name" placeholder="50字以内" maxlength="50" required>
                @if($errors->has('theme_name')) <span class="text-danger">{{ $errors->first('theme_name') }}</span> @endif
                <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
            </div>
        </form>
      </div>
</div>
@endsection
