<template>

    <div v-if="currentModalTab === 'tab-nine'" class="tab-nine">
        <div class="tab-content">

            <h3>Campaigns / Auto Engagement</h3>

            <div class="modal-form">

                <div class="tab-div">

                    <div class="new-table">

                        <table>

                            <thead>
                                <tr>
                                    <th class="name">Name</th>
                                    <th class="validity">Database</th>
                                    <th class="days">Segment Name</th>
                                    <th class="issue">Gratification</th>
                                    <th class="segment">Communication</th>
                                    <th class="issue">Trigger Frequency</th>
                                    <th class="segment">Pause</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>High_end_campaign_74</td>
                                    <td>Full Database</td>
                                    <td></td>
                                    <td></td>
                                    <td>View Details</td>
                                    <td>Daily</td>
                                    <td></td>
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