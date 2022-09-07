<?php

namespace App\Models;

use App\Filters\VideoFilters;
use App\Models\Traits\Likeable;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory, Likeable;

    protected $fillable = [
        'name', 'length', 'url' , 'thumbnail', 'description', 'slug', 'category_id'
    ];

    protected $hidden = ['category_id'];

    protected $appends = ['owner_name', 'category_name'];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerNameAttribute()
    {
        return $this->user?->name;
    }

    public function getOwnerGravatarAttribute()
    {
        return $this->user?->gravatar;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function getVideoUrlAttribute()
    {
        return '/storage//' . $this->url;
    }

    public function getVideoThumbnailAttribute()
    {
        return '/storage//' . $this->thumbnail;
    }

    public function scopeFilter(Builder $builder, array $params)
    {
        (new VideoFilters($builder))->apply($params);
    }
}
