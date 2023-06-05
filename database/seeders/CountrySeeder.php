<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path("assets/json/countries+states+cities.json");
        $json = file_get_contents($file);
        $countries = json_decode($json, true);

        $stateModels = [];
        $cityModels = [];
        foreach ($countries as $country) {
            $countryInsert = Country::create([
                'name' => $country['name'],
                'country' => $country['name'],
                'phone_code' => $country['phone_code'],
                'currency_code' => $country['currency'],
                'currency_name' => $country['currency_name'],
                'currency_symbol' => $country['currency_symbol'],
                'code' => $country['iso2'],
            ]);
            foreach ($country['states'] as $state) {
                $stateModels[] = [
                    'country_id' => $countryInsert->id,
                    'name' => $state['name'],
                    'state_code' => $state['state_code']
                ];
                foreach ($state['cities'] as  $city) {
                    $cityModels[] = [
                        'country_id' => $countryInsert->id,
                        'state_id' => null,
                        'state_name' => $state['name'],
                        'name' => $city['name']
                    ];
                }
            }
        }
        State::insert($stateModels);
        $states = State::get()->toArray();
        $totalItems = count($cityModels);
        $progressBar = $this->command->getOutput()->createProgressBar($totalItems*2);
        $progressBar->start();
        for ($i=0; $i < $totalItems; $i++) { 
            $city = $cityModels[$i];
            // $foundState = array_filter($states, function ($s) use($city){
            //     return $s['country_id']==$city['country_id'] && $s['name']==$city['state_name'];
            // });
            // $state = reset($foundState);
            // $city['state_id'] = $state['id'];
            // $progressBar->advance();
            for ($j=0; $j < count($states); $j++) { 
                $state = $states[$j];
                if($state['country_id']==$city['country_id'] && $state['name']==$city['state_name']) {
                    $cityModels[$i]['state_id'] = $state['id'];
                    $progressBar->advance();
                    break;
                }
            }
        }
        $citiesChunk = array_chunk($cityModels, 5000);
        foreach($citiesChunk as $cities) {
            City::insert($cities);
            $progressBar->advance(5000);
        }
        $progressBar->finish();
    }
}
