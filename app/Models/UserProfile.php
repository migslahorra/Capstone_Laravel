<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'phonenumber',
        'bio',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
