<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問題</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1 class="bg-green-400">問題</h1>
    <div>カテゴリー：{{ $category->name }}</div>

    @if (count($quizzes) > 0)

        <p>問題数：{{ count($quizzes) }}</p>
        @foreach($quizzes as $quiz)
            <div class="p-2">
                <div>問題 {{ $quiz->id }}</div>
                {{-- 問題文 --}}
                <p>{{ $quiz->description }}</p>
                {{-- 選択肢 --}}
                @foreach($quiz->quiz_options as $option)
                    <div class="p-1">
                        <input type="checkbox" name="sentence_{{ $option->id }}" id="">
                        <label for="sentence_{{ $option->id }}">{{ $option->sentence }}</label>
                    </div>
                @endforeach
                <button class="p-1 bg-green-400">解答する</button>
            </div>
        @endforeach

    @else
        <div class="text-red-500">問題はまだ登録されていません</div>
    @endif

    <a href="{{ route('top') }}" class="bg-green-400">TOP</a>
</body>
