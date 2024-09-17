<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Employee;
use App\Models\MerchantDetails;
use App\Models\PosRegistration;
use App\Models\PosVendorRegistration;
use App\Models\SmsVendor;
use App\Models\WhatsappVendor;
use App\Models\EmailVendor;
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
}
