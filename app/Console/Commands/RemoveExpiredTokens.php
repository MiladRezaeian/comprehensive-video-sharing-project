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
    protected $signature = 'tokens:remove_all {{--day=7 The number of days to retain expired tokens}}';

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
            $day = $this->option('day');
            $tokens = PersonalAccessToken::where('created_at', '<', now()->subMinutes($expiration + ($day * 24 * 60)));
            $tokens->delete();
            $this->info('Expired tokens have been deleted');

            return 0;
        }

        $this->warn('Expire time is not set.');
    }
}
