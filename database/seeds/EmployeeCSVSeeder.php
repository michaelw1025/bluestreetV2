<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Employee;
use App\CostCenter;
use App\Position;
use App\Job;
use App\Shift;

class EmployeeCSVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::disableQueryLog();
      DB::table('employees')->truncate();

      $file = public_path().'/csvs/employees.csv';

      $csv = Reader::createFromPath($file, 'r');
      $csv->setHeaderOffset(0);

      $header = $csv->getHeader(); //returns the CSV header record
      $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

      foreach($records as $record){
        // Set gender
        if($record['gender'] === "M"){
          $gender = "male";
        }elseif($record['gender'] === "F"){
          $gender = 'female';
        }else{
          $gender = 'none';
        }

        $employee = Employee::create([
            'first_name' => $record['first_name'],
            'last_name' => $record['last_name'],
            'middle_initial' => null,
            'ssn' => $record['ssn'],
            'oracle_number' => null,
            'birth_date' => $record['birth_date'],
            'hire_date' => $record['hire_date'],
            'service_date' => $record['service_date'],
            'maiden_name' => null,
            'nick_name' => null,
            'gender' => $gender,
            'suffix' => null,
            'address_1' => $record['address_1'],
            'address_2' => null,
            'city' => $record['city'],
            'state' => $record['state'],
            'zip_code' => $record['zip_code'],
            'county' => null,
            'status' => 1,
            'rehire' => 1,
            'bid_eligible' => 1,
            'bid_eligible_date' => null,
            'bid_eligible_comment' => null,
            'thirty_day_review' => null,
            'sixty_day_review' => null,
            'photo_link' => null,
        ]);

        if($employee){
          // Save Cost center
          $costCenter = CostCenter::where('number', $record['cost_center'])->first();
          $employee->costCenter()->sync($costCenter['id']);

          // Save position

          // assembler
          $assembler = array(
            "Aassembler",
            "Assembler",
            "Assembly",
      			"Assmebler"
          );
          // checmical floor support technician
          $chemicalFloorSupportTechnician = array(
            "Chem Team"
          );
          // floor support technician
          $floorSupportTechnician = array(
            "Assembly -  FST",
            "Assembly - FST",
            "Assembly FST"
          );
          // machine operator component
          $machineOperatorComponent = array(
            "Machine Oper Comp",
            "Machine Operator Comp"
          );
          // machine operator scroll
          $machineOperatorScroll = array(
            "Machine Operator - Scroll",
            "Machine Operator Scroll",
            "Scroll Mach Oper",
            "Scroll Machine Operator"
          );
          // material handle
          $materialHandler = array(
            "Assembly Material Handler",
						"Material Handler",
						"Material Handler - Assembly",
						"Material Handler-Assembly"
          );
          // production quality auditor
          $productionQualityAuditor = array(
            "Quality Auditor",
						"Quality Auditor - FST"
          );
          // support documentation
          $supportDocumentation = array(
            "HR Support"
          );
          // specialist guage
          $specialistGuage = array(
            "Gauge Specialist"
          );
          // specialist iso
          $specialistISO = array(
            "ISO Specialist"
          );
          // specialist maintenance
          $specialistMaintenance = array(
            "Maintenance Specialist - Assembly",
						"Maintenance Specialist - Comp",
						"Maintenance Specialist - Scroll"
          );
          // specialist manufacturing
          $specialisstManufacturing = array(
            "Manufacturing Specialist - Assembly",
						"Manufacturing Specialist - Comp",
						"Manufacturing Specialist - Quality",
						"Manufacturing Specialist - Scroll",
						"Manufacturing Specialist - Tool Room"
          );
          // specialist operations
          $specialistOperations = array(
            "Operation Specialist - Assembly",
						"Operation Specialist - Chem",
						"Operation Specialist - Materials",
						"Operations Specialist - Scroll"
          );
          // specialist teardown
          $specialistTeardown = array(
            "Teardown Specialist"
          );
          // specialist welding
          $specialistWelding = array(
            "Welding Specialist - Assembly"
          );
          // machinist
          $machinist = array(
            "Machinist - Tool Room",
            "Machinist -Tool Room"
          );
          // maintenance assembly
          $maintenanceAssembly = array(
            "Maintenance - Assembly"
          );
          // maintenance component
          $maintenanceComponent = array(
            "Maintenance -  Component",
            "Maintenance - Component"
          );
          // maintenance facilities
          $maintenanceFacilities = array(
            "Maintenance - Facilities"
          );
          // maintenance scroll
          $maintenanceScroll = array(
            "Maintenance - Scroll"
          );
          // maintenance leader
          $maintenanceLeader = array(

          );
          // administrative assistant
          $administrativeAssistant = array(
            "Admin. Asst."
          );
          // administrator it lan sr
          $adminstratorITLanSR = array(
            "MIS - Analyst"
          );
          // analyst financial
          $analystFinancial = array(
            "Finance",
            "Sr. Financial Analyst"
          );
          // analyst it
          $analystIT = array(
            "MIS Analyst"
          );
          // analyst materials
          $analystMaterials = array(
            "Material Analyst"
          );
          // clerk payroll
          $clerkPayroll = array(
            "Payroll Clerk"
          );
          // clerk hr
          $clerkHR = array(
            "H.R. Clerk"
          );
          // college student
          $collegeStudent = array(
            "Assembly - Co-op",
						"Co-op",
						"Engineering Co-op"
          );
          // controller plant
          $controllerPlant = array(
            "Controller"
          );
          // controller plant assistant
          $controllerPlantAssistant = array(

          );
          // coordinator engineering change
          $coordinatorEngineeringChange = array(

          );
          // coordinator hr
          $coordinatorHR = array(
            "H.R. Cordinator",
            "HR Coordinator"
          );
          // coordinator project administrative
          $coordinatorProjectAdministrative = array(
            "Project Control Coordinator"
          );
          // engineer environmental
          $engineerEnvironmental = array(
            "Environmental Engineer"
          );
          // engineer industrial
          $engineerIndustrial = array(
            "IE",
						"Ind Engineer",
						"Industrial Engineer"
          );
          // engineer lead
          $engineerLead = array(

          );
          // engineer manufacturin
          $engineerManufacturing = array(
            "Eng. MFG",
						"Engineer - MFG",
						"Engineer Mfg",
						"Manufacturing Engineer - Scroll",
						"Mfg Eng",
						"MFG Engineer"
          );
          // engineer manufacturing sr
          $engineerManufacturingSR = array(
            "Sr. Mfg Engineer"
          );
          // engineer production
          $engineerProduction = array(
            "Engineer-Prodn",
						"Production Engineer",
						"Production Engineer - Assembly",
						"Production Engineer - Machining",
						"Production Engineer- Assembly"
          );
          // engineer quality
          $engineerQuality = array(
            "Engineer - Quality",
            "Quality Engineer"
          );
          // generalist hr
          $generalistHR = array(
            "HR Generalist"
          );
          // manager employee relations
          $managerEmployeeRelations = array(
            "Employee Relations Mgr"
          );
          // manager facilities and maintenance
          $managerFacilitiesAndMaintenance = array(

          );
          // manager hr
          $managerHR = array(
            "HR Manager"
          );
          // manager manufacturing services
          $managerManufacturingServices = array(
            "Mgr MFG"
          );
          // manager materials
          $managerMaterials = array(

          );
          // manager operations
          $managerOperations = array(
            "Assembly Manager",
            "Scroll Manager"
          );
          // manager quality
          $managerQuality = array(
            "Quality Manager"
          );
          // manager team
          $managerTeam = array(
            "TM Assembly",
  					"TM Component",
  					"TM Materials",
  					"TM Scroll",
  					"TM Tech",
  					"TM Warehouse"
          );
          // manager technical team

          // materials coordinator

          // project leader materials

          // scheduler
          $scheduler = array(
            "Scheduler"
          );
          // supervisor materials

          // team leader assembly
          $teamLeaderAssembly = array(
            "TL Assembly"
          );
          // team leader iso and quality systems
          $teamLeaderISOAndQualitySystems = array(
            "TL ISO Quality"
          );
          // team leader machining
          $teamLeaderMachining = array(
            "Scroll Team Leader",
						"TL Component",
						"TL Scroll"
          );
          // team leader materials
          $teamLeaderMaterials = array(
            "Materials Supervisor",
            "TL Materials"
          );
          // team leader quality
          $teamLeaderQuality = array(
            "TL Quality"
          );
          // technician calorimeter
          $technicianCalorimeter = array(
            "Cal Lab Tech"
          );
          // technician project
          $technicianProject = array(
            "Project Tech"
          );
          // corporate sydney
          $corporateSydney = array(
            "Corporate Sidney",
						"Leader-Project",
						"Sidney Employee"
          );
          // manager customer service
          $managerCustomerService = array(
            "Customer Service Mgr."
          );
          // customer service representative
          $customerServiceRepresentative = array(
            "Customer Service Rep",
						"Customer Service Spec",
						"Customer Service Specialist",
						"Customer Service Rep.",
						"Int Co CSR"
          );
          // director of operations
          $directorOfOperations = array(
            "Dir-Operations-Missouri"
          );
          // engineer automation
          $engineerAutomation = array(
            "Engineer Automation"
          );
          // engineer safety
          $engineerSafety = array(
            "Engineer Mfg Safety"
          );
          // lean champion
          $leanChampion = array(
            "Lean Champion"
          );
          // engineer lean
          $engineerLean = array(
            "Lean Engineer"
          );
          // engineer special projects
          $engineerSpecialProjects = array(
            "Spec Prod Engineer"
          );
          // engineer lean sr
          $engineerLeanSR = array(
            "Sr. Lean Engineer"
          );
          // team leader assembly maintenance
          $teamLeaderAssemblyMaintenance = array(
            "TL Maintenance - Assembly"
          );

          if(in_array($record['position'], $assembler)){
            $positionDescription = "assembler";
          }elseif(in_array($record['position'], $chemicalFloorSupportTechnician)){
            $positionDescription = "checmical floor support technician";
          }elseif (in_array($record['position'], $floorSupportTechnician)) {
            $positionDescription = "floor support technician";
          }elseif(in_array($record['position'], $machineOperatorComponent)){
            $positionDescription = "machine operator component";
          }elseif(in_array($record['position'], $machineOperatorScroll)){
            $positionDescription = "machine operator scroll";
          }elseif(in_array($record['position'], $materialHandler)){
            $positionDescription = "material handler";
          }elseif(in_array($record['position'], $productionQualityAuditor)){
            $positionDescription = "production quality auditor";
          }elseif(in_array($record['position'], $supportDocumentation)){
            $positionDescription = "support documentation";
          }elseif(in_array($record['position'], $specialistGuage)){
            $positionDescription = "specialist guage";
          }elseif(in_array($record['position'], $specialistISO)){
            $positionDescription = "specialist iso";
          }elseif(in_array($record['position'], $specialistMaintenance)){
            $positionDescription = "specialist maintenance";
          }elseif(in_array($record['position'], $specialisstManufacturing)){
            $positionDescription = "specialist manufacturing";
          }elseif(in_array($record['position'], $specialistOperations)){
            $positionDescription = "specialist operations";
          }elseif(in_array($record['position'], $specialistTeardown)){
            $positionDescription = "specialist teardown";
          }elseif(in_array($record['position'], $specialistWelding)){
            $positionDescription = "specialist welding";
          }elseif(in_array($record['position'], $machinist)){
            $positionDescription = "machinist";
          }elseif(in_array($record['position'], $maintenanceAssembly)){
            $positionDescription = "maintenance assembly";
          }elseif(in_array($record['position'], $maintenanceComponent)){
            $positionDescription = "maintenance component";
          }elseif(in_array($record['position'], $maintenanceFacilities)){
            $positionDescription = "maintenance facilities";
          }elseif(in_array($record['position'], $maintenanceScroll)){
            $positionDescription = "maintenance scroll";
          }elseif(in_array($record['position'], $administrativeAssistant)){
            $positionDescription = "administrative assistant";
          }elseif(in_array($record['position'], $adminstratorITLanSR)){
            $positionDescription = "administrator it lan sr";
          }elseif(in_array($record['position'], $analystFinancial)){
            $positionDescription = "analyst financial";
          }elseif(in_array($record['position'], $analystIT)){
            $positionDescription = "analyst it";
          }elseif(in_array($record['position'], $analystMaterials)){
            $positionDescription = "analyst materials";
          }elseif(in_array($record['position'], $clerkPayroll)){
            $positionDescription = "clerk payroll";
          }elseif(in_array($record['position'], $clerkHR)){
            $positionDescription = "clerk hr";
          }elseif(in_array($record['position'], $collegeStudent)){
            $positionDescription = "college student";
          }elseif(in_array($record['position'], $controllerPlant)){
            $positionDescription = "controller plant";
          }elseif(in_array($record['position'], $coordinatorHR)){
            $positionDescription = "coordinator hr";
          }elseif(in_array($record['position'], $coordinatorProjectAdministrative)){
            $positionDescription = "coordinator project administrative";
          }elseif(in_array($record['position'], $engineerEnvironmental)){
            $positionDescription = "engineer environmental";
          }elseif(in_array($record['position'], $engineerIndustrial)){
            $positionDescription = "engineer industrial";
          }elseif(in_array($record['position'], $engineerManufacturing)){
            $positionDescription = "engineer manufacturing";
          }elseif(in_array($record['position'], $engineerManufacturingSR)){
            $positionDescription = "engineer manufacturing sr";
          }elseif(in_array($record['position'], $engineerProduction)){
            $positionDescription = "engineer production";
          }elseif(in_array($record['position'], $engineerQuality)){
            $positionDescription = "engineer quality";
          }elseif(in_array($record['position'], $generalistHR)){
            $positionDescription = "generalist hr";
          }elseif(in_array($record['position'], $managerEmployeeRelations)){
            $positionDescription = "manager employee relations";
          }elseif(in_array($record['position'], $managerHR)){
            $positionDescription = "manager hr";
          }elseif(in_array($record['position'], $managerManufacturingServices)){
            $positionDescription = "manager manufacturing services";
          }elseif(in_array($record['position'], $managerOperations)){
            $positionDescription = "manager operations";
          }elseif(in_array($record['position'], $managerQuality)){
            $positionDescription = "manager quality";
          }elseif(in_array($record['position'], $managerTeam)){
            $positionDescription = "manager team";
          }elseif(in_array($record['position'], $scheduler)){
            $positionDescription = "scheduler";
          }elseif(in_array($record['position'], $teamLeaderAssembly)){
            $positionDescription = "team leader assembly";
          }elseif(in_array($record['position'], $teamLeaderISOAndQualitySystems)){
            $positionDescription = "team leader iso and quality systems";
          }elseif(in_array($record['position'], $teamLeaderMachining)){
            $positionDescription = "team leader machining";
          }elseif(in_array($record['position'], $teamLeaderMaterials)){
            $positionDescription = "team leader materials";
          }elseif(in_array($record['position'], $teamLeaderQuality)){
            $positionDescription = "team leader quality";
          }elseif(in_array($record['position'], $technicianCalorimeter)){
            $positionDescription = "technician calorimeter";
          }elseif(in_array($record['position'], $technicianProject)){
            $positionDescription = "technician project";
          }elseif(in_array($record['position'], $corporateSydney)){
            $positionDescription = "corporate sydney";
          }elseif(in_array($record['position'], $managerCustomerService)){
            $positionDescription = "manager customer service";
          }elseif(in_array($record['position'], $customerServiceRepresentative)){
            $positionDescription = "customer service representative";
          }elseif(in_array($record['position'], $directorOfOperations)){
            $positionDescription = "director of operations";
          }elseif(in_array($record['position'], $engineerAutomation)){
            $positionDescription = "engineer automation";
          }elseif(in_array($record['position'], $engineerSafety)){
            $positionDescription = "engineer safety";
          }elseif(in_array($record['position'], $leanChampion)){
            $positionDescription = "lean champion";
          }elseif(in_array($record['position'], $engineerLean)){
            $positionDescription = "engineer lean";
          }elseif(in_array($record['position'], $engineerSpecialProjects)){
            $positionDescription = "engineer special projects";
          }elseif(in_array($record['position'], $engineerLeanSR)){
            $positionDescription = "engineer lean sr";
          }elseif(in_array($record['position'], $teamLeaderAssemblyMaintenance)){
            $positionDescription = "team leader assembly maintenance";
          }else{
            $positionDescription = "assembler";
          }

          // maintenance leader
          // controller plant assistant
          // coordinator engineering change
          // engineer lead
          // manager facilities and maintenance
          // manager materials
          // manager technical team
          // materials coordinator
          // project leader materials
          // supervisor materials

          $position = Position::where('description', $positionDescription)->first();
          $employee->position()->sync($position['id']);

          // Set job
          if($record['job'] === "H"){
            $jobDescription = 'hourly';
          }elseif($record['job'] === "S"){
            $jobDescription = 'salary';
          }elseif($record['job'] === "C"){
            $jobDescription = 'corporate';
          }else{
            $jobDescription = 'hourly';
          }
          $job = Job::where('description', $jobDescription)->first();
          $employee->job()->sync($job['id']);

          // Set shift
          if($record['shift'] === 1 || $record['shift'] === "A"){
            $shiftDescription = 'day';
          }else{
            $shiftDescription = 'night';
          }
          $shift = Shift::where('description', $shiftDescription)->first();
          $employee->shift()->sync($shift['id']);

        }
      }
    }
}
