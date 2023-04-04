<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CountriesModel;

class Countries extends Seeder
{
    public function run()
    {
        $csvFile = fopen("data/countries.csv", "r");
        // It will automatically read file from /public/data folder.

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
				$object = new CountriesModel;
				$object->insert([
					"sortname" => $data['1'],
					"name" => $data['2'],
                    "phonecode" => $data['3']
				]);
            }
            $firstline = false;
        }

        fclose($csvFile);
        
    }
}

?>