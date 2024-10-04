<?php

namespace App\Trait;
use App\Models\SmsVendor;
use App\Models\WhatsappVendor;
use App\Models\EmailVendor;
use App\Models\PosRegistration;
use App\Models\PosVendorRegistration;
use App\Models\PromoStructureTable;
use App\Models\Coupon;
use App\Models\Booklet;
use App\Models\EBooklet;
use App\Models\Token;
use App\Models\RecurringBookletDetails;
use App\Models\CurrencyCode;
use App\Models\TimeZone;
use App\Models\MerchantRegion;
use App\Models\CountryCode;

trait EmployeeDataFormat
{
    public function sub_accounts_permission_format($permission_arr)
    {
        $sub_accounts_permission = [
            'add credits' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(1,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(1,$permission_arr) ? 1 : 0
                ]
            ],
            'Verify code' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(2,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(2,$permission_arr) ? 1 : 0
                ]
            ],
            'Pending Requests' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(4,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(4,$permission_arr) ? 1 : 0
                ]
            ],
            'Redeem Credits' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(5,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(5,$permission_arr) ? 1 : 0
                ]
            ],
            'Custom ewallet' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(6,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(6,$permission_arr) ? 1 : 0
                ]
            ],
            'Overview' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(7,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(7,$permission_arr) ? 1 : 0
                ]
            ],
            'Promo Codes' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(8,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(8,$permission_arr) ? 1 : 0
                ]
            ],
            'Segments' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(9,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(9,$permission_arr) ? 1 : 0
                ]
            ],
            'Insight' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(10,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(10,$permission_arr) ? 1 : 0
                ]
            ],
            'Campaign' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(11,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(11,$permission_arr) ? 1 : 0
                ]
            ],
            'Trend' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(12,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(12,$permission_arr) ? 1 : 0
                ]
            ],
            'Reports module' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(13,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(13,$permission_arr) ? 1 : 0
                ]
            ],
            'Delete transactions' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(14,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(14,$permission_arr) ? 1 : 0
                ]
            ],
            'Engagements' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(15,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(15,$permission_arr) ? 1 : 0
                ]
            ],
            'OTP report' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(16,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(16,$permission_arr) ? 1 : 0
                ]
            ],
            'ADV overview' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(17,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(17,$permission_arr) ? 1 : 0
                ]
            ],
            'Heat map' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(18,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(18,$permission_arr) ? 1 : 0
                ]
            ],
            'CES' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(19,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(19,$permission_arr) ? 1 : 0
                ]
            ],
            'GMS' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(20,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(20,$permission_arr) ? 1 : 0
                ]
            ],
            'Feedback' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(21,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(21,$permission_arr) ? 1 : 0
                ]
            ],
            'Other profile - Add member' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(22,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(22,$permission_arr) ? 1 : 0
                ]
            ],
            'Redeem/add combo' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(23,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(23,$permission_arr) ? 1 : 0
                ]
            ],
            'SKU' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(24,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(24,$permission_arr) ? 1 : 0
                ]
            ],
            'Retention' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(25,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(25,$permission_arr) ? 1 : 0
                ]
            ],
            'Leaderboard' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(26,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(26,$permission_arr) ? 1 : 0
                ]
            ],
            'RFM Campaigns' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(27,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(27,$permission_arr) ? 1 : 0
                ]
            ],
            'GMS Verify code' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(28,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(28,$permission_arr) ? 1 : 0
                ]
            ],
            'GMS Redeem credits' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(29,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(29,$permission_arr) ? 1 : 0
                ]
            ],
            'GMS Add credits' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(30,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(30,$permission_arr) ? 1 : 0
                ]
            ],
            'OMD' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(31,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(31,$permission_arr) ? 1 : 0
                ]
            ],
            'Ginesys OTP bypaas' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(32,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(32,$permission_arr) ? 1 : 0
                ]
            ],
            'Wallet' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(33,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(33,$permission_arr) ? 1 : 0
                ]
            ],
            'Skip OTP authentication' => [
                [
                    'name' => 'Yes',
                    'value' => '1',
                    'select' => in_array(34,$permission_arr) ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => '0',
                    'select' => in_array(34,$permission_arr) ? 1 : 0
                ]
            ],

        ];

        return $sub_accounts_permission;
    }

    public function pos_level_permission_format($employee,$pos_reg,$permission_arr)
    {
        $pos_level_permission = [
            'points_on_discounted_bill' => [
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
            ],
            'coupon_redeem_transaction' => [
                [
                    'name' => 'Please select',
                    'value' => '0',
                    'select' => (!$pos_reg) ? 1 : 0
                ],
                [
                    'name' => 'Yes',
                    'value' => 'transaction',
                    'select' => ($pos_reg && $pos_reg->coupon_redeem_transaction == 'transaction') ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => 'checkin',
                    'select' => ($pos_reg && $pos_reg->coupon_redeem_transaction == 'checkin') ? 1 : 0
                ]
            ],
            'points_on_tax' => [
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
            ],
            'points_on_discounted_item' => [
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
            ],
            'redeem_add_credits_permission' => [
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
            ]
        ];

        return $pos_level_permission;
    }

    public function set_communication_cahnnels_format($employee){
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
        unset($email_vendor);
        $communication_channels = [
            'sms' => $sms_select,
            'whatsapp' => $whatsapp_select,
            'email' => $email_select
        ];
        return $communication_channels;
    }

    public function get_pos_reg_details($employee,$pos_reg){
        $pos_Customer_key = 'N/A';
        $pos_vendor_select = [];
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
        $pos_reg_details = [
            'pos_Customer_key' => $pos_Customer_key,
            'pos_vendor_select' => $pos_vendor_select
        ];
        return $pos_reg_details;
    }

    public function get_offer($employee,$merchant){
        $promos = PromoStructureTable::where('merchant_id', $merchant)->where('is_active', 1)->orderBy('id','desc')->get();
        $offers = [];
        $promo_select = [];
        if(count($promos)>0){
            foreach ($promos as $promo) {
                $promo_sub_select_arr = $promo->sub_logins_allowed_to_redeem;
                $promo_sub_select_arr = explode(',', $promo_sub_select_arr);
                $promo_select[] = [
                    [
                        'name' => $promo->promo_name,
                        'value' => $promo->id,
                        'select' => in_array($employee->id,$promo_sub_select_arr) ? 1 : 0
                    ]
                ];
                unset($promo_sub_select_arr);
            }
        }
        unset($promos);
        $coupons = Coupon::where('merchant_id', $merchant)->where('is_active', 1)->orderBy('id','desc')->get();
        $coupon_select = [];
        if(count($coupons)>0){
            foreach ($coupons as $coupon) {
                $coupon_select[] = [
                    [
                        'name' => $coupon->coupon_name,
                        'value' => $coupon->id,
                        'select' => 0
                    ]
                ];
            }
        }
        unset($coupons);
        $booklets = Booklet::where('merchant_id', $merchant)->where('status', 1)->orderBy('id','desc')->get();
        $booklet_select = [];
        if(count($booklets)>0){
            foreach ($booklets as $booklet) {
                $booklet_sub_select_arr = $booklet->allowed_subaccount;
                $booklet_sub_select_arr = explode(',', $booklet_sub_select_arr);
                $booklet_select[] = [
                    [
                        'name' => $booklet->booklet_name,
                        'value' => $booklet->id,
                        'select' => in_array($employee->id,$booklet_sub_select_arr) ? 1 : 0
                    ]
                ];
                unset($booklet_sub_select_arr);
            }
        }
        $ebooklets = EBooklet::where('merchant_id', $merchant)->where('status', 1)->orderBy('id','desc')->get();
        $ebooklet_select = [];
        if(count($ebooklets)>0){
            foreach ($ebooklets as $ebooklet) {
                $ebooklet_sub_select_arr = $ebooklet->allowed_subaccount;
                $ebooklet_sub_select_arr = explode(', ', $ebooklet_sub_select_arr);
                $ebooklet_select[] = [
                    [
                        'name' => $ebooklet->ebooklet_name,
                        'value' => $ebooklet->id,
                        'select' => in_array($employee->id, $ebooklet_sub_select_arr) ? 1 : 0
                    ]
                ];
            }
        }
        $tokens = Token::where('merchant_id', $merchant)->where('is_active', 1)->orderBy('id','desc')->get();
        $token_select = [];
        if(count($tokens)>0){
            foreach ($tokens as $token) {
                $token_select_arr = $token->allowed_subaccount;
                $token_select_arr = explode(', ', $token_select_arr);
                $token_select[] = [
                    [
                        'name' => $token->token_name,
                        'value' => $token->id,
                        'select' => in_array($employee->id, $token_select_arr) ? 1 : 0
                    ]
                ];
            }
        }
        $recurring_booklets = RecurringBookletDetails::where('merchant_id', $merchant)->where('status', 1)->orderBy('id','desc')->get();
        $recurring_booklet_select = [];
        if(count($recurring_booklets)>0){
            foreach ($recurring_booklets as $recurring_booklet) {
                $recurring_booklet_select_arr = $recurring_booklet->allowed_subaccount;
                $recurring_booklet_select_arr = explode(', ', $recurring_booklet_select_arr);
                $recurring_booklet_select[] = [
                    [
                        'name' => $recurring_booklet->recurring_booklet_name,
                        'value' => $recurring_booklet->id,
                        'select' => in_array($employee->id, $recurring_booklet_select_arr) ? 1 : 0
                    ]
                ];
            }
        }
        $offers = [
            'promo_select' => $promo_select,
            'coupon_select' => $coupon_select,
            'booklet_select' => $booklet_select,
            'ebooklet_select' => $ebooklet_select,
            'token_select' => $token_select,
            'recurring_booklet_select' => $recurring_booklet_select
        ];
        return $offers;        
    }

    public function getCurrencyEmpWise($emp_currency)
    {
        $currency = CurrencyCode::all();
        $currency_select = [];
        if(count($currency)>0){
            foreach ($currency as $curr) {
                $currency_select[] = [
                    'name' => $curr->currency_name.'('.$curr->country.')',
                    'value' => $curr->currency,
                    'select' => $curr->currency == $emp_currency ? 1 : 0
                ];
            }
        }
        return $currency_select;
    }

    public function getTimeZoneEmpWise($emp_time_zone)
    {
        $timezone = TimeZone::all();
        $time_zone_select = [];
        if(count($timezone)>0){
            foreach ($timezone as $time) {
                $time_zone_select[] = [
                    'name' => $time->timezone.'('.$time->country.')',
                    'value' => $time->timezone,
                    'select' => $time->timezone == $emp_time_zone ? 1 : 0
                ];
            }
        }
        return $time_zone_select;
    }

    public function getRegionEmpWise($emp_region,$merchant_id)
    {
        $region = MerchantRegion::select('id','region')->where('merchant_id',$merchant_id)->groupBy('region','id')->get();
        $region_select = [];
        if(count($region)>0){
            foreach ($region as $reg) {
                $region_select[] = [
                    'name' => $reg->region,
                    'value' => $reg->id,
                    'select' => $reg->id == $emp_region ? 1 : 0
                ];
            }
        }
        return $region_select;
    }

    public function getCountryEmpWise($emp_country)
    {
        $country = CountryCode::all();
        $country_select = [];
        if(count($country)>0){
            foreach ($country as $count) {
                $country_select[] = [
                    'name' => $count->country,
                    'value' => $count->country_code,
                    'select' => $count->country_code == $emp_country ? 1 : 0
                ];
            }
        }
        return $country_select;
    }
}
