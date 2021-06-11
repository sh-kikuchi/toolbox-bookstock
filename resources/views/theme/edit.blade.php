@extends('layouts.header')
@section('content')
<form method="POST" action="{{ route('theme.update') }}">
    {{ csrf_field() }}
      <h2>テーマを更新することができます</h2>
    <div class="form-group row">
        <input class="form-control col-8 col-sm-10 ml-3 " type="text" name = "theme_name" value="{{ $theme -> theme}}" maxlength="50" required>
        <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2" name ="theme_id" value="{{ $theme -> id}}"><i class="far fa-paper-plane"></i></button>
    </div>
</form>
@endsection
