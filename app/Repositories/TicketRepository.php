<?php
/**
 * Created by PhpStorm.
 * User: masterdev
 * Date: 16/08/2016
 * Time: 17:24
 */

namespace TeachMe\Repositories;


use TeachMe\Entities\Ticket;
use TeachMe\Entities\User;

class TicketRepository extends BaseRepository
{

    protected function selectTicketsList()
    {
        return $tickets = $this->newQuery()->selectRaw('
                tickets.*, 
                (Select count(*) from ticket_comments as comments where comments.ticket_id = tickets.id) as num_comments, 
                (Select count(*) from ticket_votes as votes where votes.ticket_id = tickets.id) as num_votes 
            ')
            ->with('author');//relation name in mode;
    }

    public function paginateLatest()
    {
        return $this->selectTicketsList()
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    }

    public function paginateOpen()
    {
        return $this->selectTicketsList()
            ->open()
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    }

    public function paginateClosed()
    {
        return $this->selectTicketsList()
            ->closed()
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    }

    public function findOrFail_TicketWithSummary($id)
    {
        return $this->selectTicketsList()->findOrFail($id);
    }
    public function findOrFail($id)
    {
        return $this->newQuery()->findOrFail($id);
    }

    public function commentsOfTicket(Ticket $ticket)
    {
        return $ticket->comments()->with('user')->get();
    }

    public function getEntity()
    {
        return new Ticket();
    }

    public function openNew(User $user, $title)
    {
        return $user->tickets()->create([
            'title' => $title,
            'status' => 'open',
        ]);
    }
}