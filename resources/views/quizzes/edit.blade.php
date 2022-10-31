<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問題登録</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1 class="">問題登録</h1>
    <form action="{{ route('quiz.create') }}" method="post">
        @csrf
        <label for="category_id">カテゴリー</label>
        <select name="category_id" id="">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <div>
            <label for="description">問題文</label>
            <input type="text" name="description" placeholder="問題文" class="">
        </div>

        <div>
            <label for="sentence_1">選択肢1</label>
            <input type="text" name="sentence_1" placeholder="選択肢1">
            <select name="correction_1" id="">
                <option value="true">◯</option>
                <option value="false">×</option>
            </select>
        </div>
        <div>
            <label for="sentence_2">選択肢2</label>
            <input type="text" name="sentence_2" placeholder="選択肢2">
            <select name="correction_2" id="">
                <option value="true">◯</option>
                <option value="false">×</option>
            </select>
        </div>

        <input type="submit" name="submit" value="登録" class="block">
    </form>
</body>