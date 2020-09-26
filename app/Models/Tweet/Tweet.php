<?php

namespace App\Models\Tweet;

use App\Models\Profile\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    protected $fillable = ['profile', 'body'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
