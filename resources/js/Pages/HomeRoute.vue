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

            <div class="profile-button">
                <i class="bi bi-person"></i>
            </div>
    
        </div>
    </div>
    <div class="onboarding-body">

        <div class="txt-middle">
            <div class="text-center">
                <p>No of sub-accounts allowed: 20 | No. of active sub-accounts: 3</p>
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
                    <tbody v-else>
                        <tr v-for="j in [...new Array(5)]">
                            <td v-for="k in [...new Array(15)]">
                                <div class="cust-skeleton-loader"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import axiosService from "@/axiosService";

export default {
    data() {
        return {
            isLoading: true,
            allowedAccounts: 20,
            activateAccounts: 3,
            accounts: [],
        };
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
        let data = { page_number: 1 };
        axiosService.post("/api/getEmployeeData", data)
            .then(res => {
                if (res) {
                    this.accounts = res.data.data.employees;
                    this.isLoading = false;
                }
            })
            .catch((err) => {
                console.log(err);
            })
    }
};
</script>