<?php

use Illuminate\Database\Seeder;
use App\Task;


class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $seed_data = array(
            array("SRS_CREATION","2019-01-01",NULL,12,NULL,NULL,NULL),
            array("WIREFRAMING",NULL,NULL,12,1,"start",4),
            array("UX_DESIGN",NULL,NULL,12,1,"end",0),
            array("UI_HTML",NULL,NULL,12,3,"start",4),
            array("ALGORITHM_design",NULL,NULL,12,3,"end",0),
            array("CONCEPT_SIGNOFF",NULL,NULL,3,5,"end",4),
            array("DATABASE_SCHEMA_DESIGN",NULL,NULL,12,1,"end",0),
            array("SOFTWARE DESIGN PATTERN FINALIZATION",NULL,NULL,5,NULL,NULL,NULL),
            array("CREATING MODEL REPRESENTATIONS IN DATA MAPPER PATTERN",NULL,NULL,7,7,"start",4),
            array("ROUTING DEFINITIONS",NULL,NULL,12,8,"end",0),
            array("MODULE DEVELOPMENT",NULL,NULL,35,10,"start",4),
            array("UNIT TEST DEVELOPMENT",NULL,NULL,35,12,"start",0),
            array("BUILD CREATION",NULL,NULL,2,13,"end",0),
        );

        for ($i=0; $i < count($seed_data); $i++) { 
                $task = Task::create([
                            'task_name' => (empty($seed_data[$i][0]) ? NULL : $seed_data[$i][0]),
                            'start_date' => (empty($seed_data[$i][1]) ? NULL : $seed_data[$i][1]),
                            'end_date' => (empty($seed_data[$i][2]) ? NULL : $seed_data[$i][2]),
                            'duration' => (empty($seed_data[$i][3]) ? NULL : $seed_data[$i][3]),
                            'dependancy_task' => (empty($seed_data[$i][4]) ? NULL : $seed_data[$i][4]),
                            'dependancy_condition' => (empty($seed_data[$i][5]) ? NULL : $seed_data[$i][5]),
                            'dependancy_days' => (empty($seed_data[$i][6]) ? NULL : $seed_data[$i][6]),
                            'description' => 'description_'.($i+1),
                            'status' => 'seed',
                            ]);
        }
        
    }
}
