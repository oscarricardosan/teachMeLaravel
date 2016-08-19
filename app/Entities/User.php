<?php

namespace TeachMe\Entities;

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

    public function tickets()
    {
        return $this->hasMany(Ticket::class)->withTimestamps();
    }

    public function voted()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_votes')->withTimestamps();
    }

    public function hasVoted($ticket)
    {
        return !$this->voted()->where('ticket_id',$ticket->id)->get()->isEmpty();
        //Basicamente hacen lo mismo
        //return TicketVote::where(['user_id'=> $this->id, 'ticket_id' => $ticket->id])->isEmpty();
    }

}
