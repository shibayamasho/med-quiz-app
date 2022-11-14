@extends('adminlte::page')

@section('title', 'med-quiz')

@section('content_header')
    <h1>カテゴリー 一覧</h1>
@stop

@section('content')

    <section class="flex mb-4">
        <div class="mr-3"><a href="{{ route('category.edit') }}" class="inline-block bg-green-600 text-white p-2 rounded-lg">新しいカテゴリーを登録</a></div>
        <div><a href="{{ route('quiz.edit') }}" class="inline-block bg-blue-700 text-white p-2 rounded-lg">新しい問題を登録</a></div>
    </section>

    <section class="">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4">
                    <a class="block" href="{{ route('quiz.index', ['categoryId' => $category->id]) }}">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user shadow-lg">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username">{{ $category->name }}</h3>
                            {{-- <h5 class="widget-user-desc"></h5> --}}
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="assets/img/icon_html128.jpeg" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="description-block">
                                        <h5 class="description-header"></h5>
                                        <span class="description-text"></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </a>
                </div>
            @endforeach
        </div>
    </section>

@stop

@section('css')
@vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')
    {{-- <script> console.log('ページごとJSの記述'); </script> --}}
@stop
