<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'description',
        'total_views',
        'id',
        'uuid',
    ];


}
