<template>

<div v-if="currentModalTab === 'tab-ten'" class="tab-ten">
                        <div class="tab-content">

                            <h3>Membership Package</h3>

                            <div class="modal-form" @submit.prevent="submitPackageDetails">

                                <div class="tab-div">

                                    <div class="new-table">

                                        <table>

                                            <thead>
                                                <tr>
                                                    <th class="name">Name</th>
                                                    <th class="validity">Validity(days)</th>
                                                    <th class="issue">Total Issues</th>
                                                    <th class="days">Individual Issue Limit</th>
                                                    <th class="segment">Linked Segment</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>Alaska Premium Package</td>
                                                    <td>40</td>
                                                    <td>4/Unlimited</td>
                                                    <td>Unlimited</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="overflow-auto">

                                        <b-pagination
                                        v-model="currentPage"
                                        :total-rows="rows"
                                        :per-page="perPage"
                                        aria-controls="my-table"
                                        prev-text="Prev"    
                                        next-text="Next"    
                                        hide-goto-end-buttons  
                                        class="my-pagination"  
                                        ></b-pagination>

                                        <p class="mt-3">Current Page: {{ currentPage }}</p>

                                        <b-table
                                        id="my-table"
                                        :items="paginatedData"   
                                        :per-page="perPage"
                                        :current-page="currentPage"
                                        small
                                        >
                                        

                                        </b-table>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
</template>

<script>
export default {
        data() {
            return {
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
        }
    };
</script>