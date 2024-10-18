<template>

    <div v-if="modalName" class="modal-overlay" @click.self="closeModalName">
        <div class="modalName">

            <div class="upper-new">
                <i v-if="innerModal" class="bi bi-x-circle-fill" @click="innerModal = false"></i>
                <i v-else class="bi bi-x-circle-fill" @click="closeModalName"></i>
            </div>

            <div class="name-form">

                <div class="login-details">

                    <div class="login-heading">
                        <h4>Jumboking, Kolkata</h4>
                        <div class="name-icon">
                            <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1727073668/layer1_n2praq.svg"
                                alt="name-icon">
                        </div>
                    </div>

                    <div class="login-content">

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-one')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726642562/kwdd8u4nbdwnm4d5nda3.svg"
                                    alt="login-icon">

                                <p>Login Details</p>

                            </div>
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-two')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726657992/nixfuxmj09img99udgog.svg"
                                    alt="login-icon" />

                                <p>Outlet Details</p>

                            </div>
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-three')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726722154/Group_fcrhwb.svg"
                                    alt="login-icon">

                                <p>Loyalty Set - Up</p>

                            </div>
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-four')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726730085/folder-cloud-svgrepo-com_1_p1xcuj.svg"
                                    alt="login-icon">

                                <p>Sub-Accounts Permission</p>

                            </div>
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-five')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726736519/chat-round-line-svgrepo-com_1_iz4p9s.svg"
                                    alt="login-icon">

                                <p>Set communication channels</p>

                            </div>  
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-six')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726738258/pos-svgrepo-com_1_l5vqn0.svg"
                                    alt="login-icon">

                                <p>Integrate with POS Vendor</p>

                            </div>
                            
                        </div>

                        <div class="field-container">

                            <div class="login-details-heading" @click="switchModalTab('tab-seven')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726738938/hashtag-square-svgrepo-com_1_jiqmg3.svg"
                                    alt="login-icon">

                                <p>Manage POS level permissions</p>

                            </div>
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-eight')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742094/discount-svgrepo-com_2_1_kgb7s6.svg"
                                    alt="login-icon">

                                <p>Offers</p>

                            </div>  
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-nine')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742390/campaign-svgrepo-com_1_vx4hkk.svg"
                                    alt="login-icon">

                                <p>Manage Campaigns</p>

                            </div>  
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="switchModalTab('tab-ten')">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1728043238/Vector_umkhns.svg" alt="login-icon">

                                <p>Membership Package</p>

                            </div>   
                        </div>
                    </div>

                </div>

                <div class="modal-tab">

                    <LoginDetails :currentModalTab="currentModalTab"/>

                    <OutletDetails :currentModalTab="currentModalTab"/>

                    <LoyaltySetUP :currentModalTab="currentModalTab"/>

                    <SubAcc :currentModalTab="currentModalTab"/>
                     
                    <SetCom :currentModalTab="currentModalTab"/>

                    <PosVendor :currentModalTab = "currentModalTab"/>

                    <PosPermission :currentModalTab = "currentModalTab"/>

                     <Offers :currentModalTab = "currentModalTab"/>

                     <Campaign :currentModalTab = "currentModalTab"/>

                     <Package :currentModalTab = "currentModalTab"/>

                </div>

            </div>

        </div>
    </div>

</template>

<script>
import LoginDetails from './tabs/LoginDetails.vue';
import OutletDetails from './tabs/OutletDetails.vue';
import LoyaltySetUP from './tabs/LoyaltySetUp.vue';
import SubAcc from './tabs/SubAcc.vue';
import SetCom from './tabs/SetCom.vue';
import PosVendor from './tabs/PosVendor.vue';
import PosPermission from './tabs/PosPermission.vue';
import Offers from './tabs/Offers.vue';
import Campaign from './tabs/Campaign.vue';
import Package from './tabs/Package.vue'



export default {
    data() {
        return {
            currentModalTab :this.currentTab,
        };
    },

    props:{
     modalName: Boolean,
     closeModalName: Function,
     tabName: String,
     currentTab: String
    },

    computed: {
    },

    components: {
        LoginDetails,
        OutletDetails,
        LoyaltySetUP,
        SubAcc,
        SetCom,
        PosVendor,
        PosPermission,
        Offers,
        Campaign,
        Package
    },

    setup() {
    },

    mounted() {
    },

    methods: {
        switchModalTab(tabName) {
            if (tabName) {
                this.currentModalTab = tabName;
            }
        },
    },
};

</script>