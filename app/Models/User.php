<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\OrderableType;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FileTrait;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, FileTrait;

    const ROLE_AUTHOR = 'author';
    const ROLE_USER = 'user';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'details',
        'achievements',
        'password',
        'password_updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'details' => 'json',
        'achievements' => 'json'
    ];

    protected $translatable = ['achievements'];

    protected static function boot()
    {
        parent::boot();

        self::saved(function ($model) {
            if (request()->photo) {
                $model->addModelFileToCollection(request(), 'photo', 'photo', true);
            }

            if (request()->avatar) {
                $model->addModelFileToCollection(request(), 'avatar', 'avatar', true);
            }
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function purchased()
    {
        return $this->hasMany(Orderable::class)->with(['orderable', 'order'])->whereHas('order', function ($query) {
            $query->where('status', OrderStatus::APPROVED->value);
        });
    }

    public function subscriptions()
    {
        return $this->purchased()->where('orderable_type', OrderableType::SUBSCRIPTION->model())->with('orderable.access');
    }

    public function collections()
    {
        return $this->purchased()->where('orderable_type', OrderableType::COLLECTION->model())->with('orderable.lessons');
    }

    public function lessons()
    {
        return $this->purchased()->where('orderable_type', OrderableType::LESSON->model())->with('orderable.author');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class)->with('favoritable');
    }

    public function getAchievementsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setAchievementsAttribute($value)
    {
        $this->attributes['achievements'] = json_encode(array_values($value));
    }

    public function getLocalizedAuthorFullNameAttribute(){
        $result = [];

        if(!isset($this->details['author_name_' . get_current_locale()]) && !isset($this->details['author_surname_' . get_current_locale()])){
            return $this->name;
        }

        if (isset($this->details['author_name_' . get_current_locale()])){
            $result[] = $this->details['author_name_' . get_current_locale()];
        }
        
        if (isset($this->details['author_surname_' . get_current_locale()])) {
            $result[] = $this->details['author_surname_' . get_current_locale()];
        }

        return implode(' ', $result);
    }

    // /**
    //  * Get the identifier that will be stored in the subject claim of the JWT.
    //  *
    //  * @return mixed
    //  */
    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    // /**
    //  * Return a key value array, containing any custom claims to be added to the JWT.
    //  *
    //  * @return array
    //  */
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }
}
