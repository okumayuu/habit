<?php




namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
    'todo',
    'user_id',
    'category_id'
    ];
    
    
    public function user(){
        return $this->belongsTo(User::class);
        
    }
    
    public function category(){
        return $this->belongsto(Category::class);
        
    }
    
    

    
}