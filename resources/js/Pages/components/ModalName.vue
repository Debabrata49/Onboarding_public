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

                            <div class="login-details-heading" @click="currentModalTab = 'tab-seven'">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726738938/hashtag-square-svgrepo-com_1_jiqmg3.svg"
                                    alt="login-icon">

                                <p>Manage POS level permissions</p>

                            </div>
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="currentModalTab = 'tab-eight'">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742094/discount-svgrepo-com_2_1_kgb7s6.svg"
                                    alt="login-icon">

                                <p>Offers</p>

                            </div>  
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="currentModalTab = 'tab-nine'">

                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742390/campaign-svgrepo-com_1_vx4hkk.svg"
                                    alt="login-icon">

                                <p>Manage Campaigns</p>

                            </div>  
                        </div>

                        <div class="field-container">
                            <div class="login-details-heading" @click="currentModalTab = 'tab-ten'">

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

                    <div v-if="currentModalTab === 'tab-seven'" class="tab-seven">

                        <div class="tab-content">

                            <h3>Manage POS level permissions</h3>

                            <form class="modal-form" @submit.prevent="submitPospermissionDetails">

                                <div class="tab-div">

                                    <div class="txt-div">
                                        <div class="txt">
                                            <p>Points on coupon redemption</p>
                                        </div>
                                        <label class="switch">
                                            <input type="checkbox" v-model="couponredemptionPoint" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="txt-div">
                                        <div class="txt">
                                            <p>Points on discounted bill permission</p>
                                        </div>
                                        <label class="switch">
                                            <input type="checkbox" v-model="discountedbillPoint" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="txt-div">
                                        <div class="txt">
                                            <p>Points on discounted Item</p>
                                        </div>
                                        <label class="switch">
                                            <input type="checkbox" v-model="discounteditemPoint" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="txt-div">
                                        <div class="txt">
                                            <p>Points on tax</p>
                                        </div>
                                        <label class="switch">
                                            <input type="checkbox" v-model="taxPoint" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="txt-div">
                                        <div class="txt">
                                            <p>Redeem/Add credits permission</p>
                                        </div>
                                        <label class="switch">
                                            <input type="checkbox" v-model="creditsPermission" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                </div>

                                <div class="modal-sub">
                                    <button type="button" class="discard" @click="discardValues">DISCARD</button>
                                    <button class="save" type="submit">SAVE</button>
                                </div>


                            </form>

                        </div>
                    </div>

                    <div v-if="currentModalTab === 'tab-eight'" class="tab-eight">

                        <div class="tab-content">

                            <h3>Offers / Promos</h3>

                            <div class="modal-form" @submit.prevent="submitOfferDetails">

                                <div class="tab-div">

                                    <div class="new-table">

                                        <table>

                                            <thead>
                                                <tr>
                                                    <th class="name">Promo name</th>
                                                    <th class="validity">Promo Type</th>
                                                    <th class="issue">Validity</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td>classsic promo_01</td>
                                                    <td>Open</td>
                                                    <td>2nd Jan 23 to 4th April 24</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>classsic promo_01</td>
                                                    <td>Open</td>
                                                    <td>2nd Jan 23 to 4th April 24</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>classsic promo_01</td>
                                                    <td>Open</td>
                                                    <td>2nd Jan 23 to 4th April 24</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>classsic promo_01</td>
                                                    <td>Open</td>
                                                    <td>2nd Jan 23 to 4th April 24</td>
                                                    
                                                </tr>

                                                
                                            </tbody>

                                        </table>

                                    </div>


                                </div>

                                
                            </div>

                        </div>
                    </div>

                    <div v-if="currentModalTab === 'tab-nine'" class="tab-nine">
                        <div class="tab-content">

                            <h3>Campaigns / Auto Engagement</h3>

                            <div class="modal-form" @submit.prevent="submitCampaignDetails">

                                <div class="tab-div">

                                    <div class="new-table">

                                        <table>

                                            <thead>
                                                <tr>
                                                    <th class="name">Name</th>
                                                    <th class="validity">Database</th>
                                                    <th class="days">Segment Name</th>
                                                    <th class="issue">Gratification</th>
                                                    <th class="segment">Communication</th>
                                                    <th class="issue">Trigger Frequency</th>
                                                    <th class="segment">Pause</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td>High_end_campaign_74</td>
                                                    <td>Full Database</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>View Details</td>
                                                    <td>Daily</td>
                                                    <td></td>
                                                </tr>

                                                

                                                
                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div v-if="currentModalTab === 'tab-ten'" class="tab-ten">
                        <div class="tab-content">

                            <h3>Membership Package</h3>

                            <div class="modal-form" @submit.prevent="submitPackageDetails">

                                <div class="tab-div">

                                    <div class="new-table">

                                        <table>

                                            <thead>
                                                <tr>
                                                    <th class="name">Name</th>
                                                    <th class="validity">Validity(days)</th>
                                                    <th class="issue">Total Issues</th>
                                                    <th class="days">Individual Issue Limit</th>
                                                    <th class="segment">Linked Segment</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="overflow-auto">

                                        <b-pagination
                                        v-model="currentPage"
                                        :total-rows="rows"
                                        :per-page="perPage"
                                        aria-controls="my-table"
                                        prev-text="Prev"    
                                        next-text="Next"    
                                        hide-goto-end-buttons  
                                        class="my-pagination"  
                                        ></b-pagination>

                                        <p class="mt-3">Current Page: {{ currentPage }}</p>

                                        <b-table
                                        id="my-table"
                                        :items="paginatedData"   
                                        :per-page="perPage"
                                        :current-page="currentPage"
                                        small
                                        >
                                        

                                        </b-table>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</template>

<script>
import LoginDetails from './tabs/LoginDetails.vue';
import OutletDetails from './tabs/OutletDetails.vue';
import LoyaltySetUP from './tabs/LoyaltySetUP.vue';
import SubAcc from './tabs/SubAcc.vue';
import SetCom from './tabs/SetCom.vue';
import PosVendor from './tabs/PosVendor.vue';

export default {
    data() {
        return {
            currentModalTab :"tab-one",
        };
    },

    props:{
     modalName: Boolean,
     closeModalName: Function,
     tabName: String
    },

    computed: {
    },

    components: {
        LoginDetails,
        OutletDetails,
        LoyaltySetUP,
        SubAcc,
        SetCom,
        PosVendor
        
    },

    setup() {
        

    },

    mounted() {
        
    },

    methods: {
        switchModalTab(tabName) {
            this.currentModalTab = tabName;
        },
    }
};

</script>