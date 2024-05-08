<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;
use mysql_xdevapi\Expression;

class RemoveExpiredTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:remove_all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all expired tokens';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiration = config('sanctum.expiration');
        if ($expiration) {
            $tokens = PersonalAccessToken::where('created_at', '<', now()->subMinutes($expiration + (7 * 24 * 60)));
            $tokens->delete();

            return 0;
        }

        $this->warn('Expire time is not set.');
    }
}
