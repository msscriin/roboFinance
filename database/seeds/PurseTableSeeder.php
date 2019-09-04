<?php

use Illuminate\Database\Seeder;

class PurseTableSeeder extends Seeder
{
    protected $arrPurses = array('1:123456789:10000',
        '2:987654321:10000',
        '3:789123456:10000',
        '4:654321987:10000',
        '5:321987654:10000',
        '6:741852963:10000',
        '7:369852147:10000');

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach( $this->arrPurses as $value ) {
            $arrDataPurse = explode(":", $value);
            DB::table('Purses')->insert([
                'idUsers' => $arrDataPurse[0],
                'Score' => $arrDataPurse[1],
                'suma' => $arrDataPurse[2],
                'created_at' => DB::raw("'2019-07-15 12:00:00'"),
            ]);
        }
    }
}
