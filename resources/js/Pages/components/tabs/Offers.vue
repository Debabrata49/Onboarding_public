<template>

    <div v-if="currentModalTab === 'tab-eight'" class="tab-eight">
        <div class="tab-content">

            <h3>Offers / Promos</h3>

            <div class="modal-form">

                <div class="tab-div">

                    <div class="new-table">

                        <table>

                            <thead>
                                <tr>
                                    <th class="name">Promo name</th>
                                    <th class="validity">Promo Type</th>
                                    <th class="issue">Validity</th>
                                    
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>classsic promo_01</td>
                                    <td>Open</td>
                                    <td>2nd Jan 23 to 4th April 24</td>
                                    
                                </tr>
                                <tr>
                                    <td>classsic promo_01</td>
                                    <td>Open</td>
                                    <td>2nd Jan 23 to 4th April 24</td>
                                    
                                </tr>
                                <tr>
                                    <td>classsic promo_01</td>
                                    <td>Open</td>
                                    <td>2nd Jan 23 to 4th April 24</td>
                                    
                                </tr>
                                <tr>
                                    <td>classsic promo_01</td>
                                    <td>Open</td>
                                    <td>2nd Jan 23 to 4th April 24</td>
                                    
                                </tr>

                                
                            </tbody>

                        </table>

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