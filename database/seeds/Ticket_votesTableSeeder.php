<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\TicketVote;

class Ticket_votesTableSeeder extends BaseSeeder
{
    protected $total = 250;

    public function getModel()
    {
        return new TicketVote();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'user_id' => $this->getRandom(\TeachMe\Entities\User::class)->id,
            'ticket_id' => $this->getRandom(\TeachMe\Entities\Ticket::class)->id,
        ];
    }
}
