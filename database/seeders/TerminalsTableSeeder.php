<?php

namespace Database\Seeders;

use App\Models\Terminal;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

class TerminalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFilePath = public_path('csv/terminals.csv');
        
        if (!file_exists($csvFilePath)) {
            $this->command->error("CSV file not found at: $csvFilePath");
            return;
        }
        
        $count = 0;
        
        LazyCollection::make(function () use ($csvFilePath) {
            $handle = fopen($csvFilePath, 'r');
            
            // Skip header row
            fgetcsv($handle);
            
            while (($data = fgetcsv($handle, 2000, ",")) !== false) {
                yield $data;
            }
            
            fclose($handle);
        })
        ->each(function ($data) use (&$count) {
            Terminal::create([
                'name' => trim($data[0], '"'),
                'city' => trim($data[1], '"'),
                'address' => isset($data[2]) ? trim($data[2], '"') : null,
            ]);
            
            $count++;
        });
        
        $this->command->info("Terminal data imported: $count rows");
    }
}
