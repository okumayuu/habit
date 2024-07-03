<?php




namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{

    
    use HasFactory;
    
    
    public function users(){
        return $this->belongsToMany(User::class);
        
    }
    
    public function todos(){
        return $this->hasMany(Todo::class);
        
    }
    
    public function posts(){
        return $this->hasMany(Post::class);//postに対するリレーション
        
    }
    
    public function target(){
        return $this->hasOne(Target::class);
    }
    
    public function getByCategory(int $limit_count = 5){
         return $this->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
}