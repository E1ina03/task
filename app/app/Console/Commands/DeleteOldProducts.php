<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Console\Command;

class DeleteOldProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-old-products {year} {month} {day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove products with created_at less than 2024';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $year = $this->argument('year');
        $month = $this->argument('month');
        $day = $this->argument('day');
        try {
            $deletedCount = Product::whereDate('created_at', '<', Carbon::createFromDate($year, $month, $day))->delete();
            $this->info("Deleted $deletedCount products.");
        } catch (\Exception $e) {
            $this->error("Error deleting products: " . $e->getMessage());
        }

        $this->info('Finished deleting old products.');
    }
}
