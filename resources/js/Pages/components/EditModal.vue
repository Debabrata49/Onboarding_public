<template>
    <div v-if="modalEdit" class="modal-overlay" @click.self="closeModalName">
        <div class="modalEdit">
            <div class="name-upper">
                <h4>Edit Sub Account Details</h4>
                <i class="bi bi-x-circle-fill" @click="closeModalName"></i>
            </div>
            <div class="edit-form">
                <form class="form-edit" @submit.prevent="edit">


                    <div class="input-fields">
                        <div class="edit-input">

                            <div>
                                <label for="name">Name <i class="bi bi-asterisk"></i></label>
                                <input type="text" name="emp_name" v-model="emp_arr.emp_name" id="name" required>
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
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="pwd">Password <i class="bi bi-asterisk"></i></label>
                                <input type="password" name="password" v-model="emp_arr.emp_password" id="pwd" required>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="pwd_2">Confirm Password<i class="bi bi-asterisk"></i></label>
                                <input type="password" name="confirm_password" v-model="emp_arr.emp_confirm_password"
                                    id="pwd_2" required>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="bs">Business Name <i class="bi bi-asterisk"></i></label>
                                <input type="text" name="business_name" v-model="emp_arr.emp_business_name" id="bs"
                                    required>
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
                                <select name="country" id="country">
                                    <option>Please Select</option>
                                    <option v-for="country in emp_arr.emp_country" :key="country.value"
                                        :value="country.value" :selected="country.select">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="edit-input">

                            <div>
                                <label for="region">Region</label>
                                <select name="region" id="region">
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
                                <select name="curency" id="curency">
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
                                <select name="timeZone" id="timeZone">
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
export default {
    data() {
        return {
            emp_arr: {
                emp_name: '',
                emp_email: '',
                emp_mobile: '',
                emp_password: '',
                emp_confirm_password: '',
                emp_business_name: '',
                emp_business_location: '',
                emp_category: '',
                emp_loyalty_percentage: '',
                emp_maxallow_award_trans: '',
                emp_loyalty_percentage_chk: 0,
                emp_note: '',
                asm_data: [],
                manager_data: [],
                emp_country: [],
                emp_currency: [],
                emp_timezone: [],
                emp_region: [],
            },
        };
    },

    props: {
        modalEdit: Boolean,
        closeModalName: Function,
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