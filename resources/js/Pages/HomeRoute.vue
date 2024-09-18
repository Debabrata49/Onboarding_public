<template>
    <div class="flex-container">
        <div class="text-item flex-container-inner">
            
            <div class="search-container" :class="{active:isSearchActive}">
                <form @submit.prevent="searchAction">
                    <input type="text" v-model="searchQuery" placeholder="Search..."/>
                </form>
                <button class="" @click="toggleSearch">
                    <i class="bi bi-search" ></i>
                </button>
            </div>


            <div class="profile-button"  @click="modalHandel">
                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726476490/uerewobugusvnamkcmco.png"
                    alt="profile-button">
            </div>
            <div class="log-out" :class="{active:modalIsActive}" >
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
                    <h3 class="">Sub-Accounts</h3>
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
                                <div class="content" :data-id="i.id" @click="loadEditAccToName(i.id)">
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
                <pagination v-if="accounts != ''" v-model="page" :records="total_entries" :per-page="limit" @paginate="pagination" />
                <p v-else>No - Data found</p>
            </div>
        </div>
        
        <div v-if="modalPassword"  class="modal-overlay" @click.self="closeModal">

            <div class="modal-password" :class="{active:modalPassword}">
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

        <div class="modalName">

            

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
            modalIsActive:false,
            userObj :{},
            modalPassword : false,
            searchQuery: '',  // Moved searchQuery to data
            isSearchActive: false,
            shouldReCall : true
        };
    },

    components:{
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
            this.getEmployeeData(this.page,searchQuery.value);
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
    methods:{
        getEmployeeData(page_no,search=null){
            let data = { page_number: page_no, search:search };
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
        modalHandel(){
            this.modalIsActive = !this.modalIsActive;
            console.log(this.modalIsActive);
        },
        pagination() {
            this.isLoading = true;
            this.getEmployeeData(this.page);
        },
        loadEditAccToName(id) {
            console.log(id);
            this.editEmployeeProfile(id,this.shouldReCall);
        },
        handleUser(value){
            this.userObj = {...value};
            
            if (this.userObj) {
                console.log(value);
                this.modalPassword = true;
                console.log(this.modalPassword);
            }
        },
        closeModal() {
            this.modalPassword = false; 
        },
        editEmployeeProfile(id,shouldReCall){
            if(shouldReCall == false){
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
            }else{
                this.isLoading = true;
                this.getEmployeeData(this.page, this.searchQuery);
            }            
        },
        logoutCall(){
            axiosService.post("/api/logout", [])
            .then(res => {
                console.log(res.data);
                if(res.data.error == false){
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

<style scoped>
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
}

a {
    text-decoration: none;
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
    justify-content: space-between;
    align-items: center;
}

.text-left img {
    width: 100%;
}

.txt-content h3 {
    font-family: "Inter", system-ui;
    font-size: 20px;
    font-weight: 800;
    color: #363242;
    margin: 0 0 10px 0;
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

.search-container input:focus {
    outline: none;
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
    background-color: #2a1151;
    padding: 5px 10px;
    color: #ffffff;
    border-radius: 5px;
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
    /* Semi-transparent black background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    /* Make sure it appears on top of everything */
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

.sub-btn{
    margin-top: 26px;
}

.sub-btn button{
    width: 100%;
    border-radius: 12px;
    background-color: #361863;
    border: none;
    padding: 14px;
    color: white;
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