<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BloodType;

class BloodTypeSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('blood_types')->delete();

        $blood = ['O-','O+','A-','A+','AB+','AB-'];
        foreach($blood as $blood)
        {
            BloodType::create([
                'type'=>$blood,
            ]);
        }
    }
}
