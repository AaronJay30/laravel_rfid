<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(30)->create();

    //     \App\Models\ThreeMonth::insert([
    //         [
    //             'THREEMID' => 1,
    //             'three_month_weight' => 190291.14052,
    //             'three_month_length' => 299108.2,
    //             'three_month_wither' => 2.48555,
    //         ], 
    //         [
    //             'THREEMID' => 2,
    //             'three_month_weight' => 29778510,
    //             'three_month_length' => 2466.7,
    //             'three_month_wither' => 4182.2,
    //         ], 
    //         [
    //             'THREEMID' => 3,
    //             'three_month_weight' => 41,
    //             'three_month_length' => 273971.8984818,
    //             'three_month_wither' => 10001801.6,
    //         ],
    //         [
    //             'THREEMID' => 4,
    //             'three_month_weight' => 1123997.5878342,
    //             'three_month_length' => 825695.01298219,
    //             'three_month_wither' => 767.203006126,
    //         ]
    //     ]);

    //     \App\Models\OneYear::insert([
    //         [
    //             'ONEYID' => 1,
    //             'one_year_weight' => 19.53549102,
    //             'one_year_length' => 2.72799329,
    //             'one_year_wither' => 5.4598978,
    //         ],
    //         [
    //             'ONEYID' => 2,
    //             'one_year_weight' => 694724.17948806,
    //             'one_year_length' => 262.194,
    //             'one_year_wither' => 226.06,
    //         ],
    //         [
    //             'ONEYID' => 3,
    //             'one_year_weight' => 52.116583,
    //             'one_year_length' => 3953969.8370839,
    //             'one_year_wither' => 25199,
    //         ],
    //         [
    //             'ONEYID' => 4,
    //             'one_year_weight' => 145.007,
    //             'one_year_length' => 19.2921,
    //             'one_year_wither' => 0,
    //         ],
    //     ]);

    //     \App\Models\SixMonth::insert([
    //         [
    //             'SIXMID' => 1,
    //             'six_month_weight' => 4523376.585921,
    //             'six_month_length' => 274086805.11023,
    //             'six_month_wither' => 0,
    //         ],
    //         [
    //             'SIXMID' => 2,
    //             'six_month_weight' => 1902278.1888303,
    //             'six_month_length' => 4892986.197,
    //             'six_month_wither' => 681462.33813193,
    //         ],
    //         [
    //             'SIXMID' => 3,
    //             'six_month_weight' => 55262772.09,
    //             'six_month_length' => 1579.921,
    //             'six_month_wither' => 7339336,
    //         ],
    //         [
    //             'SIXMID' => 4,
    //             'six_month_weight' => 1.0925274,
    //             'six_month_length' => 3.10770686,
    //             'six_month_wither' => 0,
    //         ],
    //     ]);

    //     \App\Models\NineMonth::insert([
    //         [
    //             'NINEMID' => 1,
    //             'nine_month_weight' => 1,
    //             'nine_month_length' => 1759.93414173,
    //             'nine_month_wither' => 647682.13824246,
    //         ],
    //         [
    //             'NINEMID' => 2,
    //             'nine_month_weight' => 104.2,
    //             'nine_month_length' => 0,
    //             'nine_month_wither' => 7529.93,
    //         ],
    //         [
    //             'NINEMID' => 3,
    //             'nine_month_weight' => 14065.084,
    //             'nine_month_length' => 0,
    //             'nine_month_wither' => 3586.38383108,
    //         ],
    //         [
    //             'NINEMID' => 4,
    //             'nine_month_weight' => 157276153.71671,
    //             'nine_month_length' => 87740.3800496,
    //             'nine_month_wither' => 41214.26,
    //         ],
    //     ]);

    //     \App\Models\BirthInfo::insert([
    //         [
    //             'BID' => 1,
    //             'birth_date' => '1999-07-08',
    //             'birth_season' => 'November',
    //             'birth_type' => 'earum',
    //             'milk_type' => 'quia',
    //         ],
    //         [
    //             'BID' => 2,
    //             'birth_date' => '2006-05-05',
    //             'birth_season' => 'February',
    //             'birth_type' => 'repellat',
    //             'milk_type' => 'et',
    //         ],
    //         [
    //             'BID' => 3,
    //             'birth_date' => '1983-11-16',
    //             'birth_season' => 'May',
    //             'birth_type' => 'recusandae',
    //             'milk_type' => 'atque',
    //         ],
    //         [
    //             'BID' => 4,
    //             'birth_date' => '1972-12-31',
    //             'birth_season' => 'February',
    //             'birth_type' => 'fugiat',
    //             'milk_type' => 'illo',
    //         ],
    //     ]);

    //     \App\Models\Characteristic::insert([
    //         [
    //             'CID' => 1,
    //             'jaw' => 'omnis',
    //             'ear' => 'id',
    //             'body' => 'impedit',
    //             'teat' => 'non',
    //             'horn' => 'expedita',
    //         ],
    //         [
    //             'CID' => 2,
    //             'jaw' => 'consequuntur',
    //             'ear' => 'est',
    //             'body' => 'ab',
    //             'teat' => 'quas',
    //             'horn' => 'sint',
    //         ],
    //         [
    //             'CID' => 3,
    //             'jaw' => 'aperiam',
    //             'ear' => 'qui',
    //             'body' => 'nulla',
    //             'teat' => 'facilis',
    //             'horn' => 'omnis',
    //         ],
    //         [
    //             'CID' => 4,
    //             'jaw' => 'est',
    //             'ear' => 'quidem',
    //             'body' => 'labore',
    //             'teat' => 'non',
    //             'horn' => 'omnis',
    //         ],
    //     ]);

    //     \App\Models\LivestockInfo::insert([
    //         [
    //             'IID' => 1,
    //             'given_name' => 'JOSH',
    //             'farm_name' => 'SRC',
    //             'sex' => 'Male',
    //             'breed' => 'Alphine',
    //             'sire' => 'NONE',
    //             'dam' => 'NON',
    //             'birth_date' => '1987-03-12',
    //         ],
    //         [
    //             'IID' => 2,
    //             'given_name' => 'JOSH2',
    //             'farm_name' => 'SRC',
    //             'sex' => 'Male',
    //             'breed' => 'Saanen',
    //             'sire' => 'NONE',
    //             'dam' => 'NON',
    //             'birth_date' => '1987-03-12',
    //         ],
    //         [
    //             'IID' => 3,
    //             'given_name' => 'JOSH3',
    //             'farm_name' => 'SRC',
    //             'sex' => 'Female',
    //             'breed' => 'Boer',
    //             'sire' => 'NONE',
    //             'dam' => 'NON',
    //             'birth_date' => '1987-03-12',
    //         ],
    //         [
    //             'IID' => 4,
    //             'given_name' => 'JOSH4',
    //             'farm_name' => 'SRC',
    //             'sex' => 'Female',
    //             'breed' => 'Algo Nubian',
    //             'sire' => 'NONE',
    //             'dam' => 'NON',
    //             'birth_date' => '1987-03-12',
    //         ],
    //     ]);

    //     \App\Models\LivestockRegistration::insert([
    //         [
    //             'RFID_TAG' => 1117,
    //             'IID' => 1,
    //             'CID' => 1,
    //             'BID' => 1,
    //             'NINEMID' => 1,
    //             'SIXMID' => 1,
    //             'THREEMID' => 1,
    //             'ONEYID' => 1,
    //         ],
    //         [
    //             'RFID_TAG' => 1118,
    //             'IID' => 2,
    //             'CID' => 2,
    //             'BID' => 2,
    //             'NINEMID' => 2,
    //             'SIXMID' => 2,
    //             'THREEMID' => 2,
    //             'ONEYID' => 2,
    //         ],
    //         [
    //             'RFID_TAG' => 1119,
    //             'IID' => 3,
    //             'CID' => 3,
    //             'BID' => 3,
    //             'NINEMID' => 3,
    //             'SIXMID' => 3,
    //             'THREEMID' => 3,
    //             'ONEYID' => 3,
    //         ],
    //         [
    //             'RFID_TAG' => 1120,
    //             'IID' => 4,
    //             'CID' => 4,
    //             'BID' => 4,
    //             'NINEMID' => 4,
    //             'SIXMID' => 4,
    //             'THREEMID' => 4,
    //             'ONEYID' => 4,
    //         ],
    //     ]);
     }
}
