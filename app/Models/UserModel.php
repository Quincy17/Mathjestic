<?php 

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use Notifiable;
    protected $table = 'm_user';
    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function soals()
    {
        return $this->hasMany(SoalModel::class, 'created_by');
    }
}
