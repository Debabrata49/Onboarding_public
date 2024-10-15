<template>
    <div v-if="currentModalTab === 'tab-three'" class="tab-three">
        <div class="tab-content">
            <h3>Loyalty Set - Up</h3>

            <form class="modal-form" @submit.prevent="submitLoyaltyDetails()">

                <div class="tab-div">

                    <div class="login-form">
                        <label for="flat">Flat</label>
                        <input type="text" name="flat" id="flat" v-model="loyaltyForm.flat">
                    </div>

                    <div class="login-form">
                        <label for="loyalty">Advanced Loyalty</label>
                        <input type="text" name="text" id="loyalty" v-model="loyaltyForm.loyalty">
                    </div>

                </div>

                <div class="modal-sub">
                    <button type="button" class="discard" @click="resetLoyaltyForm()">DISCARD</button>
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

            loyaltyForm: {
                flat: '',
                loyalty: ''
            },

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
        submitLoyaltyDetails() {
            console.log('Login Form Data:', this.loyaltyForm);
            this.loyaltyForm = { flat: '', loyalty: '' };
        },

        resetLoyaltyForm() {
            this.loyaltyForm = {
                flat: '',
                loyalty: ''
            };
        },

    }
};
</script>