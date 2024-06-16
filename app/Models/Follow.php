<?php




namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
    'followee_user_id',
    'follower_user_id',
    ];
    
   
}