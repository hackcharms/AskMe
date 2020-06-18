<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $fillable=['title','body'];
    use VotableTrait;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title']=$value;
        $this->attributes['slug']=Str::slug($value,'-');
    }
    public function getUrlAttribute()
    {
        return route("question.show",$this->slug);
        // return '#';
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
    public function getStatusAttribute()
    {
        if($this->answers_count>0){
            if($this->best_answer_id)
                return 'answered-accepted';
            else
                return 'answered';
        }else
        {
            return 'unanswered';
        }
    }
    public function getBodyHtmlAttribute()
    {
        //
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id=$answer->id;
        $this->save();
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class,'favorite_questions')->withTimestamps();//,question_id','user_id  ');
    }
    public function isFavorited()
    {
        return $this->favorites()->where('user_id',auth()->id())->count()>0;
    }
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    }
