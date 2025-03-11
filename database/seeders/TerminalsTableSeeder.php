<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Terminal;

class TerminalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFilePath = base_path("public/csv/terminals.csv");
        
        if (!file_exists($csvFilePath)) {
            $this->command->error("CSV file not found at: $csvFilePath");
            return;
        }
        
        $csvFile = fopen($csvFilePath, "r");
        
        DB::statement('PRAGMA foreign_keys = OFF;');
        
        $rowCount = 0;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            $rowCount++;
            
            // Skip header row if needed
            if ($rowCount === 1 && $data[0] === 'id') {
                continue;
            }
            
            // Print the first few rows to see the structure
            if ($rowCount <= 3) {
                $this->command->info("Row $rowCount: " . json_encode($data));
            }
            
            DB::table('terminals')->insert([
                'name' => trim($data[0], '"'),  // First column as name
                'city' => trim($data[1], '"'),  // Second column as city 
                'adress' => isset($data[2]) ? trim($data[2], '"') : null, // Third column as address
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        DB::statement('PRAGMA foreign_keys = ON;');
        
        fclose($csvFile);
        
        $this->command->info("Terminal data imported: $rowCount rows");
    }
}
