<?php

namespace App\Console\Commands;

use App\Jobs\CertificateCheck;
use App\Jobs\DnsCheck;
use App\Website;
use Illuminate\Console\Command;

class ScanDnsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:dns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Website::all()->each(function (Website $website) {
            DnsCheck::dispatch($website);
            dump('DNS check queued for ' . $website->url);
        });
    }
}