<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class OrderUser extends Authenticatable
{
    protected $table = "order_user";

}
