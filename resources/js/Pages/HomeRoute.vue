<template>
    <div>
        <h1>HOME</h1>
        <router-link to="/test"> Take me to Test page </router-link>
        <button @click.prevent="triggerEndpoint">Trigger Endpoint</button>
        <p v-if="response">{{ response.data }}</p>
    </div>
</template>
<script>
    import axios from "axios";
    import { ref } from "vue";
    import axiosService from '@/axiosService';

    export default {
        setup() {
            const response = ref(null);
            
            const triggerEndpoint = async () => {
                console.log(localStorage.getItem('access_token'));
                try {
                    let data = {
                        'page_number' : 1
                    };
                    const result = await axiosService.post("/api/getEmployeeData",data);
                    response.value = result.data;
                    console.log(response);                   
                } catch (error) {
                    console.error(error);
                }
            };

            return {
            response,
            triggerEndpoint,
            };
        },
    };
</script>
