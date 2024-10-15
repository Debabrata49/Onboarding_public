<template>

    <div v-if="modalPassword" class="modal-overlay" @click.self="closeModal">

        <div class="modal-password">
            <form class="password-form" @submit.prevent="sent">
                <div class="password-content">

                    <div class="password-upper">
                        <h4>Create New Password</h4>
                        <i class="bi bi-x-circle-fill" @click="closeModal"></i>
                    </div>

                    <div class="input-container">
                        <div class="password-input">
                            <label for="pwd">Current Password</label>
                            <input type="password" name="pwd" class="pwd" placeholder="Enter Current Password">
                        </div>
                        <div class="password-input">
                            <label for="pwd">New Password</label>
                            <input type="password" name="pwd" class="pwd" placeholder="Enter New Password">
                        </div>
                        <div class="password-input">
                            <label for="pwd">Confirm Password</label>
                            <input type="password" name="pwd" class="pwd" placeholder="Re-Enter New Password">
                        </div>
                    </div>

                    <div class="sub-btn">
                        <button type="submit">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</template>

<script>

export default {
    data() {
        return {
           
        };
    },

    props:{
        modalPassword: Boolean,
        closeModal: Function,
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
    }
};
</script>