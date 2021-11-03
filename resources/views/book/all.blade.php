@extends('layouts.header')
@section('content')
<h3 class="text-center">あなただけの本棚-全てのブックリスト-</h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col" class="text-center" style="width: 20%">@sortablelink('name', '筆者')</th>
        <th scope="col" class="text-center" style="width: 50%">@sortablelink('title', 'タイトル')</th>
        <th scope="col" class="text-center" style="width: 10%">@sortablelink('publisher', '出版社')</th>
        <th scope="col" class="text-center" style="width: 10%">@sortablelink('year', '出版年')</th>
        <th scope="col" class="text-center" style="width: 10%">レビュー</th>
    </tr>
    </thead>
    @foreach($books as $book)
    <tbody>
    <tr>
        <th scope="row">{{ $book -> name }}</th>
        <td>{{ $book -> title }}</td>
        <td class="text-center">{{ $book -> publisher }}</td>
        <td class="text-center">{{ $book -> year }}</td>
        <td class="text-center"> <a href="{{ route('review.all',$book -> id) }}"><i class="far fa-check-circle"></i></a></td>
    </tr>
    </tbody>
    @endforeach
 </table>
<div class="d-flex justify-content-center py-4">
{{ $books->links() }}
</div>
@endsection
