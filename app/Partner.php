<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class, 'partner_id');
    }
}
