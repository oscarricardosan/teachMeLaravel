<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use TeachMe\Entities\Ticket;
use TeachMe\Http\Requests;
use TeachMe\Repositories\TicketRepository;

class TicketsController extends Controller
{

    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }


    public function latest(){
        $tickets = $this->ticketRepository->paginateLatest();
        $title = 'Solicitudes Populares';
        return view('tickets.list', compact('tickets', 'title'));
    }

    public function popular(){
        return view('tickets.list');
    }

    public function open(){
        $tickets = $this->ticketRepository->paginateOpen();
        $title = 'Solicitudes Pendientes';
        return view('tickets.list', compact('tickets', 'title'));
    }

    public function closed(){
        $tickets = $this->ticketRepository->paginateClosed();
        $title = 'Solicitudes Cerradas';
        return view('tickets.list', compact('tickets', 'title'));
    }

    public function details($id)
    {
        $ticket = $this->ticketRepository->findOrFail_TicketWithSummary($id);
        $comments = $this->ticketRepository->commentsOfTicket($ticket);
        return view('tickets.details', compact('ticket', 'comments'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request) {

        $this->validate($request, [
           'title' => 'required|max:120'
        ]);
        $ticket = $this->ticketRepository->openNew(
            currentUser(),
            $request->title
        );

        return Redirect::route('tickets.details', $ticket->id   );
    }
}
