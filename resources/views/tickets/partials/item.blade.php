<div data-id="{{$ticket->id}}" class="well well-sm ticket">
    <h4 class="list-title">
        {{$ticket->title}}
        @include('tickets.partials.status', compact('ticket'))
    </h4>
    <p>
        @if(Auth::check())
            <a href="#"
               {!! Html::classes(['btn btn-primary btn-vote', 'hidden' => currentUser()->hasVoted($ticket)]) !!}
               title="Votar por este tutorial"
            >
                <span class="glyphicon glyphicon-thumbs-up"></span> Votar
            </a>

            <a href="#"
               {!! Html::classes(['btn btn-hight btn-unvote', 'hidden' => !currentUser()->hasVoted($ticket)]) !!}
               title="Quitar el voto a este tutorial"
            >
                <span class="glyphicon glyphicon-thumbs-down"></span> Quitar voto
            </a>
        @endif

        <a href="{{route('tickets.details', $ticket)}}">
            <span class="votes-count">{{$ticket->num_votes}} votos</span>
            - <span class="comments-count">{{$ticket->num_comments}} comentarios</span>.
        </a>

        <p class="date-t">
            <span class="glyphicon glyphicon-time"></span> {{$ticket->created_at->format('d/m/Y h:ia')}}
            Por {{$ticket->author->name}}
        </p>
    </p>
</div>