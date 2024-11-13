<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Translatable\Facades\Translatable;

class Option extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'key',
        'value'
    ];

    public $translatable = ['value'];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            if(is_array(request()->get($model->key))){
                $model->setTranslations('value', request()->get($model->key) ?? []);
            }
        });
    }
}
