<template>

    <div v-if="currentModalTab === 'tab-four'" class="tab-four">

        <div class="tab-content">

            <h3>Sub-Accounts Permission</h3>

            <form class="modal-form" @submit.prevent="submitSubaccountDetails()">

                <div class="tab-div">

                    <div class="txt-div">
                        <div class="txt">
                            <p>Add Credits</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="addCredits" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Verify code</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="verifyCode" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Pending Requests</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="pendingRequests" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Redeem Credits</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="redeemCredits" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Custom e-wallet</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="customEwallet" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Points on discounted bill permission</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="pointsOnDiscountedBill" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Points on coupon redemption</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="pointsOnCouponRedemption" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Points on tax</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="pointsOnTax" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Points on discounted Item</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="pointsOnDiscountedItem" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="txt-div">
                        <div class="txt">
                            <p>Redeem/Add credits permission</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" v-model="redeemAddCreditsPermission" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                </div>

                <div class="modal-sub">
                    <button type="button" class="discard" @click="discardChanges()">DISCARD</button>
                    <button class="save" type="submit">SAVE</button>
                </div>


            </form>

        </div>
    </div>

</template>

<script>

export default {
    data() {
        return {
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

    },

    methods: {
        
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
  
    }
};

</script>