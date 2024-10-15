<template>

    <div v-if="currentModalTab === 'tab-five'" class="tab-five">
        <div class="tab-content">
            <h3>Set communication channels</h3>

            <form class="modal-form" @submit.prevent="submitCommunicationDetails()">

                <div class="tab-div">

                    <div class="login-form">
                        <label for="sms">SMS</label>
                        <select name="sms" id="sms" v-model="selectedSms">
                            <option value="*">Gupshup</option>
                        </select>
                    </div>

                    <div class="login-form">
                        <label for="whatsApp">WhatsApp</label>
                        <select name="whatsApp" id="whatsApp" v-model="selectedWhatsApp">
                            <option value="*">SMS Gateway Hub</option>
                        </select>

                    </div>

                    <div class="login-form">
                        <label for="route">Email</label>
                        <select name="route" id="route" v-model="selectedEmail">
                            <option value="*">Route Mobile</option>
                        </select>
                    </div>
                </div>

                <div class="modal-sub">
                    <button type="button" class="discard" @click="resetCommunicationDetails()">DISCARD</button>
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
            selectedSms: '*',
            selectedWhatsApp: '*',
            selectedEmail: '*',
        
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

    }
};

</script>