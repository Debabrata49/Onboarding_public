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
            return response()->json(['error' => 'Merchant not found'], 404);
        }

        $employee = Employee::where('id', $request->employee_id)->where('is_active',1)->where('deleted',0)->with('outlet:id,outletname')->first();
        
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $loyaltyprogram = LoyaltyProgram::where('merchant_id',$merchant_id)->first();
        if($loyaltyprogram->loyalty_type==2 && $loyaltyprogram->structure_type == 1 ){
            $merchantstructure_type = 'tierbased';
        }elseif($loyaltyprogram->loyalty_type == 2 && $loyaltyprogram->structure_type == 0 ){
            $merchantstructure_type = 'normal';
        }else{
            $merchantstructure_type = 'stampbased';
        }

        $lstructure = MerchantPoints::where('merchant_id',$merchant_id)->first();
        if($lstructure){
            if($lstructure->Simple_points != 0 && $lstructure->simple_rupees != 0)
            {
                $percent = ($lstructure->Simple_points/$lstructure->simple_rupees)*100;
                $simple = sprintf("%.2f", $percent);
                $intpercentage = intval($simple);
            }
        }
        $user = [];
        $user['country'] = CountryCode::all();
        $user['currency'] = CurrencyCode::all();
        $user['timezone'] = TimeZone::all();
        $user['region'] = MerchantRegion::where('merchant_id',$this->authUser['id'])->groupBy('region')->get();
        $addEmployee = 0;
        $pos_skip_permission = 0;
        $pos_skip_data = [];
        $pos_data = PosRegistration::where('merchant_id',$merchant->user_id)->where('login_id',$thisEmployee->email)->first();
        if($pos_data){
            $pos_skip = PosOrderTypeSkips::where('merchant_id',$merchant->user_id)->where('pos_registration_foreign_id',$pos_data->id)->where('status',1)->get();
            if(count($pos_skip)>0){
                $pos_skip_permission = 1;
                $pos_skip_data = $pos_skip;
            }else{
                $pos_skip_permission = 0;
            }
        }

        $whatsapp_vendor = WhatsappVendor::where('id',$thisEmployee->whatsapp_vendor_type)->where('status',1)->first();
        if($whatsapp_vendor){
            $whatsapp_vendor_name = $whatsapp_vendor->vendor_name;
        }else{
            $whatsapp_vendor_name = 0;
        }
        $sms_vendor = SmsVendor::where('id',$thisEmployee->sms_vendor_type)->where('status',1)->first();
        if($sms_vendor){
            $sms_vendor_name = $sms_vendor->sms_vendor_name;
        }else{
            $sms_vendor_name = 0;
        }
        $Promotional_vendor = SmsVendor::where('id',$thisEmployee->promo_sms_vendor_type)->where('status',1)->first();
        if($Promotional_vendor){
            $Promotional_vendor_name = $Promotional_vendor->sms_vendor_name;
        }else{
            $Promotional_vendor_name = 0;
        }

        $super_admin_permission = [];
        $super_admin_permission['Points On Discounted Bill Permission'] = $thisEmployee->points_on_discounted_bill_permission;
        $super_admin_permission['Points On Coupon Redemption'] = !empty($pos_data) && ($pos_data->coupon_redeem_transaction == 'transaction') ?1:0;
        $super_admin_permission['Points On Tax'] = $thisEmployee->points_on_tax;
        $super_admin_permission['Points On Discounted Item'] = $thisEmployee->points_on_discounted_item;
        $super_admin_permission['Redeem/Add Credits Permission'] = !empty($pos_data) && ($pos_data->redeem_transaction_type == 'transaction')?1:0;
        $super_admin_permission['Pos Order Type Skip'] = $pos_skip_permission;
        $super_admin_permission['WhatsApp Vendor'] = $whatsapp_vendor_name;
        $super_admin_permission['Transactional SMS Vendor'] = $sms_vendor_name;
        $super_admin_permission['Promotional SMS Vendor'] = $Promotional_vendor_name;
    }
}
