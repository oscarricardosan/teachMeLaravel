<?php

namespace TeachMe\Entities;


class Ticket extends Entity
{
    protected $fillable = ['title', 'status'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(TicketComment::class);
    }
    //Votantes pasando por la tabla pivote ticket_votes
    public function voters(){
        return $this->belongsToMany(User::class, 'ticket_votes');
    }

    public function getIsOpenAttribute()
    {
        return $this->status == 'open';
    }
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

}
