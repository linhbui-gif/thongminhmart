<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product_products;

class UpdateStt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateStt';
    protected $table = 'product_products';

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
     * @return int
     */
    public function handle()
    {
        \Log::info('update stt');
        $products = \Illuminate\Support\Facades\DB::table("product_products")->get();
        foreach($products as $k => $product) {
            $random = rand(1,1000);
            \Illuminate\Support\Facades\ DB::table('product_products')
                ->where('id', $product->id)
                ->update(['stt' => $random]);
        }
    }
}
