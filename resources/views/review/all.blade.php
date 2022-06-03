@extends('layouts.header')
@section('content')
<div class="p-3">
    <h4 class="text-center">【タイトル】{{ $book -> title }}</h4>
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="text-center" style="width: 10%">カテゴリー</th>
          <th scope="col" class="text-center" style="width: 66%">レビュー</th>
          <th scope="col" class="text-center" style="width: 7%">開始頁</th>
          <th scope="col" class="text-center" style="width: 7%">終了頁</th>
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
          <td class="text-center">{{ $review -> updated_at}}</td>
        </tr>
      </tbody>
      @endforeach
    </table>
</div>
@endsection
