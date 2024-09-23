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
                    <pre><p>Total sub-accounts allowed: <span class="no_sub_acc">{{ merchant.no_sub_account }}</span> |  Active sub-accounts: 3</p></pre>
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
                                <div class="content" :data-id="i.id" @click="loadEditAccToName(i.id, i)">
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
                            <td>{{ i.edit }}</td>
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
                    <!-- <h4>Jumboking, Kolkata</h4> -->
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
                    <!-- <div class="this">s</div> -->
                </div>
            </div>
        </div>

        <div v-if="modalFilter" class="modal-overlay" @click.self="">

        </div>

    </div>
</template>

<script>
import { ref } from "vue";
import axiosService from "@/axiosService";
import Pagination from 'v-pagination-3';

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
        };
    },

    components: {
        Pagination
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
        loadEditAccToName(id) {
            // console.log(this.empObj.name);
            this.modalName = true;

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
            this.modalName = false;// Remove blur effect when closing
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
                this.searchQuery = ''; // Assuming searchQuery is in data or methods
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
        }
    }
};
</script>
