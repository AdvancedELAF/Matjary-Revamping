<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CitiesModel;

class Cities extends Seeder
{
    public function run()
    {
        $csvFile = fopen("data/cities.csv", "r");
        // It will automatically read file from /public/data folder.

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
				$object = new CitiesModel;
				$object->insert([
					"name" => $data['1'],
					"state_id" => $data['2']
				]);
            }
            $firstline = false;
        }

        fclose($csvFile);
        
    }
}

?>