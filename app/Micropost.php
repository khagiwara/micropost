<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //--------------お気に入り用-------------
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function favaritings()
    {
        return $this->belongsToMany(User::class, 'micropost_user')->withTimestamps();
    }
    public function favarite($userId)
    {
        // 既にお気に入りしているかの確認
        $exist = $this->is_favariting($userId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            // 既にお気に入りにいるか自分自身であれば何もしない
            return false;
        } else {
            // それ以外はお気に入りに追加
            $this->favaritings()->attach($userId);
            return true;
        }
    }
    public function unfavarite($userId)
    {
        // 既にお気に入りしているかの確認
        $exist = $this->is_favariting($userId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            // 既にお気に入りにいればフォローを外す
            $this->favaritings()->detach($userId);
            return true;
        } else {
            // お気に入りにいなければ何もしない
            return false;
        }
    }    

    public function is_favariting($userId) {
        return $this->favaritings()->where('user_id', $userId)->exists();
    }
    
    
    
}
