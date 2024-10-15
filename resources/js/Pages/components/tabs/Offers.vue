<template>

    <div v-if="currentModalTab === 'tab-eight'" class="tab-eight">
        <div class="tab-content">

            <h3>Offers / Promos</h3>

            <div class="modal-form">

                <div class="tab-div">

                    <div class="new-table">

                        <div class="tab-heading-container">

                            <span class="tab-heading" :class="{ active: selectedTab === 'promos' }"
                                @click="setActiveTab('promos')">Promos</span>

                            <span class="tab-heading" :class="{ active: selectedTab === 'coupons' }"
                            @click="setActiveTab('coupons')"
                            >Coupons</span>

                            <span class="tab-heading" :class="{ active: selectedTab === 'booklets' }"

                            @click="setActiveTab('booklets')"
                            >Booklets</span>


                            <span class="tab-heading" :class="{ active: selectedTab === 'ebooklets' }"
                            @click="setActiveTab('ebooklets')"
                            >E-Booklets</span>

                            <span class="tab-heading" :class="{ active: selectedTab === 'recurringBooklets' }"
                            @click="setActiveTab('recurringBooklets')"
                            >Recurring
                                Booklets</span>

                            <span class="tab-heading" :class="{ active: selectedTab === 'wallet' }"

                            @click="setActiveTab('wallet')"
                            >Wallet</span>
                        </div>

                        <div class="tab-table">

                            <table v-if="tableColumns.length">
                                <thead>
                                    <tr>
                                        <th v-for="(column, index) in tableColumns" :key="index">{{ column.label }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in tableData" :key="item.id">
                                        <td v-for="(column, index) in tableColumns" :key="index">
                                            {{ item[column.key] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div v-if="!tableColumns.length">
                                No data available for this tab.
                            </div>

                        </div>

                    </div>


                </div>


            </div>

        </div>
    </div>

</template>

<script>

import axios from 'axios';

export default {
    data() {
        return {
            selectedTab: "promos",
            tableData: [],
            tableColumns: []
        };
    },

    props: {
        currentModalTab: String,
    },

    computed: {

    },

    components: {

    },

    setup() {

    },

    mounted() {

        this.setTableColumns();
        this.fetchTabData();

    },

    methods: {

        setActiveTab(tab) {
            this.selectedTab = tab;
            this.fetchTabData();
            this.setTableColumns();
        },

        setTableColumns() {
            const columnMapping = {
                promos: [
                    { label: 'Promo Name', key: 'name' },
                    { label: 'Promo Type', key: 'type' },
                    { label: 'Validity', key: 'valid' }
                ],
                coupons: [
                    { label: 'Coupon Name', key: 'name' },
                    { label: 'Coupon Validity', key: 'valid' },
                    { label: 'Issued', key: 'issue' },
                    { label: 'Redeemed', key: 'redeemed' },

                ],
                booklets: [
                    { label: 'Booklet Name', key: 'name' },
                    { label: 'No. of Coupons in the Booklet', key: 'coupon' },
                    { label: 'Booklets Issued', key: 'issue' },
                    { label: 'Booklet Value', key: 'value' }
                ],
                ebooklets: [
                    { label: 'e-Booklet Name', key: 'id' },
                    { label: 'Top Up Value', key: 'value' },
                    { label: 'Validity Of Credits (days)', key: 'credit' },
                    { label: 'e-Booklet Price', key: 'price' },
                    { label: 'e-Booklet Issued', key: 'issue' },

                ],
                recurringBooklets: [
                    { label: 'Booklet Name', key: 'name' },
                    { label: 'Booklet Price', key: 'price' },
                    { label: 'Start Date', key: 'cycle' },
                    { label: 'Booklet Issued', key: 'issue' },
                    { label: 'Booklet Revenue', key: 'revenue' },

                ],
                wallet: [
                    { label: 'Wallet Name', key: 'walletName' },
                    { label: 'Top Up Value', key: 'topUpValue' },
                    { label: 'Validity (days)', key: 'validity' },
                    { label: 'Wallet Price', key: 'walletPrice' },
                    { label: 'Issued', key: 'issued' }
                ]
            };
            this.tableColumns = columnMapping[this.selectedTab] || [];
        },

        fetchTabData() {
            let apiUrl = '';
            switch (this.selectedTab) {
                case 'promos':
                    apiUrl = '/api/promos';
                    break;
                case 'coupons':
                    apiUrl = '/api/coupons';
                    break;
                case 'booklets':
                    apiUrl = '/api/booklets';
                    break;
                case 'ebooklets':
                    apiUrl = '/api/ebooklets';
                    break;
                case 'recurringBooklets':
                    apiUrl = '/api/recurring-booklets';
                    break;
                case 'wallet':
                    apiUrl = 'https://670e306d073307b4ee45d062.mockapi.io/test/api/wallet';
                    break;
            }

            axios.get(apiUrl)
                .then(response => {
                    this.tableData = response.data;  // Store the data from the API
                    console.log(this.tableData);
                    
                })
                .catch(error => {
                    console.error("Error fetching data: ", error);
                });
        }
    }

}
</script>