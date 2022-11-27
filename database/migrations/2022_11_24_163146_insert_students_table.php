<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InsertStudentsTable extends Migration
{
    public function up()
    {
        DB::table('students')->insert([
            [
                'login'    =>  'naruto',
                'password' =>  Hash::make('123123'),
                'fio'      =>  'Узумаки Наруто',
                'grade_id' =>  null,
            ],
        ]);
    }
}
