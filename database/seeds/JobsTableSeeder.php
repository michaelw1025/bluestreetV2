<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assemblyJobs = array(
            'assembler',
        );
        foreach($assemblyJobs as $assemblyJob){
            $addJob = new Job();
            $addJob->description = $assemblyJob;
            $addJob->save();
        }





        $technicalJobs = array(
            'checmical floor support technician',
            'floor support technician',
            'machine operator component',
            'machine operator scroll',
            'material handler',
            'production quality auditor',
            'support documentation',
        );
        foreach($technicalJobs as $technicalJob){
            $addJob = new Job();
            $addJob->description = $technicalJob;
            $addJob->save();
        }




        $specialistJobs = array(
            'specialist guage',
            'specialist iso',
            'specialist maintenance',
            'specialist manufacturing',
            'specialist operations',
            'specialist teardown',
            'specialist welding',
        );
        foreach($specialistJobs as $specialistJob){
            $addJob = new Job();
            $addJob->description = $specialistJob;
            $addJob->save();
        }




        $maintenanceJobs = array(
            'machinist',
            'maintenance assemly',
            'maintenance component',
            'maintenance facilities', 
            'maintenance scroll', 
            'maintenance leader',
        );
        foreach($maintenanceJobs as $maintenanceJob){
            $addJob = new Job();
            $addJob->description = $maintenanceJob;
            $addJob->save();
        }





        $salaryJobs = array(
            'administrative assistant',
            'administrator it lan sr',
            'analyst financial',
            'analyst it',
            'analyst materials',
            'clerk payroll',
            'college student',
            'controller plant', 
            'controller plant assistant',
            'coordinator engineering change',
            'coordinator hr',
            'coordinator project administrative',
            'engineer environmental',
            'engineer industrial',
            'engineer lead',
            'engineer manufacturing',
            'engineer manufacturing sr',
            'engineer production',
            'engineer quality',
            'generalist hr',
            'manager employee relations',
            'manager facilities and maintenance',
            'manager hr',
            'manager manufacturing services',
            'manager materials',
            'manager operations',
            'manager quality',
            'manager team',
            'manager technical team',
            'materials coordinator',
            'project leader materials',
            'scheduler',
            'supervisor materials',
            'team leader assembly',
            'team leader iso and quality systems',
            'team leader machining',
            'team leader materials',
            'team leader quality',
            'technician calorimeter',
            'technician project'
        );

        foreach($salaryJobs as $salaryJob){
            $addJob = new Job();
            $addJob->description = $salaryJob;
            $addJob->save();
        }
    }
}
