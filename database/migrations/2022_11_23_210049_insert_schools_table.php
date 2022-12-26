<?php

use App\Models\School;
use Illuminate\Database\Migrations\Migration;

class InsertSchoolsTable extends Migration
{
    public function up()
    {
        $schools = file_get_contents(storage_path('schools.txt'));

        dd(json_decode($schools));
//        foreach (json_decode($schools) as $school) {
//            dd($school);
//            School::create([
//               'title'     => $school->title,
//               'region_id' => $school->region_id,
//            ]);
//        }
    }

}
