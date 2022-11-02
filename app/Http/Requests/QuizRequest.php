<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // カテゴリー
            'category_id'  => ['required'],
            // 問題文
            'description'  => ['required', 'max:500', 'unique:quizzes'],
            // 選択肢1
            'sentence_1'   => ['required', 'max:200'],
            // 選択肢1の正誤
            'correction_1' => ['required', 'integer', 'max:1', 'min:0'],
            // 選択肢2
            'sentence_2'   => ['required', 'max:200'],
            // 選択肢2の正誤
            'correction_2' => ['required', 'integer', 'max:1', 'min:0'],
        ];
    }
}
