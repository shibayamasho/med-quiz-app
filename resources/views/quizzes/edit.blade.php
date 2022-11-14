@extends('adminlte::page')

@section('title', '問題登録')

@section('content_header')
    <h1>問題登録</h1>
@stop

@section('content')

<div id="app">
    <form action="{{ route('quiz.create') }}" method="post">
        @csrf

        <div class="form-group col-sm-6">
            <label for="category_id">カテゴリー</label>
            <select class="custom-select rounded-0" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>問題文</label>
                <textarea class="form-control" name="description" rows="3" placeholder="問題文を入力してください"></textarea>
            </div>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="choices">選択肢の数</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choices" value="2" v-model="choices" checked>
                    <label class="form-check-label">2</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choices" value="3" v-model="choices">
                    <label class="form-check-label">3</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choices" value="4" v-model="choices">
                    <label class="form-check-label">4</label>
                </div>
            </div>
        </div>

        <div class="col-sm-6 mb-2">
            <label for="sentence_1">選択肢1</label>
            <input type="text" class="form-control" name="sentence_1" placeholder="選択肢1">
            @error('sentence_1')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <select class="custom-select rounded-0 col-sm-2" name="correction_1">
                <option value="1">◯</option>
                <option value="0">×</option>
            </select>
            @error('correction_1')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-sm-6 mb-2">
            <label for="sentence_2">選択肢2</label>
            <input type="text" class="form-control" name="sentence_2" placeholder="選択肢2">
            @error('sentence_2')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <select class="custom-select rounded-0 col-sm-2" name="correction_2">
                <option value="1">◯</option>
                <option value="0">×</option>
            </select>
            @error('correction_2')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-sm-6 mb-2" v-if="(choices >= 3)">
            <label for="sentence_3">選択肢3</label>
            <input type="text" class="form-control" name="sentence_3" placeholder="選択肢3">
            @error('sentence_3')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <select class="custom-select rounded-0 col-sm-2" name="correction_3">
                <option value="1">◯</option>
                <option value="0">×</option>
            </select>
            @error('correction_3')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-sm-6 mb-2" v-if="(choices >= 4)">
            <label for="sentence_4">選択肢4</label>
            <input type="text" class="form-control" name="sentence_4" placeholder="選択肢4">
            @error('sentence_4')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <select class="custom-select rounded-0 col-sm-2" name="correction_4">
                <option value="1">◯</option>
                <option value="0">×</option>
            </select>
            @error('correction_4')
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
    @vite(['resources/js/app.js'])
@stop
