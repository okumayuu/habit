<?php




namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
    'title',
    'body',
    'category_id',
    'user_id',
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);//categoryに対するリレーション
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
   
}