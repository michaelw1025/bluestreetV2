<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
    |--------------------------------------------------------------------------
    | Admin routes
    |--------------------------------------------------------------------------
*/
// Admin home page
Route::get('admin.index', 'AdminController@index')->name('admin.index');

// Show all site users
Route::get('admin.users', 'UserController@index')->name('admin.all-users');
// Show selected site user
Route::get('admin.users/{id}', 'UserController@show')->name('admin.users');
// Update selected site user
Route::post('admin.users/{id}/update', 'UserController@update')->name('admin.update-user');
// Delete selected site user
Route::post('admin.users/{id}/delete', 'UserController@destroy');

// Show all site roles
Route::get('admin.roles', 'RoleController@index')->name('admin.all-roles');
// Create new site role
Route::post('admin.roles', 'RoleController@store')->name('admin.create-role');
// Show selected site role
Route::get('admin.roles/{id}', 'RoleController@show')->name('admin.roles');
// Update selected site role
Route::post('admin.roles/{id}/update', 'RoleController@update')->name('admin.update-role');
// Delete selected site role
Route::post('admin.roles/{id}/delete', 'RoleController@destroy');

/*
    |--------------------------------------------------------------------------
    | HR routes
    |--------------------------------------------------------------------------
*/
// HR home page
Route::get('hr.home', 'HRController@index')->name('hr.home');

// Show all cost centers
Route::get('hr.cost-centers', 'CostCenterController@index')->name('hr.all-cost-centers');
// Create new cost center
Route::post('hr.cost-centers', 'CostCenterController@store')->name('hr.create-cost-center');
// Show selected cost center
Route::get('hr.cost-centers/{id}', 'CostCenterController@show')->name('hr.cost-centers');
// Update selected cost center
Route::post('hr.cost-centers/{id}/update', 'CostCenterController@update')->name('hr.update-cost-center');
// Delete selected cost center
// Route::post('hr.cost-centers/{id}/delete', 'CostCenterController@destroy');

// Show all jobs
Route::get('hr.jobs', 'JobController@index')->name('hr.all-jobs');
// Create new job
Route::post('hr.jobs', 'JobController@store')->name('hr.create-job');
// Show selected job
Route::get('hr.jobs/{id}', 'JobController@show')->name('hr.jobs');
// Update selected job
Route::post('hr.jobs/{id}/update', 'JobController@update')->name('hr.update-job');
// Delete selected job
// Route::post('hr.jobs/{id}/delete', 'JobController@destroy');

// Show all positions
Route::get('hr.positions', 'PositionController@index')->name('hr.all-positions');
// Create new position
Route::post('hr.positions', 'PositionController@store')->name('hr.create-position');
// Show selected position
Route::get('hr.positions/{id}', 'PositionController@show')->name('hr.positions');
// Update selected position
Route::post('hr.positions/{id}/update', 'PositionController@update')->name('hr.update-position');
// Delete selected position
// Route::post('hr.positions/{id}/delete', 'PositionController@destroy');

// Show all shifts
Route::get('hr.shifts', 'ShiftController@index')->name('hr.all-shifts');
// Create new shift
Route::post('hr.shifts', 'ShiftController@store')->name('hr.create-shift');
// Show selected shift
Route::get('hr.shifts/{id}', 'ShiftController@show')->name('hr.shifts');
// Update selected shift
Route::post('hr.shifts/{id}/update', 'ShiftController@update')->name('hr.update-shift');
// Delete selected shift
// Route::post('hr.shifts/{id}/delete', 'ShiftController@destroy');

// Show all teams
Route::get('hr.teams', 'TeamController@index')->name('hr.all-teams');
// Create new team
Route::post('hr.teams', 'TeamController@store')->name('hr.create-team');
// Show selected team
Route::get('hr.teams/{id}', 'TeamController@show')->name('hr.teams');
// Update selected team
Route::post('hr.teams/{id}/update', 'TeamController@update')->name('hr.update-team');
// Delete selected team
// Route::post('hr.teams/{id}/delete', 'TeamController@destroy');

// Show all wage progressions
Route::get('hr.wage-progressions', 'WageProgressionController@index')->name('hr.all-wage-progressions');
// Create new wage progression
Route::post('hr.wage-progressions', 'WageProgressionController@store')->name('hr.create-wage-progression');
// Show selected wage progression
Route::get('hr.wage-progressions/{id}', 'WageProgressionController@show')->name('hr.wage-progressions');
// Update selected wage progression
Route::post('hr.wage-progressions/{id}/update', 'WageProgressionController@update')->name('hr.update-wage-progression');
// Delete selected wage progression
// Route::post('hr.wage-progressions/{id}/delete', 'WageProgressionController@destroy');

// Show all wage titles
Route::get('hr.wage-titles', 'WageTitleController@index')->name('hr.all-wage-titles');
// Create new wage title
Route::post('hr.wage-titles', 'WageTitleController@store')->name('hr.create-wage-title');
// Show selected wage title
Route::get('hr.wage-titles/{id}', 'WageTitleController@show')->name('hr.wage-titles');
// Update selected wage title
Route::post('hr.wage-titles/{id}/update', 'WageTitleController@update')->name('hr.update-wage-title');
// Delete selected wage title
// Route::post('hr.wage-titles/{id}/delete', 'WageTitleController@destroy');

// Show insurances home page
Route::get('hr.insurances', 'InsuranceController@index')->name('hr.all-insurances');
// ----------------Insurance Coverage Types----------------
// Show selected insurance coverage
Route::get('hr.insurance-coverages/{id}', 'InsuranceController@showInsuranceCoverage')->name('hr.insurance-coverages');
// Store new insurance coverage
Route::post('hr.insurance-coverages', 'InsuranceController@storeInsuranceCoverage')->name('hr.store-insurance-coverages');
// Update selected insurance coverage
Route::post('hr.insurance-coverages/{id}/update', 'InsuranceController@updateInsuranceCoverage')->name('hr.update-insurance-coverage');
// Delete selected insurance coverage
// Route::post('hr.insurance-coverages/{id}/delete', 'InsuranceController@destroyInsuranceCoverage');
// ----------------Medical Plans----------------
// Show selected medical plan
Route::get('hr.medical-plans/{id}', 'InsuranceController@showMedicalPlan')->name('hr.medical-plans');
// Store new medical plan
Route::post('hr.medical-plans', 'InsuranceController@storeMedicalPlan')->name('hr.store-medical-plans');
// Update selected medical plan
Route::post('hr.medical-plans/{id}/update', 'InsuranceController@updateMedicalPlan')->name('hr.update-medical-plan');
// Delete selected medical plan
// Route::post('hr.medical-plans/{id}/delete', 'InsuranceController@destroyMedicalPlan');
// ----------------Dental Plans----------------
// Show selected dental plan
Route::get('hr.dental-plans/{id}', 'InsuranceController@showDentalPlan')->name('hr.dental-plans');
// Store new dental plan
Route::post('hr.dental-plans', 'InsuranceController@storeDentalPlan')->name('hr.store-dental-plans');
// Update selected dental plan
Route::post('hr.dental-plans/{id}/update', 'InsuranceController@updateDentalPlan')->name('hr.update-dental-plan');
// Delete selected dental plan
// Route::post('hr.dental-plans/{id}/delete', 'InsuranceController@destroyDentalPlan');
// ----------------Vision Plans----------------
// Show selected vision plan
Route::get('hr.vision-plans/{id}', 'InsuranceController@showVisionPlan')->name('hr.vision-plans');
// Store new vision plan
Route::post('hr.vision-plans', 'InsuranceController@storeVisionPlan')->name('hr.store-vision-plans');
// Update selected vision plan
Route::post('hr.vision-plans/{id}/update', 'InsuranceController@updateVisionPlan')->name('hr.update-vision-plan');
// Delete selected vision plan
// Route::post('hr.vision-plans/{id}/delete', 'InsuranceController@destroyVisionPlan');

// ----------------Accidental Coverage----------------
// Show selected accidental coverage
Route::get('hr.accidental-coverages/{id}', 'InsuranceController@showAccidentalCoverage')->name('hr.accidental-coverages');
// Store new accidental coverage
Route::post('hr.accidental-coverages', 'InsuranceController@storeAccidentalCoverage')->name('hr.store-accidental-coverages');
// Update selected accidental coverage
Route::post('hr.accidental-coverages/{id}/update', 'InsuranceController@updateAccidentalCoverage')->name('hr.update-accidental-coverage');
// Delete selected accidental coverage
// Route::post('hr.accidental-coverages/{id}/delete', 'InsuranceController@destroyAccidentalCoverage');

/*
    |--------------------------------------------------------------------------
    | Employee routes
    |--------------------------------------------------------------------------
*/
// Show add employee form
Route::get('hr.create-employee', 'EmployeeController@create')->name('hr.create-employee');
// Show all employees
Route::get('hr.all-employees/{status}', 'EmployeeController@index')->name('hr.all-employees');
// Store new employee
Route::post('hr.employees', 'EmployeeController@store')->name('hr.store-employee');
// Show selected employee
Route::get('hr.employees/{id}', 'EmployeeController@show')->name('hr.employees');
// Update selected employee
Route::post('hr.employees/{id}/update', 'EmployeeController@update')->name('hr.update-employee');
// Delete selected employee
Route::post('hr.employees/{id}/delete', 'EmployeeController@destroy');
// Search employees
Route::get('hr.search-employees/{status}', 'EmployeeController@search')->name('hr.search-employees');
// Show employee disciplinary
Route::get('hr.employee-disciplinary/{employeeID}/{disciplinaryID}', 'EmployeeController@showDisciplinary')->name('hr.employee-disciplinary');
// Update or delete disciplinary
Route::post('hr.employee-disciplinary-update', 'EmployeeController@updateDisciplinary')->name('hr.employee-disciplinary-update');
// Show employee termination
Route::get('hr.employee-termination/{employeeID}/{terminationID}', 'EmployeeController@showTermination')->name('hr.employee-termination');
// Update or delete termination
Route::post('hr.employee-termination-update', 'EmployeeController@updateTermination')->name('hr.employee-termination-update');
// Show employee reduction
Route::get('hr.employee-reduction/{employeeID}/{reductionID}', 'EmployeeController@showReduction')->name('hr.employee-reduction');
// Update or delete reduction
Route::post('hr.employee-reduction-update', 'EmployeeController@updateReduction')->name('hr.employee-reduction-update');
// Delete employee photo
Route::get('hr.employee-photo-destroy/{employeeID}', 'EmployeeController@destroyPhoto')->name('hr.employee-photo-destroy');

/*
    |--------------------------------------------------------------------------
    | HR Query routes
    |--------------------------------------------------------------------------
*/
// Query all employees alphabetical
Route::get('hr.query-employees-alphabetical', 'HRQueryController@queryEmployeesAlphabetical')->name('hr.query-employees-alphabetical');
// Query all employees seniority
Route::get('hr.query-employees-seniority', 'HRQueryController@queryEmployeesSeniority')->name('hr.query-employees-seniority');
// Query reviews
Route::get('hr.query-reviews', 'HRQueryController@queryReviews')->name('hr.query-reviews');
// Query reductions
Route::get('hr.query-reductions', 'HRQueryController@queryReductions')->name('hr.query-reductions');
// Query turnovers
Route::get('hr.query-turnovers', 'HRQueryController@queryTurnovers')->name('hr.query-turnovers');
// Query anniversaries
Route::get('hr.query-anniversaries', 'HRQueryController@queryAnniversaries')->name('hr.query-anniversaries');
// Query birthdays
Route::get('hr.query-birthdays', 'HRQueryController@queryBirthdays')->name('hr.query-birthdays');
// Query hire date
Route::get('hr.query-hire-date', 'HRQueryController@queryHireDate')->name('hr.query-hire-date');
// Query cost center
Route::get('hr.query-cost-center', 'HRQueryController@queryCostCenter')->name('hr.query-cost-center');
// Query ssn
Route::get('hr.query-ssn', 'HRQueryController@querySSN')->name('hr.query-ssn');
// Query all employees wage progression
Route::get('hr.query-employees-wage-progression', 'HRQueryController@queryEmployeesWageProgression')->name('hr.query-employees-wage-progression');
// Query bonus hours
Route::get('hr.query-employees-bonus-hours', 'HRQueryController@queryEmployeesBonusHours')->name('hr.query-employees-bonus-hours');

/*
    |--------------------------------------------------------------------------
    | Bidding routes
    |--------------------------------------------------------------------------
*/
// Show create bid form
Route::get('hr.create-bid', 'BidController@create')->name('hr.create-bid');
// Store new bid
Route::post('hr.store-bid', 'BidController@store')->name('hr.store-bid');

/*
    |--------------------------------------------------------------------------
    | Contractor routes
    |--------------------------------------------------------------------------
*/
// Show create contractor form
Route::get('hr.create-contractor', 'ContractorController@create')->name('hr.create-contractor');
// Store contractor
Route::post('hr.store-contractor', 'ContractorController@store')->name('hr.store-contractor');
// Show Contractor
Route::get('hr.show-contractor/{id}', 'ContractorController@show')->name('hr.show-contractor');
// Update selected contractor
Route::post('hr.contractor/{id}/update', 'ContractorController@update')->name('hr.update-contractor');
// Delete selected contractor
Route::post('hr.contractor/{id}/delete', 'ContractorController@destroy');
// Show create contractor employee form
Route::get('hr.create-contractor-employee', 'ContractorController@createEmployee')->name('hr.create-contractor-employee');
// Store contractor employee
Route::post('hr.store-contractor-employee', 'ContractorController@storeEmployee')->name('hr.store-contractor-employee');
// Show contractor employee
Route::get('hr.show-contractor-employee/{id}', 'ContractorController@showEmployee')->name('hr.show-contractor-employee');
// Update selected contractor employee
Route::post('hr.contractor-employee/{id}/update', 'ContractorController@updateEmployee')->name('hr.update-contractor-employee');
// Delete selected contractor employee
Route::post('hr.contractor-employee/{id}/delete', 'ContractorController@destroyEmployee');

/*
    |--------------------------------------------------------------------------
    | Excel Exports
    |--------------------------------------------------------------------------
*/
// Export employees by alphabetical
Route::get('hr.export-employees-alphabetical', 'ExportController@employeesAlphabetical')->name('hr.export-employees-alphabetical');
// Export employees by seniority
Route::get('hr.export-employees-seniority', 'ExportController@employeesSeniority')->name('hr.export-employees-seniority');
// Export employees by anniversary
Route::get('hr.export-employees-anniversary/{searchMonth}/{searchYear}', 'ExportController@employeesAnniversary')->name('hr.export-employees-anniversary');
// Export employees wage progressions
Route::get('hr.export-employees-wage-progressions/{searchMonth}/{searchYear}/{searchProgression}', 'ExportController@employeesWageProgressions')->name('hr.export-employees-wage-progressions');
// Export employees bonus hours
Route::get('hr.export-employees-bonus-hours', 'ExportController@employeesBonusHours')->name('hr.export-employees-bonus-hours');