<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tracnghiem extends Authenticatable
{
    protected $table = "tracnghiem_cauhoi";



}
