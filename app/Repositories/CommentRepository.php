<?php
/**
 * Created by PhpStorm.
 * User: masterdev
 * Date: 17/08/2016
 * Time: 14:09
 */

namespace TeachMe\Repositories;


use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Entities\User;

class CommentRepository extends  BaseRepository
{

    public function getEntity()
    {
        return New TicketComment();
    }

    public function create(Ticket $ticket, User $user, $comment, $link = '')
    {
        $comment = new TicketComment(compact('comment', 'link'));
        $comment->user_id = $user->id;
        $ticket->comments()->save($comment);
    }
}