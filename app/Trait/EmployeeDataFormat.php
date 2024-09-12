<?php

namespace App\Trait;
use App\Models\SmsVendor;
use App\Models\WhatsappVendor;
use App\Models\EmailVendor;
use App\Models\PosRegistration;
use App\Models\PosVendorRegistration;

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
                    'name' => 'Yes',
                    'value' => 'transaction',
                    'select' => $pos_reg->coupon_redeem_transaction == 'transaction' ? 1 : 0
                ],
                [
                    'name' => 'No',
                    'value' => 'checkin',
                    'select' => $pos_reg->coupon_redeem_transaction == 'checkin' ? 1 : 0
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
}
