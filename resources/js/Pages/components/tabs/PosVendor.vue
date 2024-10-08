<template>

    <div v-if="currentModalTab === 'tab-six'" class="tab-six">

        <div class="tab-content">

            <h3>Integrate with POS Vendor</h3>

            <form class="modal-form" @submit.prevent="submitPosvendorDetails()">

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
                    <button type="button" class="discard" @click="resetPosvendorDetails()">DISCARD</button>
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
        }
   
    }
};

</script>