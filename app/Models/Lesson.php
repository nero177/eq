<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FileTrait;
use Spatie\Translatable\HasTranslations;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Lesson extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FileTrait, HasTranslations;

    protected $fillable = [
        'title',
        'desc',
        'type',
        'video_url',
        'video_bottom_url',
        'captions',
        'author_id',
        'duration',
        'price',
        'video_lang',
        'steps',
        'you_will_learn',
        'order',
        'is_new',
        'discount',
        'is_free',
        'demo_url',
        'diagram',
    ];

    public $translatable = ['title', 'desc', 'steps', 'you_will_learn', 'video_url', 'video_bottom_url', 'captions'];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('title', request()->get('title') ?? []);
            $model->setTranslations('desc', request()->get('desc') ?? []);
            $model->setTranslations('steps', request()->get('steps') ?? []);
            $model->setTranslations('you_will_learn', request()->get('you_will_learn') ?? []);
            $model->setTranslations('video_url', request()->get('video_url') ?? []);
            $model->setTranslations('video_bottom_url', request()->get('video_bottom_url') ?? []);
            $model->setTranslations('captions', request()->get('captions') ?? []);
        });

        self::saved(function ($model) {
            if (request()->thumbnail) {
                $model->addModelFileToCollection(request(), 'thumbnail', 'thumbnail', true);
            }

            if (request()->haircut_scheme) {
                $model->addModelFileToCollection(request(), 'haircut_scheme', 'haircut_scheme', true);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function getPriceWithDiscountAttribute()
    {
        return $this->discount ? $this->discount : $this->price;
    }

    public function getVideoLocalesNativeAttribute(){
        $locales = LaravelLocalization::getLocalesOrder();
        $videoLocalesNative = [];

        foreach ($locales as $locale => $langData){
            if(isset($this->getOriginal('video_url')[$locale])){
                $videoLocalesNative[] = __('site.' . strtolower($langData['name']));
            }   
        }

        return implode(', ', $videoLocalesNative);
    }
}
