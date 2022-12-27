<?php

use App\Models\School;
use Illuminate\Database\Migrations\Migration;

class InsertSchoolsTable extends Migration
{
    public function up()
    {
        $schools = file_get_contents(storage_path('schools.json'));

        foreach (json_decode($schools) as $school) {
            School::create([
               'title'     => $school->title,
               'region_id' => $school->region_id,
            ]);
        }
    }

}
