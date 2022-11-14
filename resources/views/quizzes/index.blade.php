@extends('adminlte::page')

@section('title', '問題一覧')

@section('content_header')
    <h1>{{ $category->name }}</h1>
@stop

@section('content')

    @if (count($quizzes))
        <h3>問題数：{{ count($quizzes) }}</h3>

        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('quiz.challenge', ['categoryId' => $category->id]) }}'">問題に挑戦</button>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('quiz.randomChallenge', ['categoryId' => $category->id]) }}'">ランダムに挑戦（最大５問）</button>
    @else
        <p>問題はまだ登録されていません</p>
    @endif
    <button type="button" class="btn btn-default" onclick="location.href='{{ route('top') }}'">TOP</button>

@stop

@section('css')
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')
    {{-- <script> console.log('ページごとJSの記述'); </script> --}}
@stop
