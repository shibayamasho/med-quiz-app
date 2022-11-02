<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>med-quiz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="h-24 bg-green-400 flex justify-between">
        <div class="bg-blue-100 p-3 flex items-center">LOGO</div>
        <ul class="flex">
            <li class="bg-blue-100 m-1 p-3 flex items-center"><a href="">menu1</a></li>
            <li class="bg-blue-100 m-1 p-3 flex items-center"><a href="">menu2</a></li>
            <li class="bg-blue-100 m-1 p-3 flex items-center"><a href="">menu3</a></li>
            <li class="bg-blue-100 m-1 p-3 flex items-center">user name<?php // ユーザー名 ?></li>
        </ul>
    </header>

    <main class="w-8/12 bg-blue-200 space-x-4">

        <h1 class="text-3xl ml-4">TOP</h1>
        <p>this is top page.</p>

        <section class="flex">
            <div class="mr-3"><a href="{{ route('category.edit') }}" class="inline-block bg-green-600 text-white p-2 rounded-lg">新しいカテゴリーを登録</a></div>
            <div><a href="{{ route('quiz.edit') }}" class="inline-block bg-blue-700 text-white p-2 rounded-lg">新しい問題を登録</a></div>
        </section>

        <section class="">
            <h2 class="text-2xl">カテゴリー 一覧</h2>

            <div class="grid grid-cols-3 grid-rows-2">
                @foreach($categories as $category)
                    <div class="bg-green-100 p-3 text-center">
                        <h3 class="mb-2"><?php echo $category->name ?></h3>
                        <a href="{{ route('quiz.index', ['categoryId' => $category->id]) }}">> 問題ページへ</a>
                    </div>
                @endforeach
            </div>

        </section>

    </main>

</body>
</html>