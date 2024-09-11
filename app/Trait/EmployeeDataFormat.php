<?php

namespace App\Trait;

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
}
