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
                'fio'       => 'Узумаки Наруто',
                'email'     => 'naruto@kz',
                'password'  => Hash::make('123123'),
                'school_id' => 1,
                'grade_id'  => null,
            ],
        ]);
    }
}
