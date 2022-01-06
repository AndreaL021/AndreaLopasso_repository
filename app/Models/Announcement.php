<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;
    
   protected $fillable = [
    'title',
    'body',
    'price',
    'user_id',
    'category_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
 
    public function category(){
        return $this->belongsTo(Category::class);
    }

    static public function ToBeRevisionedCount()
    {
        return Announcement::where('is_accepted', null)->count();
    }

    static public function ArchiveCount()
    {
        return Announcement::where('is_accepted', 0)->count();
    }
}
