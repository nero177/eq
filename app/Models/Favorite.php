<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'user_favorites';

    protected $fillable = [
        'user_id',
        'item_id',
        'item_type',
    ];

    public function favoritable()
    {
        return $this->morphTo(null, 'item_type', 'item_id');
    }
}
