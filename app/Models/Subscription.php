<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\SubscriptionObserver;
use Spatie\Translatable\HasTranslations;

#[ObservedBy([SubscriptionObserver::class])]
class Subscription extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'period',
        'price',
        'discount',
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $model->setTranslations('title', request()->get('title') ?? []);
        });
    }

    public function access()
    {
        return $this->hasMany(SubscriptionAccess::class);
    }

    public function getPriceWithDiscountAttribute()
    {
        return $this->discount ? $this->discount : $this->price;
    }
}
