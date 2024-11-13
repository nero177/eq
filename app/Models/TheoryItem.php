<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FileTrait;
use Spatie\Translatable\HasTranslations;

class TheoryItem extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FileTrait, HasTranslations;

    protected $fillable = ['name', 'url'];
    public $translatable = ['name'];
     

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('name', request()->get('name') ?? []);
        });

        self::saved(function ($model) {
            if (request()->bg) {
                $model->addModelFileToCollection(request(), 'bg', 'bg', true);
            }
        });
    }
}
