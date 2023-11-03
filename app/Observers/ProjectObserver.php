<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectObserver
{
    public function created(Project $project)
    {
        // Jalankan perintah SQL untuk mengupdate tabel stats
        DB::update('UPDATE stats SET projects_count = projects_count + 1');
    }
}
