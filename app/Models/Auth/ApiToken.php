<?php

namespace App\Models\Auth;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'api_token'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
