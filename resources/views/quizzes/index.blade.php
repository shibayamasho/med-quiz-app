<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問題一覧</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1 class="bg-green-400">{{ $category->name }}</h1>
    <p>問題数：{{ count($quizzes) }}</p>
    <a href="{{ route('quiz.challenge', ['categoryId' => $category->id]) }}" class="bg-blue-400 text-white">問題に挑戦</a>
    @foreach($quizzes as $quiz)
        <div>問題番号：{{ $quiz->id }}</div>
        {{-- 問題文 --}}
        {{-- <p>{{ $quiz->description }}</p> --}}
        {{-- 選択肢 --}}
        {{-- @foreach($quiz->quiz_options as $option)
            <p>{{ $option->sentence }}</p>
        @endforeach --}}
    @endforeach

    <a href="{{ route('top') }}" class="bg-green-400">TOP</a>
</body>
