@extends('adminlte::page')

@section('title', 'カテゴリー登録')

@section('content_header')
    <h1>カテゴリー登録</h1>
@stop

@section('content')

<div>
    <form action="{{ route('category.create') }}" method="post">
        @csrf

        <div class="form-group col-sm-6">
            <label for="category_name">カテゴリー名</label>
            <input type="text" name="category_name" class="form-control" placeholder="カテゴリー名を入力してください">
            @error('category_name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" class="btn btn-primary" name="submit" value="登録">
    </form>
</div>

@stop

@section('css')

@stop

@section('js')

@stop
