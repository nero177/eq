<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionAccess extends Model
{
    use HasFactory;

    protected $table = 'subscriptions_access';

    protected $fillable = [
        'subscription_id',
        'type',
    ];
}
