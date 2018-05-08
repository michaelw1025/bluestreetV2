<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InsuranceCoverage;
use App\MedicalPlan;
use App\DentalPlan;
use App\VisionPlan;
use App\AccidentalCoverage;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, InsuranceCoverage $insuranceCoverage, MedicalPlan $medicalPlan, DentalPlan $dentalPlan, VisionPlan $visionPlan, AccidentalCoverage $accidentalCoverage)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $insuranceCoverages = $insuranceCoverage->all();
        $medicalPlans = $medicalPlan->with('insuranceCoverage')->get();
        $dentalPlans = $dentalPlan->with('insuranceCoverage')->get();
        $visionPlans = $visionPlan->with('insuranceCoverage')->get();
        $accidentalCoverages = $accidentalCoverage->all();
        return view('hr.insurances', [
            'insuranceCoverages' => $insuranceCoverages,
            'medicalPlans' => $medicalPlans,
            'dentalPlans' => $dentalPlans,
            'visionPlans' => $visionPlans,
            'accidentalCoverages' => $accidentalCoverages,
        ]);
    }

    // ****************************************************************************************
    // --------------------------------Insurance Coverage Types--------------------------------
    // ****************************************************************************************

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createInsuranceCoverage(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeInsuranceCoverage(Request $request, InsuranceCoverage $insuranceCoverage)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $insuranceCoverage = new InsuranceCoverage();
        $insuranceCoverage->description = $request->description;
        if($insuranceCoverage->save()){
            \Session::flash('status', 'Insurance Coverage Type created.');
        }else{
            \Session::flash('error', 'Insurance Coverage Type not created.');
        }
        return redirect('hr.insurances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showInsuranceCoverage(Request $request, InsuranceCoverage $insuranceCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $insuranceCoverage = $insuranceCoverage->find($id);
        return view('hr.show-insurance-coverage',[
            'insuranceCoverage' => $insuranceCoverage,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editInsuranceCoverage(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInsuranceCoverage(Request $request, InsuranceCoverage $insuranceCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $insuranceCoverage = $insuranceCoverage->find($id);
        $insuranceCoverage->description = $request->description;
        if($insuranceCoverage->save()){
            \Session::flash('status', 'Insurance Coverage Type edited.');
        }else{
            \Session::flash('error', 'Insurance Coverage Type not edited.');
        }
        return redirect()->route('hr.insurance-coverages', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyInsuranceCoverage(Request $request, InsuranceCoverage $insuranceCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $insuranceCoverage = $insuranceCoverage->find($id);
        // if($insuranceCoverage->delete()){
        //     $insuranceCoverage->medicalPlan()->detach();
        //     $insuranceCoverage->dentalPlan()->detach();
        //     $insuranceCoverage->visionPlan()->detach();
        //     \Session::flash('status', 'Insurance Coverage Type deleted.');
        // }else{
        //     \Session::flash('error', 'Insurance Coverage Type not deleted.');
        // }
        return redirect('hr.insurances');
    }






    // ****************************************************************************************
    // --------------------------------Medical Plans--------------------------------
    // ****************************************************************************************

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMedicalPlan(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMedicalPlan(Request $request, MedicalPlan $medicalPlan)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $medicalPlan = new MedicalPlan();
        $medicalPlan->description = $request->description;
        if($medicalPlan->save()){
            \Session::flash('status', 'Medical Plan created.');
        }else{
            \Session::flash('error', 'Medical Plan not created.');
        }
        return redirect('hr.insurances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMedicalPlan(Request $request, MedicalPlan $medicalPlan, InsuranceCoverage $insuranceCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $medicalPlan = $medicalPlan->with('insuranceCoverage')->find($id);
        $insuranceCoverages = $insuranceCoverage->all();
        return view('hr.show-medical-plan',[
            'medicalPlan' => $medicalPlan,
            'insuranceCoverages' => $insuranceCoverages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMedicalPlan(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMedicalPlan(Request $request, MedicalPlan $medicalPlan, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $medicalPlan = $medicalPlan->find($id);
        $medicalPlan->description = $request->description;
        if($medicalPlan->save()){
            $coverageArray = array();
            foreach($request->coverage as $coverage){
                $coverageArray[$coverage['id']] = ['amount' => $coverage['amount']];
            }
            $medicalPlan->insuranceCoverage()->sync($coverageArray);
            \Session::flash('status', 'Medical Plan edited.');
        }else{
            \Session::flash('error', 'Medical Plan not edited.');
        }
        return redirect()->route('hr.medical-plans', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMedicalPlan(Request $request, MedicalPlan $medicalPlan, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $medicalPlan = $medicalPlan->find($id);
        // if($medicalPlan->delete()){
        //     $medicalPlan->insuranceCoverage()->sync([]);
        //     \Session::flash('status', 'Medical Plan deleted.');
        // }else{
        //     \Session::flash('error', 'Medical Plan not deleted.');
        // }
        return redirect('hr.insurances');
    }

    // ****************************************************************************************
    // --------------------------------Dental Plans--------------------------------
    // ****************************************************************************************

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDentalPlan(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDentalPlan(Request $request, DentalPlan $dentalPlan)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $dentalPlan = new DentalPlan();
        $dentalPlan->description = $request->description;
        if($dentalPlan->save()){
            \Session::flash('status', 'Dental Plan created.');
        }else{
            \Session::flash('error', 'Dental Plan not created.');
        }
        return redirect('hr.insurances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDentalPlan(Request $request, DentalPlan $dentalPlan, InsuranceCoverage $insuranceCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $dentalPlan = $dentalPlan->with('insuranceCoverage')->find($id);
        $insuranceCoverages = $insuranceCoverage->all();
        return view('hr.show-dental-plan',[
            'dentalPlan' => $dentalPlan,
            'insuranceCoverages' => $insuranceCoverages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editDentalPlan(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDentalPlan(Request $request, DentalPlan $dentalPlan, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $dentalPlan = $dentalPlan->find($id);
        $dentalPlan->description = $request->description;
        if($dentalPlan->save()){
            $coverageArray = array();
            foreach($request->coverage as $coverage){
                $coverageArray[$coverage['id']] = ['amount' => $coverage['amount']];
            }
            $dentalPlan->insuranceCoverage()->sync($coverageArray);
            \Session::flash('status', 'Dental Plan edited.');
        }else{
            \Session::flash('error', 'Dental Plan not edited.');
        }
        return redirect()->route('hr.dental-plans', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyDentalPlan(Request $request, DentalPlan $dentalPlan, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $dentalPlan = $dentalPlan->find($id);
        // if($dentalPlan->delete()){
        //     $dentalPlan->insuranceCoverage()->sync([]);
        //     \Session::flash('status', 'Dental Plan deleted.');
        // }else{
        //     \Session::flash('error', 'Dental Plan not deleted.');
        // }
        return redirect('hr.insurances');
    }

    // ****************************************************************************************
    // --------------------------------Vision Plans--------------------------------
    // ****************************************************************************************

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVisionPlan(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVisionPlan(Request $request, VisionPlan $visionPlan)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $visionPlan = new VisionPlan();
        $visionPlan->description = $request->description;
        if($visionPlan->save()){
            \Session::flash('status', 'Vision Plan created.');
        }else{
            \Session::flash('error', 'Vision Plan not created.');
        }
        return redirect('hr.insurances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showVisionPlan(Request $request, VisionPlan $visionPlan, InsuranceCoverage $insuranceCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $visionPlan = $visionPlan->with('insuranceCoverage')->find($id);
        $insuranceCoverages = $insuranceCoverage->all();
        return view('hr.show-vision-plan',[
            'visionPlan' => $visionPlan,
            'insuranceCoverages' => $insuranceCoverages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editVisionPlan(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateVisionPlan(Request $request, VisionPlan $visionPlan, InsuranceCoverage $insuranceCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $visionPlan = $visionPlanwith('insuranceCoverage')->find($id);
        $visionPlan->description = $request->description;
        if($visionPlan->save()){
            $coverageArray = array();
            foreach($request->coverage as $coverage){
                $coverageArray[$coverage['id']] = ['amount' => $coverage['amount']];
            }
            $visionPlan->insuranceCoverage()->sync($coverageArray);
            \Session::flash('status', 'Vision Plan edited.');
        }else{
            \Session::flash('error', 'Vision Plan not edited.');
        }
        return redirect()->route('hr.vision-plans', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyVisionPlan(Request $request, VisionPlan $visionPlan, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $visionPlan = $visionPlan->find($id);
        // if($visionPlan->delete()){
        //     $visionPlan->insuranceCoverage()->sync([]);
        //     \Session::flash('status', 'Vision Plan deleted.');
        // }else{
        //     \Session::flash('error', 'Vision Plan not deleted.');
        // }
        return redirect('hr.insurances');
    }

    // ****************************************************************************************
    // --------------------------------Accidental Coverage Types--------------------------------
    // ****************************************************************************************

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAccidentalCoverage(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAccidentalCoverage(Request $request, AccidentalCoverage $accidentalCoverage)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $accidentalCoverage = new AccidentalCoverage();
        $accidentalCoverage->description = $request->description;
        if($accidentalCoverage->save()){
            \Session::flash('status', 'Accidental Coverage Type created.');
        }else{
            \Session::flash('error', 'Accidental Coverage Type not created.');
        }
        return redirect('hr.insurances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAccidentalCoverage(Request $request, AccidentalCoverage $accidentalCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $accidentalCoverage = $accidentalCoverage->find($id);
        return view('hr.show-accidental-coverage',[
            'accidentalCoverage' => $accidentalCoverage,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAccidentalCoverage(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccidentalCoverage(Request $request, AccidentalCoverage $accidentalCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required',
        ]);
        $accidentalCoverage = $accidentalCoverage->find($id);
        $accidentalCoverage->description = $request->description;
        if($accidentalCoverage->save()){
            \Session::flash('status', 'Accidental Coverage Type edited.');
        }else{
            \Session::flash('error', 'Accidental Coverage Type not edited.');
        }
        return redirect()->route('hr.accidental-coverages', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAccidentalCoverage(Request $request, AccidentalCoverage $accidentalCoverage, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $accidentalCoverage = $accidentalCoverage->find($id);
        // if($accidentalCoverage->delete()){
        //     \Session::flash('status', 'Accidental Coverage Type deleted.');
        // }else{
        //     \Session::flash('error', 'Accidental Coverage Type not deleted.');
        // }
        return redirect('hr.insurances');
    }
}