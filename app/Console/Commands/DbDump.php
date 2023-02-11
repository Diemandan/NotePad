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
        $mysqldump = '  mysqldump --host db -u root  -padmin notepad > /var/www/storage/db-dumps/notepad' . '-' . date('Y-m-d-h:i:s') . '.sql' ;
        $output = array();

        exec($mysqldump, $output);
   }
}
