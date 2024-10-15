<template>

    <div v-if="currentModalTab === 'tab-nine'" class="tab-nine">
        <div class="tab-content">

            <h3>Campaigns / Auto Engagement</h3>

            <div class="modal-form">

                <div class="tab-div">

                    <div class="new-table">

                        <div class="tab-heading-container">

                            <span class="tab-heading" :class="{ active: selectedTab === 'auto' }"
                                @click="setActiveTab('auto')">Auto Engagement</span>

                            <span class="tab-heading" :class="{ active: selectedTab === 'instant' }"
                            @click="setActiveTab('instant')"
                            >Instant Gratification</span>

                        </div>

                        <div class="tab-table">

                            <table v-if="tableColumns.length">
                                <thead>
                                    <tr>
                                        <th v-for="(column, index) in tableColumns" :key="index">{{ column.label }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in tableData" :key="item.id">
                                        <td v-for="(column, index) in tableColumns" :key="index">
                                            {{ item[column.key] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div v-if="!tableColumns.length">
                                No data available for this tab.
                            </div>

                        </div>

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
                selectedTab: "auto",
                tableData: [],
                tableColumns: []
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
            this.setTableColumns();
            this.fetchTabData();     
        },

        methods: {  
            
            setActiveTab(tab) {
            this.selectedTab = tab;
            this.fetchTabData();
            this.setTableColumns();
        },

        setTableColumns() {
            const columnMapping = {
                auto: [
                    { label: 'Name', key: 'name' },
                    { label: 'Database ', key: 'database' },
                    { label: 'Segment Name', key: 'segmentName' },
                    { label: 'Gratification', key: 'gratification' },
                    { label: 'Communication', key: 'com' },
                    { label: 'Trigger Frequency', key: 'frequency' },
                    { label: 'Pause', key: 'pause' },


                ],
                instant: [
                    { label: 'Name', key: 'name' },
                    { label: 'Activity', key: 'active' },
                    { label: 'Gratification', key: 'ins_gratification' },
                    { label: 'Communication', key: 'ins_com' },
                    { label: 'Pause', key: 'pause' }
                ]
                
            };
            this.tableColumns = columnMapping[this.selectedTab] || [];
        },

        fetchTabData() {
            let apiUrl = '';
            switch (this.selectedTab) {
                case 'auto':
                    apiUrl = '/api/promos';
                    break;
                case 'instant':
                    apiUrl = 'https://670e306d073307b4ee45d062.mockapi.io/test/api/instant';
                    break;    
            }

            axios.get(apiUrl)
                .then(response => {
                    this.tableData = response.data;  // Store the data from the API
                    console.log(this.tableData);
                    
                })
                .catch(error => {
                    console.error("Error fetching data: ", error);
                });
        }
        }
    };

</script>