<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Jobs
        $hourly = 1;
        $salary = 2;

        $assemblyPositions = array(
            'assembler',
        );
        foreach($assemblyPositions as $assemblyPosition){
            $addPosition = new Position();
            $addPosition->description = $assemblyPosition;
            $addPosition->save();
            $addPosition->job()->sync([$hourly]);
            $addPosition->wageTitle()->sync([2]);
        }

        $technicalPositions = array(
            'checmical floor support technician',
            'floor support technician',
            'machine operator component',
            'machine operator scroll',
            'material handler',
            'production quality auditor',
            'support documentation',
        );
        foreach($technicalPositions as $technicalPosition){
            $addPosition = new Position();
            $addPosition->description = $technicalPosition;
            $addPosition->save();
            $addPosition->job()->sync([$hourly]);
            $addPosition->wageTitle()->sync([3]);
        }

        $specialistPositions = array(
            'specialist guage',
            'specialist iso',
            'specialist maintenance',
            'specialist manufacturing',
            'specialist operations',
            'specialist teardown',
            'specialist welding',
        );
        foreach($specialistPositions as $specialistPosition){
            $addPosition = new Position();
            $addPosition->description = $specialistPosition;
            $addPosition->save();
            $addPosition->job()->sync([$hourly]);
            $addPosition->wageTitle()->sync([4]);
        }

        $maintenancePositions = array(
            'machinist',
            'maintenance assembly',
            'maintenance component',
            'maintenance facilities',
            'maintenance scroll',
            'maintenance leader',
        );
        foreach($maintenancePositions as $maintenancePosition){
            $addPosition = new Position();
            $addPosition->description = $maintenancePosition;
            $addPosition->save();
            $addPosition->job()->sync([$hourly]);
            $addPosition->wageTitle()->sync([5]);
        }

        $salaryPositions = array(
            'administrative assistant',
            'administrator it lan sr',
            'analyst financial',
            'analyst it',
            'analyst materials',
            'clerk hr',
            'clerk payroll',
            'college student',
            'controller plant',
            'controller plant assistant',
            'coordinator engineering change',
            'coordinator hr',
            'coordinator project administrative',
            'corporate sydney',
            'customer service representative',
            'engineer environmental',
            'engineer industrial',
            'engineer lead',
            'engineer manufacturing',
            'engineer manufacturing sr',
            'engineer production',
            'engineer quality',
            'generalist hr',
            'manager customer service',
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
            'team leader assembly maintenance',
            'technician calorimeter',
            'technician project',
            'director of operations',
            'engineer automation',
            'engineer safety',
            'lean champion',
            'engineer lean',
            'engineer special projects',
            'engineer lean sr',
        );

        foreach($salaryPositions as $salaryPosition){
            $addPosition = new Position();
            $addPosition->description = $salaryPosition;
            $addPosition->save();
            $addPosition->job()->sync([$salary]);
            $addPosition->wageTitle()->sync([1]);
        }
    }
}
