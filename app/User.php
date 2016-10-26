<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthor()
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'email'  => $this->email,
//            'url'    => $this->url,  // Optional
            'avatar' => 'gravatar',
            'admin'  => $this->role === 'admin', // bool
        ];
    }
}
