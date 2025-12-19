<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\PostFactory;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

   protected $fillable = [
    'image',
    'title',
    'content',
    'slug',
    
    'user_id',
    'category_id',
    'published_at',
];

public function user(){
    return $this->belongsTo(User::class);
}

public function readmin($wordPerMinute = 100){
    $wordCount= str_word_count(strip_tags($this->content));
    $minute = ceil($wordCount /$wordPerMinute);

    return max(1, $minute);
}

 public function pfpurl(){
        if($this->image){
            return Storage::url($this->image);
        }
        return null;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
