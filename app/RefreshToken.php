<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function expires() {
        return Carbon::parse($this->expires_at)->lessThan(Carbon::now()->addMinute());
    }
}
