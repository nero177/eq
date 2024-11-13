<?php

namespace App\Models;

use App\Observers\CollectionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([CollectionObserver::class])]
class Collection extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FileTrait, HasTranslations;

    public $translatable = ['title', 'desc', 'details', 'modal_text'];

    protected $fillable = [
        'title',
        'desc',
        'price',
        'period',
        'details',
        'slug',
        'unique_template',
        'discount',
        'modal_details',
        'modal_text'
    ];

    protected $casts = [
        'modal_details' => 'array'
    ];
    
    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('title', request()->get('title') ?? []);
            $model->setTranslations('desc', request()->get('desc') ?? []);
            $model->setTranslations('details', request()->get('details') ?? []);
            $model->setTranslations('modal_text', request()->get('modal_text') ?? []);

            if (!request()->slug) {
                $model->slug = transliterate(request()->title['uk']);
            }
        });

        self::saved(function ($model) {
            if (request()->thumbnail) {
                $model->addModelFileToCollection(request(), 'thumbnail', 'thumbnail', true);
            }

            if (request()->banner) {
                $model->addModelFileToCollection(request(), 'banner', 'banner', true);
            }

            if (request()->banner_mob) {
                $model->addModelFileToCollection(request(), 'banner_mob', 'banner_mob', true);
            }
        });
    }

    public function lessons(){
        return $this->belongsToMany(Lesson::class)->orderBy('order');
    }

    public function getPriceWithDiscountAttribute()
    {
        return $this->discount ? $this->discount : $this->price;
    }
}
