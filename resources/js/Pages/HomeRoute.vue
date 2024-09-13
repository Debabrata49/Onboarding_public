<template>
    <div class="flex-container">
        <div class="text-item">Sub-Accounts</div>
        <div class="text-item flex-container-inner">

            <div class="search-icon">
                <form @submit.prevent="searchAction">
                    <input type="text" v-model="searchQuery" :class="{ active: isSearchActive }">
                    <button class="icon-button" @click="toggleSearch">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>


            <div class="regular-button">
                <button>
                    <div class="button-content">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </button>

                <span>Create Sub-Account</span>
            </div>
        </div>
    </div>

    <div class="text-center">
        <p>No of sub-accounts allowed: <span class="no_sub_acc">{{ merchant.no_sub_account }}</span> | No. of active sub-accounts: 3</p>
    </div>

    <div id="app">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="" class="col-name">Account Name</th>
                        <th style="width:12%" class="col-email">Email</th>
                        <th width="" class="col-password">Password</th>
                        <th width="" class="col-status">Status</th>
                        <th width="">Activated On</th>
                        <th width="" class="col-deactivate">Deactivated On</th>
                        <th width="">Valid Till</th>
                        <th width="">Outlet</th>
                        <th width="">Loyalty Structure</th>
                        <th width="" class="th-loyalty">Advanced Loyalty</th>
                        <th width="">POS Integration</th>
                        <th style="width:14%" class="th-communication">Communication</th>
                        <th width="">Permissions & Settings</th>
                        <th width="">Module Accesses</th>
                        <th width="">Edit Account</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="i in accounts">

                        <td>
                            <div class="content">
                                {{ i.name }}
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </td>

                        <td>{{ i.email }}</td>
                        <td>
                            <div class="content">
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
            </table>
            <pagination v-if="accounts != ''" v-model="page" :records="total_entries" :per-page="limit" @paginate="pagination"/>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { ref } from "vue";
import axiosService from "@/axiosService";
import Pagination from 'v-pagination-3';

export default {
    data() {
        return {
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
        };
        const searchAction = () => {
            // Handle the search logic here, using searchQuery.value
            console.log("Searching for:", searchQuery.value);
        };

        return {
            searchQuery,
            isSearchActive,
            toggleSearch,
            searchAction
        };

    },
    mounted() {
        this.getEmployeeData(this.page);
    },
    methods:{
        getEmployeeData(page_no){
            let data = { page_number: page_no };
            axiosService.post("/api/getEmployeeData", data)
            .then(res => {
                console.log(res.data.data);
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
        pagination() {
            this.getEmployeeData(this.page);
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

body {
    margin: 0;
}

.flex-container {
    display: flex;
    justify-content: space-between;
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

/* .icon-button {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 7px;
    background-color: #f8f8f8;
    border: 2px solid #361863;
    cursor: pointer;
    font-size: 18px;
    color: #361863;
} */

.regular-button {
    width: 169px;
    padding: 9px 11px;
    background-color: #2a1151;
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
    margin-left: 2%;
}

.regular-button button {
    padding: 6px 8px;
    font-size: 11px;
    background: linear-gradient(45deg, #ffb13d, #f25816);
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.text-center {
    text-align: center;
    padding: 20px;
}

.text-center p {
    font-family: "NewFont", sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #727078;
    margin: 0;
}

.search-icon form {
    display: flex;
    align-items: center;
    position: relative;
    margin-bottom: 0;
}

.search-icon input {
    width: 0;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: width 0.4s ease;
    opacity: 0;
}

.search-icon input.active {
    width: 200px;
    opacity: 1;
}

.icon-button {
    background-color: #f8f8f8;
    border: 2px solid #361863;
    cursor: pointer;
    padding: 10px;
    border-radius: 7px;
    transition: background-color 0.3s;
}




/* app css */

#app {
    background-color: #eeedf0;
    border-radius: 8px;
    width: 100%;
    overflow: hidden;
}

.content {
    display: flex;
    align-items: center;
    gap: 5px;
}

.table-container {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 18px;
    text-align: left;
    background-color: #eeedf0;
    border-radius: 8px;
}

table thead tr th {
    width: 400px;
}

th {
    font-family: "FontNew", sans-serif;
    padding: 12px 5px;
    border: 1px solid #ddd;
    font-size: 12px;
    font-weight: 400;
    color: #353b41;
}

thead {
    background-color: #eeedf0;
    border-bottom: 4px solid #b6b4b8;
}

td {
    padding: 10px;
    font-size: 12px;
    font-weight: 500;
    font-family: "Poppins", sans-serif;
    color: #441a83;
    border: 1px solid #d6cfcf;
}

tbody tr {
    background-color: #ffffff;
    margin: 3px 2px;
}

table tbody tr td ul {
    list-style-type: none;
    padding-left: 0;
}

table tbody tr td i {
    float: right;
    color: #f78e31;
}

table tbody tr:nth-child(even) {
    background: #F7F4FB;

}

.no_sub_acc{
    color: #f78e31;
}

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
