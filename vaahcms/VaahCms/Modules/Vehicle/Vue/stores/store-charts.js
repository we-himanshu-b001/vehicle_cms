
import {acceptHMRUpdate, defineStore} from 'pinia';
import {vaah} from '../vaahvue/pinia/vaah';

let base_url = document.getElementsByTagName('base')[0].getAttribute("href");
let ajax_url = base_url + "/vehicle/chart";

export const useYourStore = defineStore('store', {
    state: () => ({
        chartOptions: {},
        chartSeries: [],
        base_url: base_url,
        ajax_url: ajax_url,
    }),

    actions: {
        async fetchCustomersCountData() {
            const options = {
                method: 'get',
            };
            await vaah().ajax(
                this.ajax_url + '/charts/data',
                this.fetchCustomersCountDataAfter,
                options
            );
        },
        //---------------------------------------------------
        fetchCustomersCountDataAfter(data,res){
            if (!data || !Array.isArray(data.chart_series)) {
                return;
            }
            const seriesData = data.chart_series.map(series => ({
                name: series.name ,
                data: Array.isArray(series.data) ? series.data : [],
            }));
            this.updateChartSeries(seriesData);
            const updatedOptions = {
                ...res.data.chart_options, // Merge existing options
                title: {
                    ...res.data.chart_options.title, // Retain existing title settings if they exist
                    // If you want to add or modify sections like title,yaxis, grid, etc., you can do it here
                    text: 'Your Desired Title', // Set the new title
                    // You can also add other title properties if needed
                },
            };
            this.updateChartOptions(updatedOptions);

        },
        //---------------------------------------------------
        updateChartOptions(newOptions) {
            this.chartOptions = newOptions;
        },
        //---------------------------------------------------
        updateChartSeries(newSeries) {
            // Ensure chartSeries is updated reactively
            this.chartSeries = [...newSeries]; // Shallow copy to trigger reactivity
        },
        //---------------------------------------------------
    },
});


// Pinia hot reload
if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useYourStore, import.meta.hot))
}

