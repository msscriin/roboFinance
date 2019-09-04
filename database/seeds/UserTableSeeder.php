<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{

    protected $arrUser = array('Петров:Семен:Семенович:pss1:12345',
        'Сидоров:Антон:Петрович:sap2:11345',
        'Сергеева:Антонина:Васильевна:sav3:13345',
        'Новиков:Михаил:Андреевич:nma3:12445',
        'Павлова:Мирослава:Тимофеевна:pmt4:12445',
        'Сухов:Максим:Генадьевич:smg5:12355',
        'Семенов:Семен:Семенович:sss6:12346');

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach( $this->arrUser as $value ) {
            $arrDataUser = explode(":", $value);
            DB::table('Users')->insert([
                'LastName' => $arrDataUser[0],
                'OldName' => $arrDataUser[1],
                'UserName' => $arrDataUser[2],
                'login' => $arrDataUser[3],
                'password' => Hash::make($arrDataUser[4])
            ]);
        }
    }
}
