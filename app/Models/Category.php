<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function getCategories()
    {
        return self::orderBy('created_at', 'DESC')->get();
    }
}
