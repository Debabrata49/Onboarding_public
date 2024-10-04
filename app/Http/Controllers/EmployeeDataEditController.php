<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Employee;
use App\Models\MerchantDetails;
use App\Models\PosRegistration;
use App\Models\LoyaltyProgram;
use App\Models\MerchantPoints;
use App\Models\CurrencyCode;
use App\Models\MerchantRegion;
use App\Models\TimeZone;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Trait\EmployeeDataFormat;

class EmployeeDataEditController extends Controller
{
    use EmployeeDataFormat;
    public function editEmployeeProfile(Request $request)
    {
        
        $rules = [
            'employee_id'=>'required'
        ];

        $validator = Validator::make($request->input(), $rules);
        if($validator->fails() ){
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $merchant = JWTAuth::parseToken()->authenticate();
        $merchant_id = $merchant->id;
        // $merchant_id = 15657;
        $merchant = MerchantDetails::where('user_id', $merchant_id)->first();
        if (!$merchant) {
            return response()->json(['error' => 'Merchant not found'], 404);
        }

        $employee = Employee::where('id', $request->employee_id)->with('outlet:id,outletname')->first();
        
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        $pos_reg = PosRegistration::where('login_id', $employee->email)->where('merchant_id',$employee->merchant_id)->first();
        //pos_reg_details
        $pos_vendor = $this->get_pos_reg_details($employee,$pos_reg);        
        //Set communication channels
        $communication_channels = $this->set_communication_cahnnels_format($employee);
        
        //Manage POS level permissions
        $permission_arr = explode(',', $employee->permission);
        $pos_level_permission = $this->pos_level_permission_format($employee,$pos_reg,$permission_arr);
        
        //Sub-Accounts Permission
        $sub_accounts_permission = $this->sub_accounts_permission_format($permission_arr);

        //OFFERS
        $offer = $this->get_offer($employee, $merchant_id);

        $empEditData = [
            'employee' => $employee,
            'pos_vendor' => $pos_vendor,
            'communication_channels' => $communication_channels,
            'pos_level_permission' => $pos_level_permission,
            'sub_accounts_permission' => $sub_accounts_permission,
            'offer' => $offer
        ];

        return response()->json(['data' => $empEditData], 200);
    }

    public function getEditEmployeeMain(Request $request)
    {
        $rules = [
            'employee_id'=>'required'
        ];

        $validator = Validator::make($request->input(), $rules);
        if($validator->fails() ){
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $merchant = JWTAuth::parseToken()->authenticate();
        $merchant_id = $merchant->id;
        $merchant = MerchantDetails::where('user_id', $merchant_id)->first();
        if (!$merchant) {
            return response()->json(['error' =>false, 'msg' => 'Merchant not found'], 404);
        }

        $employee = Employee::where('id', $request->employee_id)->where('is_active',1)->where('deleted',0)->first();
        
        if (!$employee) {
            return response()->json(['error' =>false, 'msg' => 'Employee not found'], 404);
        }

        $loyalty_percentage_chk = 0;
        $loyaltyprogram = LoyaltyProgram::where('merchant_id',$merchant_id)->first();
        if($loyaltyprogram->loyalty_type==2 && $loyaltyprogram->structure_type == 1 ){
            $merchantstructure_type = 'tierbased';
        }elseif($loyaltyprogram->loyalty_type == 2 && $loyaltyprogram->structure_type == 0 ){
            $merchantstructure_type = 'normal';
            $loyalty_percentage_chk = 1; 
        }else{
            $merchantstructure_type = 'stampbased';
        }

        $asm_data = [
            'asm_name' => $employee->asm_name,
            'asm_email' => $employee->asm_email,
            'asm_number' => $employee->asm_number,
            'asm_country_code' => $employee->asm_country_code
        ];
        $manager_data = [
            'manager_name' => $employee->asm_manager_name,
            'manager_email' => $employee->asm_manager_email,
            'manager_number' => $employee->asm_manager_number,
            'manager_country_code' => $employee->asm_manager_countrycode
        ];

        // $lstructure = MerchantPoints::where('merchant_id',$merchant_id)->first();
        // if($lstructure){
        //     if($lstructure->Simple_points != 0 && $lstructure->simple_rupees != 0)
        //     {
        //         $percent = ($lstructure->Simple_points/$lstructure->simple_rupees)*100;
        //         $simple = sprintf("%.2f", $percent);
        //         $intpercentage = intval($simple);
        //     }
        // }
        $country = $this->getCountryEmpWise($employee->country_code);
        $currency = $this->getCurrencyEmpWise($employee->currency);
        $timezone = $this->getTimeZoneEmpWise($employee->timezone);
        $region = $this->getRegionEmpWise($employee->region,$merchant_id);

        $employeeData = [
            'emp_name' => !empty($employee->name)?$employee->name:'',
            'emp_email' => !empty($employee->email)?$employee->email:'',
            'emp_mobile' => !empty($employee->mobile_number)?$employee->mobile_number:0,
            'emp_password' => !empty($employee->orginialpassword)?$employee->orginialpassword:'',
            'emp_confirm_password' => !empty($employee->orginialpassword)?$employee->orginialpassword:'',
            'emp_business_name' => !empty($employee->business_name)?$employee->business_name:'',
            'emp_business_location' => !empty($employee->business_location)?$employee->business_location:'',
            'emp_category' => !empty($employee->category)?$employee->category:'',
            'emp_loyalty_percentage' => !empty($employee->loyalty_percentage) && $loyalty_percentage_chk == 1?$employee->loyalty_percentage:0,
            'emp_maxallow_award_trans' => !empty($merchant->maxallow_award_trans)?$merchant->maxallow_award_trans:0,
            'emp_loyalty_percentage_chk' => !empty($loyalty_percentage_chk)?$loyalty_percentage_chk:0,
            'emp_note' => !empty($employee->note)?$employee->note:'',
            'asm_data' => !empty($asm_data)?$asm_data:[],
            'manager_data' => !empty($manager_data)?$manager_data:[],    
            'emp_country' => !empty($country)?$country:[],
            'emp_currency' => !empty($currency)?$currency:[],
            'emp_timezone' => !empty($timezone)?$timezone:[],
            'emp_region' => !empty($region)?$region:[],

        ];

        return response()->json(['data' => $employeeData], 200);
    }
}
