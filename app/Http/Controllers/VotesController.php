<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use TeachMe\Entities\Ticket;
use TeachMe\Http\Requests;
use TeachMe\Repositories\TicketRepository;
use TeachMe\Repositories\VoteRepository;

class VotesController extends Controller
{

    /**
     * @var TicketRepository
     */
    protected $ticketRepository;
    /**
     * @var VoteRepository
     */
    protected $voteRepository;

    public function __construct(TicketRepository $ticketRepository, VoteRepository $voteRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->voteRepository = $voteRepository;
    }

    protected function submit($id, Request $request)
    {
        $ticket =  $this->ticketRepository->findOrFail($id);
        $success = $this->voteRepository->vote(currentUser(), $ticket);
        if($request->ajax())
            return response()->json(compact('success'));
        else
            return redirect()->back();
    }
    protected function destroy($id, Request $request)
    {
        $ticket =  $this->ticketRepository->findOrFail($id);
        $success = $this->voteRepository->unVote(currentUser(), $ticket);
        if($request->ajax())
            return response()->json(compact('success'));
        else
            return redirect()->back();
    }
}
