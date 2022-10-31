<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>カテゴリー登録</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>カテゴリー登録</h1>
    <form action="{{ route('category.create') }}" method="post">
        @csrf
        <input type="text" name="category_name" class="inline-block">
        <input type="submit" name="submit" value="登録" class="inline-block">
    </form>
</body>