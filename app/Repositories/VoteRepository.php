<?php
/**
 * Created by PhpStorm.
 * User: masterdev
 * Date: 17/08/2016
 * Time: 14:24
 */

namespace TeachMe\Repositories;


use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketVote;
use TeachMe\Entities\User;

class VoteRepository extends BaseRepository
{

    /**
     * return \TeachMe\Entities\Entity
     */
    public function getEntity()
    {
        return new TicketVote();
    }


    public function vote(User $user, Ticket $ticket)
    {
        if($user->hasVoted($ticket))return false;

        $user->voted()->attach($ticket);

        return true;
    }

    public function unVote(User $user, Ticket $ticket)
    {
        if(!$user->hasVoted($ticket))return false;

        $user->voted()->detach($ticket);

        return true;
    }
}