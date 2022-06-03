@extends('layouts.header')
@section('content')
<div class="create-theme-form">
    <form method="POST" action="{{ route('theme.store') }}">
        {{ csrf_field() }}
        <h3 class="text-center mt-2">テーマをつくりましょう。</h3>
        <div class="form-group d-flex justify-content-center">
            <input class="form-control col-6 ml-2 " type="text" name = "theme_name" placeholder="50字以内" maxlength="50" required>
            @if($errors->has('theme_name')) <span class="text-danger">{{ $errors->first('theme_name') }}</span> @endif
            <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
        </div>
    </form>
</div>
<div class="theme-table p-3">
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="text-center" style="width: 75%">テーマ</th>
            <th scope="col" class="text-center" style="width: 5%">選択</th>
            <th scope="col" class="text-center" style="width: 5%">編集</th>
            <th scope="col" class="text-center" style="width: 5%">削除</th>
        </tr>
        </thead>
        @foreach($themes as $theme)
        <tbody>
        <tr>
            <th scope="row">{{ $theme -> theme }}</th>
            <td class="text-center"> <a href="{{ route('book.index', $theme -> id ) }}"><i class="far fa-check-circle"></i></a></td>
            <td class="text-center"> <a href="{{ route('theme.edit', $theme -> id ) }}"><i class="far fa-edit"></i></a></td>
            <td class="text-center"><a  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="{{ route('theme.destroy', $theme -> id ) }}"><i class="far fa-trash-alt"></i></a></td>
        </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection
