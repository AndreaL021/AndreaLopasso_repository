<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;
use Laravel\Scout\Searchable;
use App\Models\AnnouncementImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;
    use Searchable;
    
   protected $fillable = [
    'title',
    'body',
    'price',
    'user_id',
    'category_id'
    ];

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
        ];

        return $array;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
 
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(AnnouncementImage::class);
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
