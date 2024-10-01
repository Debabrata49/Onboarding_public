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
                <a href="mailto:coffee.to.go@gmail.com">coffee.to.go@gmail.com</a>
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
                                <div class="content" :data-id="i.id" @click="loadEditAccToName(i.id, i,'name')">
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
                                <div class="content">
                                    {{ i.outletname }}
                                    <i class="bi bi-chevron-right"></i>
                                </div>
                            </td>
                            <td>
                                <div class="content">
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

                                <div class="content" :data-id="i.id" @click="loadEditAccToName(i.id, i,'edit')">
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
                <pagination v-if="accounts != ''" v-model="page" :records="total_entries" :per-page="limit"
                    @paginate="pagination" />
                <!-- <p v-else>No - Data found</p> -->
            </div>
        </div>

        <div v-if="modalPassword" class="modal-overlay" @click.self="closeModal">

            <div class="modal-password">
                <form class="password-form" @submit.prevent="sent">
                    <div class="password-content">

                        <div class="password-upper">
                            <h4>Create New Password</h4>
                            <i class="bi bi-x-circle-fill" @click="closeModal"></i>
                        </div>

                        <div class="input-container">
                            <div class="password-input">
                                <label for="pwd">Current Password</label>
                                <input type="password" name="pwd" class="pwd" placeholder="Enter Current Password">
                            </div>
                            <div class="password-input">
                                <label for="pwd">New Password</label>
                                <input type="password" name="pwd" class="pwd" placeholder="Enter New Password">
                            </div>
                            <div class="password-input">
                                <label for="pwd">Confirm Password</label>
                                <input type="password" name="pwd" class="pwd" placeholder="Re-Enter New Password">
                            </div>
                        </div>

                        <div class="sub-btn">
                            <button type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div v-if="modalName" class="modal-overlay" @click.self="closeModalName">
            <div class="modalName">

                <div class="name-upper">
                    
                    <i v-if="innerModal" class="bi bi-x-circle-fill" @click="innerModal=false"></i>
                    <i v-else class="bi bi-x-circle-fill" @click="closeModalName"></i>
                </div>

                <div class="name-form">
                    <div class="login-details">

                        <!-- <div v-if="innerModal" class="">

                            <div class="field-container">
                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726730085/folder-cloud-svgrepo-com_1_p1xcuj.svg" alt="login-icon">

                                    <p>Sub-Accounts Permission</p>

                                </div>

                                <div class="login-form">
                                    <label for="pos">Add Credits</label>

                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    
                                </div>

                                
                            </div>

                        </div> -->


                        <div class="login-heading">
                            <h4>Jumboking, Kolkata</h4>
                            <div class="name-icon">
                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1727073668/layer1_n2praq.svg" alt="name-icon">
                            </div>
                        </div>
                        
                        <div class="login-content">
                            <div class="field-container">

                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726642562/kwdd8u4nbdwnm4d5nda3.svg"
                                        alt="login-icon">

                                    <p>Login Details</p>

                                </div>
  
                                <!-- <div class="login-form">
                                    <label for="name">Name</label>
                                    <input type="text" id="name">
                                </div>

                                <div class="login-form">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" disabled>
                                </div>

                                <div class="login-form">
                                    <label for="address">Address</label>
                                    <input type="text" id="address">
                                </div>

                                <div class="login-form">
                                    <label for="business">Business</label>
                                    <input type="text" id="business">
                                </div> -->
                            </div>

                            <div class="field-container">

                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726657992/nixfuxmj09img99udgog.svg"
                                        alt="login-icon">

                                    <p>Outlet Details</p>

                                </div>

                                <!-- <div class="login-form">
                                    <label for="email">Login Id</label>
                                    <input type="email" id="email">
                                </div>

                                <div class="login-form">
                                    <label for="outlet">Outlet Name</label>

                                    <div class="input-holder">
                                        <input type="text" id="outlet">
                                        <div class="link"><i class="bi bi-link cust-link-icon"></i></div>
                                    </div>
                                    
                                </div> -->
                            </div>

                            <div class="field-container">

                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726722154/Group_fcrhwb.svg" alt="login-icon">

                                    <p>Loyalty Set - up</p>

                                </div>

                                <!-- <div class="login-form">
                                    <label for="flat">Flat</label>
                                    <input type="text" name="flat" id="flat">
                                </div>

                                <div class="login-form">
                                    <label for="loyalty">Advanced Loyalty</label>
                                    <input type="text" name="text" id="loyalty">   
                                </div> -->
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726730085/folder-cloud-svgrepo-com_1_p1xcuj.svg" alt="login-icon">

                                    <p>Sub-Accounts Permission</p>

                                </div>

                                <!-- <button class="preview-btn" @click="innerModal=true">
                                    View Permission List <i class="bi bi-box-arrow-up-right"></i>
                                </button> -->
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726736519/chat-round-line-svgrepo-com_1_iz4p9s.svg" alt="login-icon">

                                    <p>Set communication channels</p>

                                </div>

                                <!-- <div class="login-form">
                                    <label for="sms">SMS</label>
                                    <select name="sms" id="sms">
                                        <option value="0">Gupshup</option>
                                    </select>
                                </div> -->
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726738258/pos-svgrepo-com_1_l5vqn0.svg" alt="login-icon">

                                    <p>Integrate with POS Vendor</p>

                                </div>
                                <!-- <div class="login-form">
                                    <label for="vendor">Pos Vendor</label>
                                    <select name="vendor" id="vendor">
                                        <option value="0">Generic</option>
                                    </select>
                                </div>

                                <div class="login-form">
                                    <label for="key">customer key</label>
                                    <input type="text" name="key" id="key">   
                                </div> -->
                            </div>

                            <div class="field-container">

                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726738938/hashtag-square-svgrepo-com_1_jiqmg3.svg" alt="login-icon">

                                    <p>Manage POS level permissions</p>

                                </div>

                                <!-- <div class="login-form">
                                    <label for="pos">Points on discounted bill permission</label>

                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    
                                </div> -->
  
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742094/discount-svgrepo-com_2_1_kgb7s6.svg" alt="login-icon">

                                    <p>Offers</p>

                                </div>

                                <!-- <div class="login-form">
                                    <label for="promo">Promos</label>
                                    <select name="promo" id="promo">
                                        <option value="0">Promos</option>
                                    </select>
                                </div> -->
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742390/campaign-svgrepo-com_1_vx4hkk.svg" alt="login-icon">

                                    <p>Manage Campaigns</p>

                                </div>

                                <!-- <div class="login-form">
                                    <label for="instant">Instant Gratification</label>
                                    <select name="instant" id="instant">
                                        <option value="0">IG</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

        <!-- <div v-if="modalFilter" class="modal-overlay" @click.self="">

        </div> -->

        <div v-if="modalEdit" class="modal-overlay" @click.self="closeModalName">
            <div class="modalEdit">
            <div class="name-upper">
                <h4>Edit Sub Account Details</h4>
                <i class="bi bi-x-circle-fill" @click="closeModalName"></i>
            </div> 
            <div class="edit-form">
                <form class="form-edit" @submit.prevent="edit">

                    
                    <div class="input-fields">
                        <div class="edit-input" v-for="field in inputFields" :key="field.id || field.label">
                        
                        
                        <div v-if="field.type === 'multiple'">
                            <label>{{ field.label }}</label>
                            <div class="multiple-fields-container">
                                <div v-for="subField in field.fields" :key="subField.id" class="subfield-item">
                                    
                                    <vue-tel-input v-if="subField.type === 'tel'" v-model="empObj[subField.id]" 
                                   @input="validatePhone(empObj[subField.id])" 
                                   :placeholder="subField.label" :required="subField.required"></vue-tel-input>

                                    
                                    <input v-else :id="subField.id" :type="subField.type" :name="subField.id" :required="subField.required" :placeholder="subField.label">
                                    
                                </div>
                            </div>
                        </div>

                        <!-- For fields that are not of type 'multiple' -->

                        <div v-else>
                            <label :for="field.id">
                            {{ field.label }}
                            <span v-if="field.required" class="label-icon"><i class="bi bi-asterisk"></i></span>
                            </label>

                            <!-- Use vue-tel-input for telephone fields -->
                            <vue-tel-input v-if="field.type === 'tel'" v-model="empObj[field.id]" 
                                @enter="console.log('s')"
                               :placeholder="field.label" :required="field.required"/>

                            <!-- For other input types (text, password, email, etc.) -->
                            <input v-else-if="field.type !== 'select'" :id="field.id" :type="field.type" :name="field.id" :required="field.required">

                            <!-- For select input fields -->
                            <select v-else :id="field.id" :name="field.id" :required="field.required">
                            <option v-for="option in field.options" :key="option.value" :value="option.value">
                                {{ option.text }}
                            </option>
                            </select>
                        </div>

                        <i v-if="isValidPhone" class="bi bi-check-circle-fill"></i>
                        <i v-else-if="empObj[field.id]" class="bi bi-x-circle-fill"></i>

                        </div>
                    </div>


                    <div class="submit">
                        <div class="btn-container">
                            <button class="discard">DISCARD</button>
                            <button class="save" type="submit">SAVE</button>
                        </div>   
                    </div>

                </form>
            </div> 
        </div>
        </div>
        

    </div>
   
</template>

<script>
import { ref } from "vue";
import axiosService from "@/axiosService";
import Pagination from 'v-pagination-3';
import {VueTelInput} from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';


export default {
    data() {
        return {
            isLoading: true,
            allowedAccounts: 20,
            activateAccounts: 3,
            accounts: [],
            merchant: '',
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
            innerModal: false,
            inputFields: [
                { id: 'name', label: 'Name', type: 'text', required: true },
                { id: 'mobile', label: 'Mobile', type: 'text', required: false },
                { id: 'email', label: 'Email ID', type: 'email', required: true },
                { id: 'pwd', label: 'Password', type: 'password', required: true },
                { id: 'pwd_1', label: 'Confirm Password', type: 'password', required: true },
                { id: 'business', label: 'Business Name', type: 'text', required: true },
                { id: 'location', label: 'Business Location', type: 'text'},
                { id: 'category', label: 'Category', type: 'text'},
                { 
                id: 'country', 
                label: 'Country', 
                type: 'select', 
                
                options: [
                    { value: 'india', text: 'India' },
                    
                ]
                } ,

                { 
                id: 'region', 
                label: 'Region', 
                type: 'select', 
                
                options: [
                    { value: 'west bengal', text: 'West Bengal' },
                    
                ]
                } ,

                {
                label: 'ASM Details', 
                type: 'multiple', 
                fields: [
                    { id: 'aName', type: 'text'},
                    { id: 'aEmail',  type: 'email'},
                    { id: 'telephone', type: 'tel', required: true },
                ]
              },

                { id: 'manager', label: 'Manager Details', type: 'text'},



            ],
            modalEdit:false,
            empObj: {
                aName:'',
                aEmail:'',
                telephone:''
            },    
            isValidPhone: false

        };
    },

    components: {
        Pagination,
        VueTelInput
    },

    setup() {
        const searchQuery = ref('');
        const isSearchActive = ref(false);
        const toggleSearch = () => {
            isSearchActive.value = !isSearchActive.value;
            if (isSearchActive.value) {
                searchQuery.value = null;
            }
            console.log(searchQuery.value);
            this.getEmployeeData(this.page, searchQuery.value);
        };

        // const searchAction = () => {
        //     console.log("Searching for:", searchQuery.value);
        //     // this.getEmployeeData(this.page,searchQuery.value);
        // };


        return {
            searchQuery,
            isSearchActive,
            toggleSearch,
            // searchAction
        };

    },
    mounted() {
        this.getEmployeeData(this.page);
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
        loadEditAccToName(id,instance,modalName) {
            modalName === 'edit' && (this.modalEdit=true)
            modalName === 'name' && (this.modalName=true)
            this.editEmployeeProfile(id, this.shouldReCall);
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
        toggleSearch() {
            this.isSearchActive = !this.isSearchActive;
            console.log(this.isSearchActive);
            if (this.isSearchActive) {
                this.searchQuery = ''; 
            } else {
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

        validatePhone(phoneNumber) {
            console.log(phoneNumber);
            const digitsOnly = phoneNumber.replace(/\D/g, '');
            this.isValidPhone = digitsOnly.length === 10;
        }

    }
};
</script>
<style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

    @font-face {
        font-family: "MyCustomFont";
        src: url("../../font/Gilroy-ExtraBold.ttf") format("truetype");
    }

    @font-face {
        font-family: "NewFont";
        src: url("../../font/Gilroy-SemiBold.ttf") format("truetype");
    }

    @font-face {
        font-family: "FontNew";
        src: url("../../font/Gilroy-Bold.ttf") format("truetype");
    }

    @font-face {
        font-family: "CustomFont";
        src: url("../../font/Gilroy-Regular.ttf") format("truetype");
    }

    @font-face {
        font-family: "Font";
        src: url("../../font/Gilroy-Medium.ttf") format("truetype");
    }

    @font-face {
        font-family: "FontLight";
        src: url("../../font/Gilroy-Light.ttf") format("truetype");
    }


    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        --sb-track-color: #232E33;
        --sb-thumb-color: #6BAF8D;
        --sb-size: 6px;
    }

    a {
        text-decoration: none;
    }

    input:focus {
        outline: none;
    }

    .flex-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        border-bottom: 1px solid #ebebeb;
        padding: 13px 20px;
    }

    .flex-container-inner {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .text-item {
        font-family: "MyCustomFont", sans-serif;
        font-size: 20px;
        font-weight: 800;
        color: #363242;
    }

    .regular-button {
        width: 180px;
        padding: 9px 11px;
        background-color: #2a1151;
        font-size: 14px;
        color: #ffffff;
        border-radius: 7px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .regular-button span {
        font-family: "NewFont", sans-serif;
        text-wrap: nowrap;
        display: inline-block;
        font-size: 14px;
        color: #ffffff;
        font-weight: 400;
    }

    .text-left {
        width: 34%;
        display: flex;
        /* justify-content: space-between; */
        align-items: center;
        .txt-icon{
            margin-right: 6px;
        }
    }

    .text-left img {
        width: 100%;
    }

    .txt-content h3 {
        font-family: "Inter", system-ui;
        font-size: 20px;
        font-weight: 800;
        color: #363242;
        margin: 0;
    }


    .txt-content p {
        font-family: "Inter", system-ui;
        font-size: 14px;
        font-weight: 400;
        color: #727078;
        margin: 0;
    }

    .search-container {
        width: 40px;
        display: flex;
        justify-content: end;
        overflow: hidden;
        border: 1px solid #b9b3b3;
        transition: all 0.5s ease-in-out;
        border-radius: 6px;

        button {
            height: 40px;
            width: 40px;
            border: 0;
            background-color: #ffffff;
        }

        form {
            margin-bottom: 0px;
        }
    }

    .search-container.active {
        width: 250px;
    }

    .search-container.active input {
        width: 210px;
        padding: 10px;

    }

    .search-container input {
        font-family: "FontLight", sans-serif;
        width: 0px;
        border: 0;
        border-radius: 5px;
        transition: width 0.4s ease;
        height: 100%;

    }



    .search-container form input::placeholder {
        font-family: "FontLight", sans-serif;
        font-size: 12px;
        font-weight: 400;
        color: #b0adad;
    }


    .icon-button {
        background-color: #f8f8f8;
        border: 2px solid #361863;
        cursor: pointer;
        padding: 10px;
        border-radius: 7px;
        transition: width 0.4s ease, background-color 0.3s;
        font-size: 15px;
        width: 40px;
    }


    .txt-middle {
        padding: 18px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profile-button img {
        width: 100%;
    }

    .preview-btn {
        font-family: "Instrument Sans", sans-serif;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        font-size: 12px;
        font-weight: 400;
        color: white;
        width: 162px;
        padding: 11px 12px;
        border-radius: 4px;
        background-color: #2A1151;
        border: none;
    }

    /* table css */

    .table-container table {
        background-color: #ffffff;
        border-radius: 8px;
        width: 100%;
        overflow: hidden;
        border-collapse: collapse;
        font-size: 18px;
        text-align: left;
        border: 4px solid white;
        position: relative;
    }

    .table-container thead {
        background-color: #e9e1e1;
    }

    .content {
        display: flex;
        align-items: center;
        gap: 5px;
        background-color: transparent;
        padding: 5px 10px;
        color: #565459;
        border: 1px solid #eae7ee;
        border-radius: 9px;
    }

    th {
        font-family: "FontNew", sans-serif;
        padding: 12px 11px;
        border: 1px solid #ffffff;
        font-size: 12px;
        font-weight: 400;
        color: #353b41;
    }

    td {
        padding: 10px;
        font-size: 12px;
        font-weight: 500;
        font-family: "Poppins", sans-serif;
        color: #441a83;
        border: 1px solid #d6cfcf;
        cursor: pointer;
    }

    tbody tr {
        background-color: #ffffff;
        margin: 3px 2px;
        border-top: 5px solid #e1dbea;
    }

    table tbody tr td ul {
        list-style-type: none;
        padding-left: 0;
    }

    table tbody tr td i {
        float: right;
        color: #f78e31;
    }

    .cust-skeleton-loader {
        width: 100%;
        height: 30px;
        background-color: #f5f5f5;
        position: relative;
        overflow: hidden;
        border-radius: 7px;
    }

    .cust-skeleton-loader::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, #f5f5f5, #e6e6e6, #f5f5f5);
        animation: skeleton-loader-animation 1.2s infinite linear;
    }

    @keyframes skeleton-loader-animation {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .col-email {
        width: 130px;
    }


    .onboarding-body {
        padding: 0px 20px;
        background-color: #f9f7fb;
    }

    .onboarding-body-sub {
        width: 100%;
        overflow: hidden;
        overflow-x: scroll;
    }

    .table-container {
        width: 2265px;
    }

    .profile-button {
        position: relative;
    }

    .log-out {
        width: 169px;
        z-index: 99;
        position: absolute;
        top: 71px;
        right: 5px;
        border-radius: 12px;
        background-color: #ffffff;
        padding: 28px 21px;
        opacity: 0;
        transition: all 0.5s ease-in-out;
        box-shadow: 0 2px 8px 0 #00000040;
    }

    .log-out.active {
        opacity: 1;
    }

    .log-out button {
        font-family: "Font", sans-serif;
        font-size: 12px;
        font-weight: 400;
        width: 128px;
        background-color: #2a1151;
        padding: 12px 10px;
        color: white;
        border-radius: 5px;
        margin-top: 23px;
        border: 0;
    }

    .log-out h3 {
        font-family: "FontNew", sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #4f4d53;
        margin: 0 0 10px 0;
    }

    .log-out a {
        font-family: "CustomFont", sans-serif;
        font-size: 12px;
        font-weight: 400;
        color: #88878a;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-password {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        position: relative;
        transform: translateY(100%);
        animation: modalSlideUp 0.4s ease forwards;
    }


    @keyframes modalSlideUp {
        from {
            transform: translateY(200%);
        }

        to {
            transform: translateY(0);
        }
    }


    .password-form .password-content {
        display: flex;
        flex-direction: column;
    }

    .password-content .password-upper {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .password-upper h4 {
        font-family: "FontNew", sans-serif;
        font-size: 16px;
        font-weight: 400;
        color: #353b41;
        margin: 0;
    }

    .password-upper i {
        color: #3632425E;
        font-size: 20px;
        cursor: pointer;
    }

    .input-container {
        margin-top: 21px;
    }

    .password-input {
        margin-bottom: 10px;
    }

    .password-input label {
        display: block;
        font-family: "Font", sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #353B41;
        margin-bottom: 15px;
    }

    .password-input input {
        width: 100%;
        padding: 13px 17px;
        background-color: white;
        border: 1px solid #b6b4b8;
        border-radius: 12px;
    }

    .password-input input::placeholder {
        font-family: "CustomFont", sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #AAAFB4;
    }

    .sub-btn {
        margin-top: 26px;
    }

    .sub-btn button {
        width: 100%;
        border-radius: 12px;
        background-color: #361863;
        border: none;
        padding: 14px;
        color: white;
    }

    /* modalName css */

    .modalName {
        background: #faf7fd;
        border-radius: 8px;
        width: 95%;
        height: 92%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        position: relative;
        transform: translateY(100%);
        animation: modalSlideUp 0.4s ease forwards;
        padding: 20px 10px;
        overflow-x: hidden;

    }

    .name-form {
        padding: 16px 35px 16px 16px;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
    }

    .name-upper {
        text-align: center;
        position: relative;
    }


    .name-upper h4 {
        font-family: "Instrument Sans", sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: #47444c;
        margin: 0;
    }

    .name-upper i {
        position: absolute;
        color: #3632425E;
        right: -2%;
        top: 10%;
        font-size: 21px;
        cursor: pointer;
    }

    .login-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 22px 18px;
        border-bottom: 1px solid #FFDFC3;
    }

    .login-heading h4 {
        font-family: "Instrument Sans", sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #38363C;
        margin: 0;
    }

    .login-details {
        width: 23%;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 0 14px 0 #00000012;
        overflow-y: scroll;
    }

    .login-details::-webkit-scrollbar {
        display: none;
    }


    .login-content {
        padding: 22px 18px;
    }

    .field-container {
        padding: 14px 5px;
        cursor: pointer;
    }

    .login-details-heading {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .login-details-heading p {
        font-family: "Instrument Sans", sans-serif;
        font-size: 13px;
        font-weight: 700;
        margin: 0 0 0 4%;
    }

    body.modal-active {
        overflow: hidden;
        filter: blur(4px);
    }

    .login-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    /* .field-container {
        margin-top: 30px;
    } */

    .login-form label {
        font-family: "Instrument Sans", sans-serif;
        font-size: 12px;
        font-weight: 400;
        color: #615c65;
    }

    .login-form input {
        font-family: "Instrument Sans", sans-serif;
        width: 68%;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #d6cfcf;
        font-size: 12px;
        font-weight: 400;
        color: #5d5c5e;
    }

    .login-form input:focus,
    .login-form select:focus {
        outline: none;
    }

    .input-holder {
        width: 68%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #outlet {
        width: 85%;
    }

    .link {
        width: 31px;
        height: 32px;
        padding: 9px;
        background-color: #2A1151;
        border-radius: 4px;
        color: white;
        font-size: 14px;
    }


    .cust-link-icon::before {
        transform: rotate(90deg);
    }

    .login-form select {
        font-family: "Instrument Sans", sans-serif;
        width: 68%;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #d6cfcf;
        font-size: 12px;
        font-weight: 400;
        color: #5d5c5e;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 52px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 17px;
        width: 17px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .switch input:checked+.slider {
        background-color: #441A83;
    }

    .switch input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    /* modalEdit */

    .modalEdit {
        background: #FFFFFF;
        border-radius: 8px;
        width: 40%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        position: relative;
        transform: translateY(100%);
        animation: modalSlideUp 0.4s ease forwards;
        padding: 20px 24px 20px 10px;
        overflow-x: hidden;
    }

    .edit-form {
        margin-top: 12px;
    }

    .form-edit {
        margin-bottom: 0;
    }

    .input-fields {
        padding: 28px 42px 28px 22px;
        height: 432px;
        overflow-y: scroll;
    }

    .edit-input {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .edit-input>div {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .edit-input label {
        display: block;
        font-family: "Instrument Sans", sans-serif;
        font-size: 12px;
        font-weight: 400;
        color: #353B41;
        margin-bottom: 0;
    }

    .edit-input input,
    .edit-input select {
        width: 71%;
        height: 32px;
        padding: 8px 12px;
        background-color: white;
        border: 1px solid #D6CFCF;
        border-radius: 4px;
        font-family: "Instrument Sans", sans-serif;
        font-size: 12px;
        font-weight: 400;
        color: #AAAFB4;
    }

    /* .edit-input input::placeholder {
        font-family: "Instrument Sans", sans-serif;
        font-size: 12px;
        font-weight: 400;
        color: #AAAFB4;
    } */

    .label-icon {
        color: #FD0515;
        font-size: 6px;
    }


    .input-fields::-webkit-scrollbar {
        width: var(--sb-size)
    }

    .input-fields::-webkit-scrollbar-track {
        background: #A5A1AB;
        border-radius: 8px;
    }

    .input-fields::-webkit-scrollbar-thumb {
        background: #D9D9D9;
        border-radius: 8px;

    }

    .submit {
        margin-top: 14px;
    }

    .btn-container {
        width: 100%;
        margin-top: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 9%;
    }

    .discard {
        width: 105px;
        font-family: "Instrument Sans", sans-serif;
        padding: 11px 24px;
        background-color: transparent;
        border: 1px solid #2A1151;
        color: #2A1151;
        font-size: 12px;
        font-weight: 700;
        border-radius: 4px;
        margin-right: 5%;
    }

    .save {
        width: 89px;
        font-family: "Instrument Sans", sans-serif;
        padding: 11px 24px;
        background-color: #2A1151;
        color: white;
        border: 0;
        font-size: 12px;
        font-weight: 700;
        border-radius: 4px;
    }

    .multiple-fields-container {
        width: 71%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .subfield-item {
        display: flex;
        flex-direction: column;
    }

    .subfield-item input {
        width: 100%;
    }

    .subfield-item .vue-tel-input input {
        border-left: 1px solid #D6CFCF;
        border-right: 0;
        border-top: 0;
        border-bottom: 0;
        border-radius: 0;
    }

    .subfield-item .vti__dropdown-list {
        width: 240px;
    }


    /* media-query */

    @media screen and (max-width: 768px) {
        table {
            font-size: 12px;
        }

        th,
        td {
            padding: 10px;
            font-size: 10px;
        }

        th,
        td {
            white-space: nowrap;
        }

        .table-container {
            overflow-x: scroll;
        }
    }

    @media screen and (max-width: 576px) {
        table {
            font-size: 10px;
        }

        th,
        td {
            padding: 8px;
        }

        th,
        td {
            white-space: nowrap;
        }

        .table-container {
            overflow-x: auto;
        }

        th,
        td {
            max-width: 150px;
        }

        table {
            min-width: 1200px;
        }

        .flex-container {
            flex-wrap: wrap;
            justify-content: center;
        }

        .text-item {
            margin-top: 25px;
        }
    }
</style>