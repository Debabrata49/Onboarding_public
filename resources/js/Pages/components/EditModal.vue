<template>
    <div v-if="modalEdit" class="modal-overlay" @click.self="closeModalName">
        <div class="modalEdit">
            <div class="name-upper">
                <h4>Edit Sub Account Details</h4>
                <i class="bi bi-x-circle-fill" @click="closeModalName"></i>
            </div>
            <div class="edit-form">
                <form class="form-edit" @submit.prevent="validateForm">


                    <div class="input-fields">
                        <div class="edit-input">

                            <div>
                                <label for="name">Name <i class="bi bi-asterisk"></i></label>
                                <input type="text" name="emp_name" v-model="emp_arr.emp_name" id="name" required>
                                <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="mobile">Mobile</label>
                                <input type="text" name="emp_mobile" v-model="emp_arr.emp_mobile" id="mobile">
                            </div>

                        </div>

                        <template v-if="emp_loyalty_percentage_chk == 1">
                            <div class="edit-input">

                                <div>
                                    <label for="loyaltypercent">Loyalty Program %</label>
                                    <input type="text" name="loyalty_percentage"
                                        v-model="emp_arr.emp_loyalty_percentage" id="loyaltypercent">
                                </div>

                            </div>
                        </template>

                        <div class="edit-input">

                            <div>
                                <label for="email">Email ID <i class="bi bi-asterisk"></i></label>
                                <input type="email" name="emp_email" v-model="emp_arr.emp_email" id="email" required>
                                <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="pwd">Password <i class="bi bi-asterisk"></i></label>
                                <input type="password" name="password" v-model="emp_arr.emp_password" id="pwd" required>
                                <span v-if="errors.password" class="error-message">{{ errors.password }}</span>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="pwd_2">Confirm Password<i class="bi bi-asterisk"></i></label>
                                <input type="password" name="confirm_password" v-model="emp_arr.emp_confirm_password"
                                    id="pwd_2" required>
                                <span v-if="errors.confirmPassword" class="error-message">{{ errors.confirmPassword }}</span>

                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="bs">Business Name <i class="bi bi-asterisk"></i></label>
                                <input type="text" name="business_name" v-model="emp_arr.emp_business_name" id="bs"
                                    required>
                                <span v-if="errors.businessName" class="error-message">{{ errors.businessName }}</span>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="loc">Business Location</label>
                                <input type="text" name="business_location" v-model="emp_arr.emp_business_location"
                                    id="loc">
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="cat">Category</label>
                                <input type="text" name="emp_category" v-model="emp_arr.emp_category" id="cat">
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="country">Country</label>
                                <select name="country" id="country" v-model="form.selectedCountry">
                                    <option>Please Select</option>
                                    <option v-for="country in emp_arr.emp_country" :key="country.value"
                                        :value="country.value">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="region">Region</label>
                                <select name="region" id="region"  v-model="selectedRegion">
                                    <option>Please Select</option>
                                    <option v-for="region in emp_arr.emp_region" :key="region.value"
                                        :value="region.value" :selected="region.select">
                                        {{ region.name }}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="multiple-fields-container">

                            <div class="subfield-item">
                                <label for="asm_name">ASM Details</label>
                                <input type="text" name="asm_name" id="asm_name" v-model="emp_arr.asm_data.asm_name">
                            </div>

                            <div class="multiple-item">
                                <input type="email" name="asm_email" id="asm_email"
                                    v-model="emp_arr.asm_data.asm_email">
                            </div>

                            <div class="multiple-item">
                                <vue-tel-input v-model="emp_arr.asm_data.asm_number" mode="international"
                                    :default-country="iso_code" id="code"></vue-tel-input>
                            </div>

                        </div>
                        <div class="multiple-fields-container">

                            <div class="subfield-item">
                                <label for="det">Manager Details</label>
                                <input type="text" name="det" id="det" v-model="emp_arr.manager_data.manager_name">
                            </div>

                            <div class="multiple-item">
                                <input type="email" name="mail" id="mail" v-model="emp_arr.manager_data.manager_email">
                            </div>

                            <div class="multiple-item">
                                <vue-tel-input v-model="emp_arr.manager_data.manager_number" mode="international"
                                    :default-country="iso_code" id="code"></vue-tel-input>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="curency">Currency</label>
                                <select name="curency" id="curency" v-model="selectedCurency">
                                    <option>Please Select</option>
                                    <option v-for="curency in emp_arr.emp_currency" :key="curency.value"
                                        :value="curency.value" :selected="curency.select">
                                        {{ curency.name }}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="timeZone">Time zone</label>
                                <select name="timeZone" id="timeZone" v-model="selectedTimeZone">
                                    <option>Please Select</option>
                                    <option v-for="timeZone in emp_arr.emp_timezone" :key="timeZone.value"
                                        :value="timeZone.value" :selected="timeZone.select">
                                        {{ timeZone.name }}
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="edit-input">
                            <div>
                                <label for="note">Note</label>
                                <textarea name="note" id="note"
                                    placeholder="Enter Note here">{{ emp_arr.emp_note }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="submit">
                        <div class="btn-container">
                            <button class="discard">DISCARD</button>
                            <button class="save" type="submit">SAVE</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>

import { reactive,ref } from "vue";
import axiosService from "@/axiosService";

export default {
    data() {
        return {
            errors: {},
            selectedCountry: null,
            selectedRegion: null,
            selectedCurency: null,
            selectedTimeZone: null,
        };
    },

    props: {
        modalEdit: Boolean,
        closeModalName: Function,
        emp_arr: Object
    },

    computed: {
        
    },

    components: {

    },

    setup() {
        const form = reactive({
            
        });
        return {
            form
        };
    },

    mounted() {
        const preselectedCountry = this.emp_arr.emp_country.find(country => country.select);
        if (preselectedCountry) {
            this.form.selectedCountry = preselectedCountry.value;
        }
    },

    methods: {
        validateForm() {
            this.errors = {};

            // Validate Name
            if (!this.emp_arr.emp_name) {
                this.errors.name = 'Name is required';
            }

            // Validate Email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!this.emp_arr.emp_email) {
                this.errors.email = 'Email is required';
            } else if (!emailPattern.test(this.emp_arr.emp_email)) {
                this.errors.email = 'Invalid email format';
            }

            // Validate Password
            if (!this.emp_arr.emp_password) {
                this.errors.password = 'Password is required';
            } else if (this.emp_arr.emp_password.length < 6) {
                this.errors.password = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (!this.emp_arr.emp_confirm_password) {
                this.errors.confirmPassword = 'Confirm Password is required';
            } else if (this.emp_arr.emp_password !== this.emp_arr.emp_confirm_password) {
                this.errors.confirmPassword = 'Passwords do not match';
            }

            // Validate Business Name
            if (!this.emp_arr.emp_business_name) {
                this.errors.businessName = 'Business Name is required';
            }

            // If no errors, proceed with form submission (e.g., call an API)
            if (Object.keys(this.errors).length === 0) {
                this.saveProfile(); 
                alert(this.selectedCountry);
            }
        },
        async saveProfile() {
            try {
                const payload = {
                    employee_id: this.emp_arr.emp_id,
                    emp_name: this.emp_arr.emp_name,
                    emp_mobile: this.emp_arr.emp_mobile,
                    emp_email: this.emp_arr.emp_email,
                    emp_password: this.emp_arr.emp_password,
                    emp_confirm_password: this.emp_arr.emp_confirm_password,
                    emp_business_name: this.emp_arr.emp_business_name,
                    emp_business_location: this.emp_arr.emp_business_location,
                    emp_category: this.emp_arr.emp_category,
                    emp_loyalty_percentage: this.emp_arr.emp_loyalty_percentage,
                    emp_maxallow_award_trans: this.emp_arr.emp_maxallow_award_trans,
                    emp_loyalty_percentage_chk: this.emp_arr.emp_loyalty_percentage_chk,
                    emp_note: this.emp_arr.emp_note,
                    asm_name: this.emp_arr.asm_data.asm_name,
                    asm_email: this.emp_arr.asm_data.asm_email,
                    asm_number: this.emp_arr.asm_data.asm_number,
                    asm_country_code: this.emp_arr.asm_data.asm_country_code,
                    manager_name: this.emp_arr.manager_data.manager_name,
                    manager_email: this.emp_arr.manager_data.manager_email,
                    manager_number: this.emp_arr.manager_data.manager_number,
                    manager_country_code: this.emp_arr.manager_data.manager_country_code,
                    emp_country: this.selectedCountry, // Send only the selected country
                    emp_region: this.selectedRegion,
                    emp_curency: this.selectedCurency,
                    emp_timezone: this.selectedTimeZone,
                };

                axiosService.post("/api/updateEmployeeMain", payload)
                .then(res => {
                    if (response.status === 200) {
                        console.log('Profile updated successfully:', res.data);

                        // Close the modal after successful save
                        this.closeModalName();
                    }
                })
                .catch((err) => {
                    console.log(err);
                }).finally(() => {
                    
                });
            }catch (error){

            }
        }
    }
};
</script>