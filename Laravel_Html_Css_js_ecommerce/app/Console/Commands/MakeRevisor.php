<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeRevisor extends Command
{
    protected $signature = 'command:makeRevisor';
    protected $description = 'Rndi un utente revisore';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email= $this->ask("Inserisci l'email dell'utente che vuoi rendere revisore");
        $user= User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("Utente non trovato");
            return;
        }

        $user->is_revisor= true;
        $user->save();
        $this->info("L'utente {$user->name} è ora un revisore.");
    }
}
