<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderable extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'orderable_type',
        'orderable_id',
        'count',
        'price',
        'created_at',
    ];

    public function orderable(){
        return $this->morphTo();
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
