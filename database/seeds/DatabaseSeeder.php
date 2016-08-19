<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->truncateTables([
            'users', 'password_resets', 'categories', 'ticket_categories',
            'ticket_comments', 'ticket_likes', 'ticket_votes', 'tickets', 'users'
        ]);
        $this->call(UserTableSeeder::class);
        $this->call(TicketTableSeeder::class);
        $this->call(Ticket_votesTableSeeder::class);
        $this->call(Ticket_commentsTableSeeder::class);
    }

    public function truncateTables($tables)
    {
        foreach ($tables as $table) {
            DB::statement("TRUNCATE TABLE $table RESTART IDENTITY CASCADE");
        }
    }
}
