<template>
    <div v-if="currentModalTab === 'tab-two'" class="tab-two">
        <div class="tab-content">
            <h3>Outlet Details</h3>

            <form class="modal-form" @submit.prevent="submitOutletDetails()">

                <div class="tab-div">
                    <div class="login-form">
                        <label for="email">Login Id</label>
                        <input type="email" name="email" id="email" v-model="outletForm.email">
                    </div>

                    <div class="login-form">
                        <label for="outlet">Outlet Name</label>

                        <div class="input-holder">
                            <input type="text" name="outlet" id="outlet" v-model="outletForm.outletName">

                            <div class="link">
                                <i class="bi bi-link cust-link-icon"></i>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-sub">
                    <button type="button" class="discard" @click="resetOutletForm()">DISCARD</button>
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

            outletForm: {
                email: '',
                outletName: ''
            },


        };
    },

    computed: {

    },

    props: {
        currentModalTab: String,
    },

    components: {

    },

    setup() {
    },

    mounted() {

    },

    methods: {

        submitOutletDetails() {
            console.log('Outlet Details:', this.outletForm);
            this.resetOutletForm();
        },

        resetOutletForm() {
            this.outletForm = {
                email: '',
                outletName: ''
            };
        },

    }
};



</script>