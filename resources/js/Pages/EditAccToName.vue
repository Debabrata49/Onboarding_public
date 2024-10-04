<template>
   
</template>

<script>
import { ref } from "vue";
import axiosService from "@/axiosService";

export default {
    props: ['encodedId'],
    data() {
        return {
            id: null  // To store the decoded ID
        };
    },
    mounted() {
        // Decode the base64 encoded ID
        this.id = atob(this.encodedId);
        console.log("Decoded ID:", this.id);
        this.editEmployeeProfile(this.id);
        // Use the decoded ID to fetch data or perform other operations
        // Example: fetchAccountData(this.id);
    },
    methods:{
        editEmployeeProfile(id){
            let data = { employee_id: id };
            axiosService.post("/api/editEmployeeProfile", data)
            .then(res => {
                console.log(res.data.data);
                
            })
            .catch((err) => {
                console.log(err);
            })
        }
    }
};
</script>