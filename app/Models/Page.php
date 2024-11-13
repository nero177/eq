<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FileTrait;

class Page extends Model
{
    use HasFactory, InteractsWithMedia, FileTrait, HasTranslations;

    protected $fillable = ['slug', 'template', 'metadata', 'content', 'title'];

    protected $casts = [
        'metadata' => 'array', 
        'content' => 'array',
    ];

    public $translatable = ['metadata', 'content', 'title'];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('title', request()->get('title') ?? []);
            $model->setTranslations('metadata', request()->get('metadata') ?? []);
            $model->setTranslations('content', request()->get('content') ?? []);
        });

        // self::saved(function ($model) {
        //     if (request()->bg) {
        //         $model->addModelFileToCollection(request(), 'bg', 'bg', true);
        //     }
        // });
    }
}
