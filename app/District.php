<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "district";
    public function wards()
    {
        return $this->hasMany(Ward::class, "_district_id", "id");
    }
}
