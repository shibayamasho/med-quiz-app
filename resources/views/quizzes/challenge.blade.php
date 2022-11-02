<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問題</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="quizChallenge">
    <h1 class="bg-green-400">問題</h1>
    <div>カテゴリー：{{ $category->name }}</div>

    @if (count($quizzes) > 0)

        <p>問題数：{{ count($quizzes) }}</p>
        <form action="{{ route('quiz.answer', ['categoryId' => $category->id]) }}" method="post">
            @csrf
            @foreach($quizzes as $quiz)
                <div class="p-2">
                    <div>問題 {{ $quiz->id }}</div>
                    {{-- 問題文 --}}
                    <p>{{ $quiz->description }}</p>
                    {{-- 選択肢 --}}
                    @foreach($quiz->quiz_options as $option)
                        <div class="p-1">
                            <input type="checkbox" name="sentence_{{ $option->id }}" id="option_{{ $option->id }}" value="1">
                            <label for="sentence_{{ $option->id }}">{{ $option->sentence }}</label>
                        </div>
                    @endforeach
                    {{-- <button v-on:click="answer('')" class="p-1 bg-green-400">解答する</button>
                    <div v-show="correctAnswer">正解</div>
                    <div v-show="incorrectAnswer">はずれ</div> --}}
                </div>
            @endforeach
            <input type="hidden" name="categoryId" value="{{ $category->id }}">
            <input type="submit" value="確認" class="bg-blue-400">
        </form>

    @else
        <div class="text-red-500">問題はまだ登録されていません</div>
    @endif

    <a href="{{ route('top') }}" class="bg-green-400">TOP</a>
</body>
