<?php

use Illuminate\Database\Seeder;

class Ticket_commentsTableSeeder extends BaseSeeder
{
    protected $total = 300;

    public function getModel()
    {
        return new \TeachMe\Entities\TicketComment();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'comment' => $faker->paragraph(),
            'ticket_id' => $this->getRandom(\TeachMe\Entities\Ticket::class)->id,
            'user_id' => $this->getRandom(\TeachMe\Entities\User::class)->id,
            'link' => $faker->randomElement([null, null, $faker->url])
        ];
    }
}
