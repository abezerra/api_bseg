<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Pdf2Html extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:2html {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PARSE pdf file to html file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }
}
