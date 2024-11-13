<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orderable;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'status',
        'order_number',
        'user_id',
        'amount',
        'utm_source',
        'utm_medium',
        'utm_compaign',
        'utm_term',
        'utm_content',
    ];

    public function orderables()
    {
        return $this->hasMany(Orderable::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
