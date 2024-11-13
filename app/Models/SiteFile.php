<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\FileTrait;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteFile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FileTrait;

    protected $fillable = [
        'title'
    ];

    protected static function boot()
    {
        parent::boot();

        self::saved(function ($model) {
            if (request()->file) {
                $model->addModelFileToCollection(request(), 'file', 'file', true);
            }
        });
    }
}
