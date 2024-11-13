<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FileTrait;
use Spatie\Translatable\HasTranslations;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FileTrait, HasTranslations;

    protected $fillable = [
        'title',
        'content',
        'short_desc',
        'type',
        'order'
    ];

    public $translatable = ['title', 'content', 'short_desc'];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('title', request()->get('title') ?? []);
            $model->setTranslations('content', request()->get('content') ?? []);
            $model->setTranslations('short_desc', request()->get('short_desc') ?? []);
        });

        self::saved(function ($model) {
            if (request()->thumbnail) {
                $model->addModelFileToCollection(request(), 'thumbnail', 'thumbnail', true);
            }

            if (request()->main_image) {
                $model->addModelFileToCollection(request(), 'main_image', 'main_image', true);
            }
        });
    }

    public function related(){
        return $this->belongsToMany(Article::class, 'article_related', 'article_id', 'related_article_id');
    }
}
