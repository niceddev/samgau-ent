<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertRegionsTable extends Migration
{
    public function up()
    {
        DB::table('regions')->insert([
            [
                'title' => 'Қарқаралы ауданы',
            ],
            [
                'title' => 'Бұқар – жырау ауданы',
            ],
            [
                'title' => 'Нұра ауданы',
            ],
            [
                'title' => 'Абай ауданы',
            ],
            [
                'title' => 'Шет ауданы',
            ],
            [
                'title' => 'Ақтоғай ауданы',
            ],
            [
                'title' => 'Осакаровка ауданы',
            ],
            [
                'title' => 'Теміртау',
            ],
            [
                'title' => 'Балқаш қаласы',
            ],
            [
                'title' => 'Шахтинск',
            ],
            [
                'title' => 'Саран',
            ],
            [
                'title' => 'Приозерск',
            ],
        ]);
    }
}
