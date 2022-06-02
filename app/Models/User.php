<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sent(){
        return $this->hasMany(Requests::class, 'from_id', 'id' );
    }

    public function recived(){
        return $this->hasMany(Requests::class, 'to_id', 'id');
    }

    public function connectionSent(){
        return $this->hasMany(Connection::class, 'from_id', 'id' );
    }

    public function connectionRecived(){
        return $this->hasMany(Connection::class, 'to_id', 'id' );
    }

    public function allConnection(){
        $connectionSent = $this->connectionSent;
        $connectionRecived = $this->connectionRecived;
        return $connectionSent->merge($connectionRecived);
    }

    public function isFriend(){
        $cs = $this->connectionSent->where('to_id', Auth::user()->id);
        $cr = $this->connectionRecived->where('from_id', Auth::user()->id);
        return $cs->count()+$cr->count() > 0;
    }

    public function commonFriendCount(){
        $count = 0;
        foreach ($this->allConnection() as $data){
            if($this->id == $data->from_id) {$user = $data->sentUser;}
            else {$user = $data->recivedUser;}
            if($user->isFriend()){
                $count++;
            }
        }
        return $count;
    }
}
