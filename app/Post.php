<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value){
        $this->attributes['title']  = $value;
        $this->attributes['slug']   = str_slug($value,'-');
    }

    public function getUrlAttribute(){

        return route('posts.show',[$this->id,$this->slug]);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function comment(User $user,$content){
        $comment = new Comment(['comment' => $content]);
        $comment->user_id = $user->id;
        $this->comments()->save($comment);
    }
}
