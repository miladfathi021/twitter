<?php

namespace App\Models\Profile;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'username'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
