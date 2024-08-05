<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCookie extends Model
{
    use HasFactory;

    protected $table = "cookies";
    protected $fillable = ["post_id", "cookie_name", "cookie_value"];
}
