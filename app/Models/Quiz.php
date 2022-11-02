<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // ユーザー（問題登録者）
    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    // カテゴリー
    protected function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 選択肢
    protected function quiz_options()
    {
        return $this->hasMany(QuizOption::class);
    }
}
