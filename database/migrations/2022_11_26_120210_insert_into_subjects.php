<?php

use Illuminate\Database\Migrations\Migration;

class InsertIntoSubjects extends Migration
{
    public function up()
    {
        DB::table('subjects')->insert([
            [
                'id' => 1,
                'image_path' => 'assets/tree.png',
                'color' => '#545AE8',
                'name' => json_encode([
                    'ru' => 'Математическая грамотность',
                ]),
                'required' => true,
                'siblings' => '[]',
            ],
            [
                'id' => 2,
                'image_path' => 'assets/literature.png',
                'color' => '#23BDEE',
                'name' => json_encode([
                    'ru' => 'Грамотность чтения',
                ]),
                'required' => true,
                'siblings' => '[]',
            ],
            [
                'id' => 3,
                'image_path' => 'assets/history.png',
                'color' => '#EDB021',
                'name' => json_encode([
                    'ru' => 'История Казахстана',
                ]),
                'required' => true,
                'siblings' => '[]',
            ],

            [
                'id' => 4,
                'image_path' => 'assets/biology.png',
                'color' => '#F25471',
                'name' => json_encode([
                    'ru' => 'Биология',
                ]),
                'required' => false,
                'siblings' => '[5, 12]',
            ],
            [
                'id' => 5,
                'image_path' => 'assets/chemistry.png',
                'color' => '#177998',
                'name' => json_encode([
                    'ru' => 'Химия',
                ]),
                'required' => false,
                'siblings' => '[4, 13]',
            ],
            [
                'id' => 6,
                'image_path' => 'assets/medicine.png',
                'color' => '#5BEB7B',
                'name' => json_encode([
                    'ru' => 'Иностранный язык',
                ]),
                'required' => false,
                'siblings' => '[]',
            ],
            [
                'id' => 7,
                'image_path' => 'assets/books.png',
                'color' => '#A79A51',
                'name' => json_encode([
                    'ru' => 'Основы права',
                ]),
                'required' => false,
                'siblings' => '[]',
            ],
            [
                'id' => 8,
                'image_path' => 'assets/flag.png',
                'color' => '#7A7DBB',
                'name' => json_encode([
                    'ru' => 'Иностранный язык',
                ]),
                'required' => false,
                'siblings' => '[]',
            ],
            [
                'id' => 9,
                'image_path' => 'assets/paris.png',
                'color' => '#EDB021',
                'name' => json_encode([
                    'ru' => 'Иностранный язык',
                ]),
                'required' => false,
                'siblings' => '[]',
            ],
            [
                'id' => 10,
                'image_path' => 'assets/book.png',
                'color' => '#4B9779',
                'name' => json_encode([
                    'ru' => 'Русская литература',
                ]),
                'required' => false,
                'siblings' => '[]',
            ],
            [
                'id' => 11,
                'image_path' => 'assets/math.png',
                'color' => '#B06371',
                'name' => json_encode([
                    'ru' => 'Математика',
                ]),
                'required' => false,
                'siblings' => '[12, 13]',
            ],
            [
                'id' => 12,
                'image_path' => 'assets/geography.png',
                'color' => '#23BDEE',
                'name' => json_encode([
                    'ru' => 'География',
                ]),
                'required' => false,
                'siblings' => '[11, 4]',
            ],
            [
                'id' => 13,
                'image_path' => 'assets/physics.png',
                'color' => '#545AE8',
                'name' => json_encode([
                    'ru' => 'Физика',
                ]),
                'required' => false,
                'siblings' => '[11, 5]',
            ],

        ]);
    }
}
