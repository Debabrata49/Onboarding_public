<template>

    <div class="flex-container">
        <div class="text-item flex-container-inner">

            <div class="search-container" :class="{ active: isSearchActive }">
                <form @submit.prevent="searchAction">
                    <input type="text" v-model="searchQuery" placeholder="Search..." />
                </form>
                <button class="" @click="toggleSearch">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            <div class="profile-button" @click="modalHandel">
                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726476490/uerewobugusvnamkcmco.png"
                    alt="profile-button">
            </div>
            <div class="log-out" :class="{ active: modalIsActive }">
                <h3>{{ merchant.business_name }}</h3>
                <p>coffee.to.go@gmail.com</p>
                <button @click="logoutCall">Log Out</button>
            </div>

        </div>
    </div>

    <div class="onboarding-body">

        <div class="txt-middle">
            <div class="text-left">

                <div class="txt-icon">
                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726477817/folder-with-files-svgrepo-com_1_epmxrz.png"
                        alt="txt-icon">
                </div>

                <div class="txt-content">
                    <h3 class="text">Sub-Accounts</h3>
                    <p>Total sub-accounts allowed: <span class="no_sub_acc">{{ merchant.no_sub_account }}</span> |  Active sub-accounts: 3</p>
                </div>
            </div>
            <div class="regular-button">
                <div class="button-content">
                    <i class="bi bi-plus-lg"></i>
                </div>
                <span>Create Sub-Account</span>
            </div>
        </div>


        <div class="onboarding-parent">
            <div class="onboarding-body-sub">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th width="5%" class="col-name">Account Name</th>
                                <th width="10%" class="col-email">Email</th>
                                <th width="5%" class="col-password">Password</th>
                                <th width="5%" class="col-status">Status</th>
                                <th width="10%">Activated On</th>
                                <th width="10%" class="col-deactivate">Deactivated On</th>
                                <th width="5%">Valid Till</th>
                                <th width="5%">Outlet</th>
                                <th width="5%">Loyalty Structure</th>
                                <th width="7%" class="th-loyalty">Advanced Loyalty</th>
                                <th width="7%">POS Integration</th>
                                <th width="11%" class="th-communication">Communication</th>
                                <th width="5%">Permissions & Settings</th>
                                <th width="5%">Module Accesses</th>
                                <th width="5%">Edit Account</th>
                            </tr>
                        </thead>
                        <tbody v-if="!isLoading">
                            <tr v-for="i in accounts">
                                <td>
                                    <div class="content" :data-id="i.id" @click="loadEditAccToName(i.id, i, 'name','tab-one')">
                                        {{ i.name }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>

                                <td>{{ i.email }}</td>
                                <td>
                                    <div class="content" @click="handleUser(i)">
                                        {{ i.password }}
                                        <i class="bi bi-pencil"></i>
                                    </div>
                                </td>
                                <td>{{ i.status }}</td>
                                <td>{{ i.active_on }}</td>
                                <td>{{ i.deactive_on }}</td>
                                <td>{{ i.valid_till }}</td>

                                <td>
                                    <div class="content" @click="openLoyaltySetupTab(i.outletname)">
                                        {{ i.outletname }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="content" @click="loadEditAccToName(i.id, i, 'name','tab-three')">
                                        {{ i.loyalty_percentage }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="content">
                                        {{ i.adv_loyalty }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="content">
                                        {{ i.pos_vendor_name }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <ul>
                                        <li>{{ i.sms_vendor_name }}</li>
                                        <li>{{ i.promo_sms_vendor_name }}</li>
                                        <li>{{ i.whatsapp_vendor_name }}</li>
                                    </ul>
                                </td>
                                <td>{{ i.permission_text }}</td>
                                <td>{{ i.module_access }}</td>
                                <td>

                                    <div class="content" :data-id="i.id" @click="testModalHandle(i)">
                                        {{ i.edit }}
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr v-for="j in [...new Array(15)]">
                                <td v-for="k in [...new Array(15)]">
                                    <div class="cust-skeleton-loader"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <pagination v-if="accounts != ''" v-model="page" :records="total_entries" :per-page="limit"
            @paginate="pagination" />
        </div>

        
        <ModalPassword :modalPassword="modalPassword" :closeModal="closeModal"/>

        <ModalName :currentTab="currentTab" :modalName = "modalName" :closeModalName = "closeModalName"/>

        <EditModal :modalEdit = "modalEdit" :closeModalName="closeModalName"/>

        
    </div>

</template>

<script>

import { ref } from "vue";
import axiosService from "@/axiosService";
import Pagination from 'v-pagination-3';
import { VueTelInput } from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';
import EditModal from "./components/EditModal.vue";
import ModalPassword from "./components/ModalPassword.vue";
import ModalName from "./components/ModalName.vue";


export default {
    data() {
        return {
            isLoading: true,
            allowedAccounts: 20,
            activateAccounts: 3,
            accounts: [],
            merchant: '',
            isLoading: true,
            page: 1,
            current_page: 0,
            total_entries: 0,
            total_pages: 0,
            next_page: 0,
            limit: 0,
            modalIsActive: false,
            userObj: {},
            empObj: {},
            modalPassword: false,
            searchQuery: '',  // Moved searchQuery to data
            isSearchActive: false,
            shouldReCall: true,
            modalName: false,
            modalEdit: false,
            form: {
                mobile: ''
            },

            iso_code: 'IN',
            isValidPhone: false,
            currentTab: 'tab-one',
            emp_arr: {
                emp_name: '',
                emp_email: '',
                emp_mobile: '',
                emp_password: '',
                emp_confirm_password: '',
                emp_business_name: '',
                emp_business_location: '',
                emp_category: '',
                emp_loyalty_percentage: '',
                emp_maxallow_award_trans: '',
                emp_loyalty_percentage_chk: 0,
                emp_note: '',
                asm_data: [],
                manager_data: [],
                emp_country: [],
                emp_currency: [],
                emp_timezone: [],
                emp_region: [],
            },

            loginForm: {
                name: '',
                email: 'user@example.com', // Default email, since it's disabled.
                address: '',
                business: ''
            },

            outletForm: {
                email: '',
                outletName: ''
            },

            loyaltyForm: {
                flat: '',
                loyalty: ''
            },

            addCredits: false,
            verifyCode: false,
            pendingRequests: false,
            redeemCredits: false,
            customEwallet: false,
            pointsOnDiscountedBill: false,
            pointsOnCouponRedemption: false,
            pointsOnTax: false,
            pointsOnDiscountedItem: false,
            redeemAddCreditsPermission: false,

            selectedSms: '*',
            selectedWhatsApp: '*',
            selectedEmail: '*',
            posVendor:'',
            customerKey:'',

            couponredemptionPoint:false,
            discountedbillPoint:false,
            discounteditemPoint:false,
            taxPoint:false,
            creditsPermission:false,

            perPage: 3,        
            currentPage: 1,

           

            

        };
    },

   

    computed: {
      rows() {
        return this.tableData ? this.tableData.length : 0;  
      },
      paginatedData() {
        
        if (this.tableData && this.tableData.length > 0) {
          const start = (this.currentPage - 1) * this.perPage;
          const end = start + this.perPage;
          return this.tableData.slice(start, end);
        }
        return [];
      }
    },

    components: {
        Pagination,
        VueTelInput,
        EditModal,
        ModalPassword,
        ModalName,
        
    },

    setup() {
        const searchQuery = ref('');
        const isSearchActive = ref(false);
        const toggleSearch = () => {
            isSearchActive.value = !isSearchActive.value;
            if (isSearchActive.value) {
                searchQuery.value = null;
            }
            // console.log(searchQuery.value);
            this.getEmployeeData(this.page, searchQuery.value);
        };

        return {
            searchQuery,
            isSearchActive,
            toggleSearch,
            // searchAction
        };

    },

    mounted() {
        this.getEmployeeData(this.page);
        this.currentModalTab = this.currentTab;
    },

    methods: {
        getEmployeeData(page_no, search = null) {
            let data = { page_number: page_no, search: search };
            axiosService.post("/api/getEmployeeData", data)
                .then(res => {
                    console.log(res.data.data);
                    this.isLoading = false;
                    this.accounts = res.data.data.employees;
                    this.merchant = res.data.data.merchant;
                    this.current_page = res.data.data.current_page;
                    this.total_entries = res.data.data.total_entries;
                    this.total_pages = res.data.data.total_pages;
                    this.limit = res.data.data.limit;
                    this.next_page = res.data.data.next_page;
                })
                .catch((err) => {
                    console.log(err);
                })
        },

        modalHandel() {
            this.modalIsActive = !this.modalIsActive;
            console.log(this.modalIsActive);
        },

        pagination() {
            this.isLoading = true;
            this.getEmployeeData(this.page);
        },

        loadEditAccToName(id, instance, modalName,tab) {
            this.currentTab = tab
            modalName === 'edit' && (this.modalEdit = true)
            modalName === 'name' && (this.modalName = true)
            this.editEmployeeProfile(id, this.shouldReCall);
        },
        loadEditSubAccount(id) {
            this.editEmployeeData(id, this.shouldReCall);
        },
        handleUser(value) {
            this.userObj = { ...value };

            if (this.userObj) {
                this.modalPassword = true;
                console.log(this.modalPassword);
            }
        },

        closeModal() {
            this.modalPassword = false;
        },

        closeModalName() {
            this.modalName = false;
            this.modalEdit = false
        },
        editEmployeeProfile(id, shouldReCall) {
            if (shouldReCall == false) {
                return false;
            }
            this.shouldReCall = false;
            let data = { employee_id: id };
            axiosService.post("/api/editEmployeeProfile", data)
                .then(res => {
                    console.log(res.data.data);
                    this.shouldReCall = true;
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        editEmployeeData(id, shouldReCall){
            if (shouldReCall == false) {
                return false;
            }
            this.shouldReCall = false;
            let data = { employee_id: id };
            axiosService.post("/api/getEditEmployeeMain", data)
                .then(res => {
                    console.log(res.data.data);
                    this.emp_arr = res.data.data;
                    this.modalEdit=true;
                })
                .catch((err) => {
                    console.log(err);
                }).finally(() => {
                    this.shouldReCall = true;
                });
        },
        toggleSearch() {
            this.isSearchActive = !this.isSearchActive;
            console.log(this.isSearchActive);
            if (this.isSearchActive) {
                this.searchQuery = '';
            }
            if(this.searchQuery!=='') {
                this.isLoading = true;
                this.getEmployeeData(this.page, this.searchQuery);
            }
        },

        logoutCall() {
            axiosService.post("/api/logout", [])
                .then(res => {
                    console.log(res.data);
                    if (res.data.error == false) {
                        localStorage.removeItem("access_token");
                        localStorage.removeItem("expires_in");
                        window.location.reload();
                    }
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    // Ensure the tokens are removed regardless of success or failure
                    localStorage.removeItem("access_token");
                    localStorage.removeItem("expires_in");
                    window.location.reload();
                });
        },

        submitLoginForm() {
            console.log('Login Form Data:', this.loginForm);
            this.loginForm = { name: '', email: '', address: '', business: '' };
        },

        resetLoginForm() {
            this.loginForm = {
                name: '',
                email: 'user@example.com', 
                address: '',
                business: ''
            };
        },

        submitOutletDetails() {
            console.log('Outlet Details:', this.outletForm);
            this.resetOutletForm();
        },

        resetOutletForm() {
            this.outletForm = {
                email: '',
                outletName: ''
            };
        },

        submitLoyaltyDetails() {
            console.log('Login Form Data:', this.loyaltyForm);
            this.loyaltyForm = { flat: '', loyalty: ''};
        },

        resetLoyaltyForm() {
            this.loyaltyForm = {
                flat: '',
                loyalty: ''
            };
        },

        submitSubaccountDetails() {

        const formData = {
            addCredits: this.addCredits,
            verifyCode: this.verifyCode,
            pendingRequests: this.pendingRequests,
            redeemCredits: this.redeemCredits,
            customEwallet: this.customEwallet,
            pointsOnDiscountedBill: this.pointsOnDiscountedBill,
            pointsOnCouponRedemption: this.pointsOnCouponRedemption,
            pointsOnTax: this.pointsOnTax,
            pointsOnDiscountedItem: this.pointsOnDiscountedItem,
            redeemAddCreditsPermission: this.redeemAddCreditsPermission,
        };

        console.log('Form Data:', formData);

        this.resetForms();

        },

        discardChanges() {
        this.resetForms();
        },

        resetForms() {   
        this.addCredits = false;
        this.verifyCode = false;
        this.pendingRequests = false;
        this.redeemCredits = false;
        this.customEwallet = false;
        this.pointsOnDiscountedBill = false;
        this.pointsOnCouponRedemption = false;
        this.pointsOnTax = false;
        this.pointsOnDiscountedItem = false;
        this.redeemAddCreditsPermission = false;
        },

        submitCommunicationDetails() {
            console.log("Selected SMS:", this.selectedSms);
            console.log("Selected WhatsApp:", this.selectedWhatsApp);
            console.log("Selected Email:", this.selectedEmail);

      // Make an API call with the selected data
            const communicationDetails = {
                sms: this.selectedSms,
                whatsApp: this.selectedWhatsApp,
                email: this.selectedEmail,
            }; 

        },

        resetCommunicationDetails() {
            this.selectedSms = '*';
            this.selectedWhatsApp = '*';
            this.selectedEmail = '*';
        },

        submitPosvendorDetails() {
            
            console.log('POS Vendor:', this.posVendor);
            console.log('Customer Key:', this.customerKey);

            const formData = {
                vendor: this.posVendor,
                key: this.customerKey
            };

        },

        resetPosvendorDetails() {
            this.posVendor = '';
            this.customerKey = '';
        },

        submitPospermissionDetails(){

            const newData = {

                couponredemptionPoint: this.couponredemptionPoint,
                discountedbillPoint: this.discountedbillPoint,
                discounteditemPoint: this.discounteditemPoint,
                taxPoint: this.taxPoint,
                creditsPermission: this.creditsPermission
            };

            console.log('New Data:', newData);

            this.resetPermission();

        },

        discardValues() {
        this.resetPermission();
        },

        resetPermission(){
            this.couponredemptionPoint = false,
            this.discountedbillPoint = false,
            this.discounteditemPoint = false,
            this.taxPoint = false,
            this.creditsPermission = false
        },

        testModalHandle(){
            this.modalEdit = true;
        },

        
  


    }
};

</script>
