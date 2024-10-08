<template>

<div v-if="currentModalTab === 'tab-six'" class="tab-six">

<div class="tab-content">

    <h3>Integrate with POS Vendor</h3>

    <form class="modal-form" @submit.prevent="submitPosvendorDetails">

        <div class="tab-div">

            <div class="login-form">
                <label for="vendor">Pos Vendor</label>
                <select name="vendor" id="vendor" v-model="posVendor">
                    <option value="*">Generic</option>
                </select>
            </div>

            <div class="login-form">
                <label for="key">Customer Key</label>
                <input type="text" name="key" id="key" v-model="customerKey">
            </div>

        </div>

        <div class="modal-sub">
            <button type="button" class="discard" @click="resetPosvendorDetails">DISCARD</button>
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
        
            posVendor:'',
            customerKey:'',

        };
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

    
        
    }
};

</script>