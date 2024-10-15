<template>
    <div v-if="currentModalTab === 'tab-one'" class="tab-one">
        <div class="tab-content">
            <h3>Login Details</h3>

            <form class="modal-form" @submit.prevent="submitLoginForm()">

                <div class="tab-div">
                    <div class="login-form">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" v-model="loginForm.name">
                    </div>

                    <div class="login-form">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" disabled v-model="loginForm.email">
                    </div>

                    <div class="login-form">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" v-model="loginForm.address">
                    </div>

                    <div class="login-form">
                        <label for="business">Business</label>
                        <input type="text" name="business" id="business"
                            v-model="loginForm.business">
                    </div>
                </div>

                <div class="modal-sub">
                    <button type="button" class="discard" @click="resetLoginForm()">DISCARD</button>
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
                
                loginForm: {
                    name: '',
                    email: 'user@example.com', // Default email, since it's disabled.
                    address: '',
                    business: ''
                }

            };
        },

        computed: {
        
        },

        props:{
            currentModalTab: String,
        },

        components: {
            
        },

        setup() {
        

        },

        mounted() {
        },

        methods: {

            submitLoginForm() {
                console.log('Login Form Data:', this.loginForm);
                this.loginForm = { name: '', email: '', address: '', business: '' };
            },

            resetLoginForm() {
                this.loginForm = {
                    name: '',
                    email: 'user@example.com', 
                    address: '',
                    business: ''
                };
            },

            
        }
    };

</script>