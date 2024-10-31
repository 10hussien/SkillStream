<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;
use App\Models\CourseProject;
use Carbon\Carbon;

class UpdateProjectStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CourseProject:project_status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CourseProject project_status update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateNow = Carbon::now();


        $projects = CourseProject::all();


        foreach ($projects as $project) {

            if ($dateNow >= $project['project_start'] && $dateNow <= $project['project_end']) {

                $project['project_status'] = 'started';
            } elseif ($dateNow < $project['project_start']) {

                $project['project_status'] = 'Not start';
            } elseif ($dateNow > $project['project_end']) {

                $project['project_status'] = 'finshed';
            }


            $project->update();
        }


        $this->info('Project statuses updated successfully.');
    }
}
