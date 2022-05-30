<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'length', 'url' , 'thumbnail', 'description', 'slug', 'category_id'
    ];

    public function getLengthInHumanAttribute()
    {
        return gmdate('H:i:s', $this->length);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function relatedVideos(int $count = 6)
    {
        return $this->category->getRandomVideos($count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }
}
