<?php

namespace App\Jobs;

use App\Imports\OrdersImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportOrdersAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $uploadFile ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(  $uploadFile)
    {
       $this->uploadFile =$uploadFile ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Excel::import(new OrdersImport, $this->uploadFile);
    }
}
