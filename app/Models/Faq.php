<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['question', 'answer'];

    protected $fillable = [
        'question',
        'answer',
        'order'
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('question', request()->get('question') ?? []);
            $model->setTranslations('answer', request()->get('answer') ?? []);
        });
    }
}
