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
        
        // $merchant = JWTAuth::parseToken()->authenticate();
        // $merchant_id = $merchant->id;
        $merchant_id = 15657;
        $merchant = MerchantDetails::where('user_id', $merchant_id)->first();
        if (!$merchant) {
            return response()->json(['error' => 'Merchant not found'], 404);
        }

        $employee = Employee::where('id', $request->employee_id)->with('outlet:id,outletname')->first();
        
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $pos_Customer_key = 'N/A';
        $pos_vendor_select = [];
        $pos_reg = PosRegistration::where('login_id', $employee->email)->where('merchant_id',$employee->merchant_id)->first();
        if (isset($pos_reg->pos_vendor_id)) {
            $pos_Customer_key = $pos_reg->pos_merchant_id;
            
            $pos_vendor = PosVendorRegistration::select('id', 'pos_name')->where('status', 1)->get();
            foreach ($pos_vendor as $pos) {
                $pos_vendor_select[] = [
                    'id' => $pos->id,
                    'name' => $pos->pos_name,
                    'select' => $pos->id == $pos_reg->pos_vendor_id ? 1 : 0
                ];
            }
        }
        // unset($pos_reg);
        // dd($pos_reg);
        $sms_select = [];
        $sms_vendor = SmsVendor::select('id','sms_vendor_name')->where('status',1)->get();
        foreach ($sms_vendor as $sms) {
            $sms_select[] = [
                'id' => $sms->id,
                'name' => $sms->sms_vendor_name,
                'select' => $sms->id == $employee->sms_vendor_type ? 1 : 0
            ];
        }
        unset($sms_vendor);

        $whatsapp_select = [];
        $whatsapp_vendor = WhatsappVendor::select('id', 'vendor_name')->where('status', 1)->get();
        foreach ($whatsapp_vendor as $whatsapp) {
            $whatsapp_select[] = [
                'id' => $whatsapp->id,
                'name' => $whatsapp->vendor_name,
                'select' => $whatsapp->id == $employee->whatsapp_vendor_type ? 1 : 0
            ];
        }
        unset($whatsapp_vendor);

        $email_select = [];
        $email_vendor = EmailVendor::select('id', 'vendor_name')->where('status', 1)->get();
        foreach ($email_vendor as $email) {
            $email_select[] = [
                'id' => $email->id,
                'name' => $email->vendor_name,
                'select' => $email->id == $employee->email_vendor_id ? 1 : 0
            ];
        }
        //Manage POS level permissions
        $points_on_discounted_bill = [
            [
                'name' => 'Yes',
                'value' => '1',
                'select' => $employee->points_on_discounted_bill_permission == 1 ? 1 : 0
            ],
            [
                'name' => 'No',
                'value' => '0',
                'select' => $employee->points_on_discounted_bill_permission == 0 ? 1 : 0
            ]
        ];
        $coupon_redeem_transaction = [
            [
                'name' => 'Yes',
                'value' => 'transaction',
                'select' => $pos_reg->coupon_redeem_transaction == 'transaction' ? 1 : 0
            ],
            [
                'name' => 'No',
                'value' => 'checkin',
                'select' => $pos_reg->coupon_redeem_transaction == 'checkin' ? 1 : 0
            ]
        ];
        $points_on_tax = [
            [
                'name' => 'Yes',
                'value' => '1',
                'select' => $employee->points_on_tax == 1 ? 1 : 0
            ],
            [
                'name' => 'No',
                'value' => '0',
                'select' => $employee->points_on_tax == 0 ? 1 : 0
            ]
        ];
        $points_on_discounted_item  = [
            [
                'name' => 'Yes',
                'value' => '1',
                'select' => $employee->points_on_discounted_item == 1 ? 1 : 0
            ],
            [
                'name' => 'No',
                'value' => '0',
                'select' => $employee->points_on_discounted_item == 0 ? 1 : 0
            ]
        ];
        $permission_arr = explode(',', $employee->permission);
        $redeem_add_credits_permission = [
            [
                'name' => 'Yes',
                'value' => '1',
                'select' => in_array(23,$permission_arr) ? 1 : 0
            ],
            [
                'name' => 'No',
                'value' => '0',
                'select' => in_array(23,$permission_arr)? 1 : 0
            ]
        ];
        
        //Sub-Accounts Permission
        $sub_accounts_permission = $this->sub_accounts_permission_format($permission_arr);

        echo"<pre>";
        print_r($sub_accounts_permission);
        // print_r($pos_reg->pos_vendor_id);
        exit;


    }
}
