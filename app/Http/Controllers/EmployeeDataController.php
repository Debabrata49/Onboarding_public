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
use Tymon\JWTAuth\Facades\JWTAuth;

class EmployeeDataController extends Controller
{
    public function getEmployeeData(Request $request)
    {
        $rules = [
            'page_number'=>'required'
        ];

        $validator = Validator::make($request->input(), $rules);
        if($validator->fails() ){
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $limit = 10;
        $offset = ($request->page_number - 1) * $limit;
        
        $merchant = JWTAuth::parseToken()->authenticate();
        $merchant_id = $merchant->id;
        $merchant = MerchantDetails::where('user_id', $merchant_id)->first();
        if (!$merchant) {
            return response()->json(['error' => 'Merchant not found'], 404);
        }
        $merchant_data = $merchant->toArray();
        // $employees = $merchant->employees()->select('id', 'name', 'merchant_id','email','password','vaid_till','status','deactived','created_at','updated_at','outlet_id')->get();
        $employees = Employee::where('merchant_id', $merchant_id)->with('outlet:id,outletname');

        $total_entries = $employees->count();
        $total_pages = ceil($total_entries/$limit);
        if(!empty($request->search)){
            $employees = $employees->where(function ($query) use(&$search) {
                $query->where('id','LIKE','%'.$search.'%')
                    ->orWhere('name','LIKE','%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('outlet:outletname', 'LIKE', '%' . $search . '%');
            });
        }
        $employees = $employees->offset($offset)->limit($limit)->orderBy('id','desc')->get(['id', 'name', 'merchant_id','email','password','orginialpassword','status','created_at','updated_at','outlet_id','loyalty_percentage','sms_vendor_type','promo_sms_vendor_type','whatsapp_vendor_type','push_redeemption_permission','permission','valid_till']);
        $emp_array = [];
        if(count($employees) > 0){
            foreach ($employees as $employee) {
                //outlet
                $outletname = 'N/A';
                if(isset($employee->outlet->outletname)){
                    $outletname = $employee->outlet->outletname;
                }
                unset($employee->outlet);
                //pos_registration
                $pos_vendor_name = 'N/A';
                $pos_reg = PosRegistration::where('login_id', $employee->email)->where('merchant_id',$employee->merchant_id)->first();
                if (isset($pos_reg->pos_vendor_id)) {
                    $pos_vendor = PosVendorRegistration::where('id', $pos_reg->pos_vendor_id)->where('status',1)->first();
                    if ($pos_vendor) {
                        $pos_vendor_name = $pos_vendor->pos_name;
                    }
                }
                unset($pos_reg,$pos_vendor);
                //Communication
                $sms_vendor_name = 'N/A';
                $promo_sms_vendor_name = 'N/A';
                $whatsapp_vendor_name = 'N/A';
                $push_vendoe_name = 'Push - off';  
                if(isset($employee->sms_vendor_type)){
                    $sms_vendor = SmsVendor::where('id', $employee->sms_vendor_type)->first();
                    $sms_vendor_name = $sms_vendor->sms_vendor_name;
                }
                if(isset($employee->promo_sms_vendor_type)){
                    $promo_sms_vendor = SmsVendor::where('id', $employee->promo_sms_vendor_type)->first();
                    $promo_sms_vendor_name = $promo_sms_vendor->sms_vendor_name;
                }
                if(isset($employee->whatsapp_vendor_type)){
                    $whatsapp_vendor = WhatsappVendor::where('id', $employee->whatsapp_vendor_type)->first();
                    if($whatsapp_vendor){
                        $whatsapp_vendor_name = $whatsapp_vendor->vendor_name;
                    }
                }
                if(isset($employee->push_redeemption_permission)){
                    $push_vendoe_name = 'Push - on';
                }
                unset($sms_vendor,$promo_sms_vendor,$whatsapp_vendor);
                //Permissions & Settings
                $permission_text = 'No Permission Granted';
                if($employee->permission){
                    $permission_text = 'View';
                }
                //Module Access
                $module_access = 'View';
                //edit
                $edit = 'Edit';
                //Activated ON
                $active_on = 'N/A';
                if($employee->status == 1){
                    $active_on = date('d-m-Y',strtotime($employee->created_at));
                }
                //Deactivated ON
                $deactive_on = 'N/A';
                if($employee->status == 0){
                    $deactive_on = $employee->updated_at;
                }
                //Loyalty structure 
                $loyalty_structure = 'N/A';
                if($merchant_data['tier_permission'] == 1){
                    $loyalty_structure = 'View tier structure';
                }else{
                    $loyalty_structure = $employee->loyalty_percentage;
                }
                //Advanced Loyalty
                $adv_loyalty = 'N/A';

                $emp_array[] = [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'password' => $employee->orginialpassword,
                    'active_on' => $active_on,
                    'deactive_on' => $deactive_on,
                    'valid_till' => date('d-m-Y',strtotime($employee->valid_till)),
                    'outletname' => $outletname,
                    'loyalty_percentage' => $loyalty_structure,  
                    'adv_loyalty' => $adv_loyalty,  
                    'status' => $employee->status,
                    'pos_vendor_name' => $pos_vendor_name ?? '',
                    'sms_vendor_name' => $sms_vendor_name ?? '',
                    'promo_sms_vendor_name' => $promo_sms_vendor_name ?? '',
                    'whatsapp_vendor_name' => $whatsapp_vendor_name ?? '',
                    'push_vendoe_name' => $push_vendoe_name ?? '',
                    'permission_text' => $permission_text,
                    'module_access' => $module_access,
                    'edit' => $edit,
                ];
            }
        }



        

        $data = [
            'merchant' => $merchant_data,
            'employees' => $emp_array,
            'total_entries' => $total_entries,
            'total_pages' => $total_pages,
            'limit' => $limit,
            'current_page' => (int)$request->page_number,
            'next_page' => (int)$request->page_number+1,
        ];
        return response()->json(['data' => $data], 200);
    }
}
