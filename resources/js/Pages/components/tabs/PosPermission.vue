<template>

    <div v-if="currentModalTab === 'tab-seven'" class="tab-seven">
        <div class="tab-content">

            <h3>Manage POS level permissions</h3>

            <form class="modal-form" @submit.prevent="submitPospermissionDetails()">

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
                    <button type="button" class="discard" @click="resetPermission()">DISCARD</button>
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
        
            couponredemptionPoint:false,
            discountedbillPoint:false,
            discounteditemPoint:false,
            taxPoint:false,
            creditsPermission:false,

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
        
    }
};

</script>