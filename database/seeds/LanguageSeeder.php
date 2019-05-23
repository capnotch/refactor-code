<?php

use Illuminate\Database\Seeder;
use App\Models\Languages; 
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = new Languages();
        $language->languagename = "Test";
        $language->save();
    }
}
