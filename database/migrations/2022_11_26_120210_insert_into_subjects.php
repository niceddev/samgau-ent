<?php

use Illuminate\Database\Migrations\Migration;

class InsertIntoSubjects extends Migration
{
    public function up()
    {
        DB::table('subjects')->insert([
            [
                'id' => 1,
                'image_path' => 'assets/mathematical_literacy.png',
                'color' => '#545AE8',
                'name' => json_encode([
                    'ru' => 'Математическая грамотность',
                    'kk' => 'Математикалық сауаттылық',
                ]),
                'required' => true,
                'siblings' => '[]',
            ],
            [
                'id' => 2,
                'image_path' => 'assets/reading_literacy.png',
                'color' => '#23BDEE',
                'name' => json_encode([
                    'ru' => 'Грамотность чтения',
                    'kk' => 'Оқу сауаттылығы',
                ]),
                'required' => true,
                'siblings' => '[]',
            ],
            [
                'id' => 3,
                'image_path' => 'assets/history_of_kazakhstan.png',
                'color' => '#EDB021',
                'name' => json_encode([
                    'ru' => 'История Казахстана',
                    'kk' => 'Қазақстан тарихы',
                ]),
                'required' => true,
                'siblings' => '[]',
            ],

            [
                'id' => 4,
                'image_path' => 'assets/world_history.png',
                'color' => '#B06371',
                'name' => json_encode([
                    'ru' => 'Всемирная история',
                    'kk' => 'Дүние жүзі тарихы',
                ]),
                'required' => false,
                'siblings' => '[7, 13, 14]',
            ],
            [
                'id' => 5,
                'image_path' => 'assets/physics.png',
                'color' => '#545AE8',
                'name' => json_encode([
                    'ru' => 'Физика',
                    'kk' => 'Физика',
                ]),
                'required' => false,
                'siblings' => '[12, 8]',
            ],
            [
                'id' => 6,
                'image_path' => 'assets/biology.png',
                'color' => '#629EB1',
                'name' => json_encode([
                    'ru' => 'Биология',
                    'kk' => 'Биология',
                ]),
                'required' => false,
                'siblings' => '[12, 13]',
            ],
            [
                'id' => 7,
                'image_path' => 'assets/fundamentals_of_law.png',
                'color' => '#B253ED',
                'name' => json_encode([
                    'ru' => 'Основы права',
                    'kk' => 'Құқық негіздері',
                ]),
                'required' => false,
                'siblings' => '[4]',
            ],
            [
                'id' => 8,
                'image_path' => 'assets/math.png',
                'color' => '#177998',
                'name' => json_encode([
                    'ru' => 'Математика',
                    'kk' => 'Математика',
                ]),
                'required' => false,
                'siblings' => '[13, 5, 15]',
            ],
            [
                'id' => 9,
                'image_path' => 'assets/rus_lang.png',
                'color' => '#7A7DBB',
                'name' => json_encode([
                    'ru' => 'Русския язык',
                    'kk' => 'Орыс тілі',
                ]),
                'required' => false,
                'siblings' => '[]',
            ],
            [
                'id' => 10,
                'image_path' => 'assets/kaz_lang.png',
                'color' => '#A79A51',
                'name' => json_encode([
                    'ru' => 'Казахский язык',
                    'kk' => 'Қазақ тілі',
                ]),
                'required' => false,
                'siblings' => '[11]',
            ],
            [
                'id' => 11,
                'image_path' => 'assets/kaz_literature.png',
                'color' => '#4B9779',
                'name' => json_encode([
                    'ru' => 'Казахская литература',
                    'kk' => 'Қазақ әдебиеті',
                ]),
                'required' => false,
                'siblings' => '[10]',
            ],
            [
                'id' => 12,
                'image_path' => 'assets/chemistry.png',
                'color' => '#23BDEE',
                'name' => json_encode([
                    'ru' => 'Химия',
                    'kk' => 'Химия',
                ]),
                'required' => false,
                'siblings' => '[5, 6]',
            ],
            [
                'id' => 13,
                'image_path' => 'assets/geography.png',
                'color' => '#F25471',
                'name' => json_encode([
                    'ru' => 'География',
                    'kk' => 'География',
                ]),
                'required' => false,
                'siblings' => '[14, 6, 4, 8]',
            ],
            [
                'id' => 14,
                'image_path' => 'assets/flag.png',
                'color' => '#FC6434',
                'name' => json_encode([
                    'ru' => 'Иностранный язык',
                    'kk' => 'Шет тілі',
                ]),
                'required' => false,
                'siblings' => '[4, 13]',
            ],
            [
                'id' => 15,
                'image_path' => 'assets/informatics.png',
                'color' => '#5BEB7B',
                'name' => json_encode([
                    'ru' => 'Информатика',
                    'kk' => 'Информатика',
                ]),
                'required' => false,
                'siblings' => '[8]',
            ]

        ]);
    }
}
