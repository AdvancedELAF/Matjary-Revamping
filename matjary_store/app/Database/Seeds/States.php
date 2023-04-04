<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\StatesModel;

class States extends Seeder
{
    public function run()
    {
        $csvFile = fopen("data/states.csv", "r");
        // It will automatically read file from /public/data folder.

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
				$object = new StatesModel;
				$object->insert([
					"short_code" => $data['1'],
					"name" => $data['2'],
					"country_id" => $data['3']
				]);
            }
            $firstline = false;
        }

        fclose($csvFile);
      
    }
}

?>