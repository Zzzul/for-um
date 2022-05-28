<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'content'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(Votes::class);
    }

    public function up_votes()
    {
        return $this->hasMany(Votes::class)->where('type', 1);
    }

    public function down_votes()
    {
        return $this->hasMany(Votes::class)->where('type', 0);
    }

    public static function hasVote(int $id)
    {
        $votes = Votes::where(['user_id' => auth()->id(), 'post_id' => $id])->first();

        if ($votes) {
            if ($votes->type == 0) {
                return 'down';
            } else {
                return 'up';
            }
        } else {
            return '';
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
