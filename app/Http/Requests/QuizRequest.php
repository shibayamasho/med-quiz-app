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
        $data    = $this->all();
        $choices = $data['choices'];
        return $this->getRules($choices);
    }

    private function getRules($choices)
    {
        $rules = [
            // カテゴリー
            'category_id'  => ['required'],
            // 問題文
            'description'  => ['required', 'max:500', 'unique:quizzes'],
            // 選択肢の数
            'choices'      => ['required', 'integer', 'max:4', 'min:2'],
            // 選択肢1
            'sentence_1'   => ['required', 'max:200'],
            // 選択肢1の正誤
            'correction_1' => ['required', 'integer', 'max:1', 'min:0'],
            // 選択肢2
            'sentence_2'   => ['required', 'max:200'],
            // 選択肢2の正誤
            'correction_2' => ['required', 'integer', 'max:1', 'min:0'],
        ];

        if ($choices >= 3) {
            $rules['sentence_3']   = ['required', 'max:200'];
            $rules['correction_3'] = ['required', 'integer', 'max:1', 'min:0'];
        }
        if ($choices >= 4) {
            $rules['sentence_4']   = ['required', 'max:200'];
            $rules['correction_4'] = ['required', 'integer', 'max:1', 'min:0'];
        }

        return $rules;
    }
}
