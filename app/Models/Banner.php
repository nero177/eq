<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FileTrait;
use Spatie\Translatable\HasTranslations;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FileTrait, HasTranslations;

    protected $fillable = [
        'title',
        'desc',
        'order',
        'link',
        'video_link',
        'show_in',
        'details',
        'buttons'
    ];

    protected $casts = [
        'details' => 'array',
        'buttons' => 'array',
        'show_in' => 'array',
    ];

    public $translatable = ['title', 'desc'];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('title', request()->get('title') ?? []);
            $model->setTranslations('desc', request()->get('desc') ?? []);
        });

        self::saved(function ($model) {
            if (request()->bg) {
                $model->addModelFileToCollection(request(), 'bg', 'bg', true);
            }

            if (request()->bg_mob) {
                $model->addModelFileToCollection(request(), 'bg_mob', 'bg_mob', true);
            }
        });
    }

    protected function getDescAttribute(){
        $decoded = json_decode($this->getRawOriginal('desc'), true);
        return $decoded[get_current_locale()] ?? '';
    }
}
