<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>解答</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="quizChallenge">
    <h1 class="bg-green-400">解答</h1>
    <div>カテゴリー：{{ $category->name }}</div>

    <p>問題数：{{ count($quizzes) }}</p>
    @foreach($quizzes as $quiz)
        <div class="p-2">
            <div>問題 {{ $quiz->id }}</div>
            {{-- 問題文 --}}
            <p>{{ $quiz->description }}</p>
            {{-- 結果 --}}
            <p>結果：{{ config('const.RESULT')[$answers[$quiz->id]] }}</p>
            {{-- 選択肢と解答 --}}
            @foreach($quiz->quiz_options as $option)
                <div class="p-1">
                    <div>
                        <span>{{ config('const.CORRECTION')[$option->correction] }}：</span>
                        {{ $option->sentence }}
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <a href="{{ route('quiz.index', ['categoryId' => $category->id]) }}" class="bg-blue-400 text-white">カテゴリーに戻る</a>
    <a href="{{ route('top') }}" class="bg-green-400">TOP</a>
</body>
