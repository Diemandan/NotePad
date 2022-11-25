<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notepad:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make dump of your dataBase to: storage/db-dumps';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $mysqldump = '  mysqldump -u admin  -padmin notepad > /var/www/notepad/storage/db-dumps/notepad_' . date('d.m.y') . '.sql';
        $output = array();

        exec($mysqldump, $output);
    }
}
