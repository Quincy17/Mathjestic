<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model {
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = ['user_id', 'title', 'content', 'image','category'];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
