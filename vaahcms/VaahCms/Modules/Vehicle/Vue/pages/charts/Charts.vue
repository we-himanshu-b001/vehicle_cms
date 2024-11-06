
<template>
<!--    {{store.chartSeries}}-->
    <div v-if="store.chartOptions.xaxis && store.chartOptions.xaxis.categories">
        <CustomersCountBarChart
            type="line" title='Customer Line Chart' titleAlign='center' height=400 width=600
            :chartOptions="{ xaxis:{categories: store.chartOptions.xaxis.categories }}"
            :chartSeries="store.chartSeries"
        />
<!--        <CustomersCountBarChart-->
<!--            type="line" title='Simple Line Chart' titleAlign='center' height=400 width=600-->
<!--            :chartOptions="{ xaxis:{categories: store.chartOptions.xaxis.categories }}"-->
<!--            :chartSeries="[{ name: 'Customers', data: [30, 40, 45, 50, 49, 60, 70,80,85,60,70,100] },-->
<!--            { name: 'Active Customers', data: [10, 20, 15, 30, 35, 40, 45,50,55,60,65,70] }]"-->
<!--        />-->
    </div>

</template>

<script setup>
import {useYourStore} from '../../stores/store-charts'; // Adjust the path as needed
import {onMounted} from 'vue';
import CustomersCountBarChart from "../charts/CustomersCountBarChart.vue";
const store = useYourStore(); // Use the store
// Fetch data when the component mounts
onMounted(() => {
    document.title = 'Chart - Vehicle';
    store.fetchCustomersCountData(); // Calls the method to fetch data
});
</script>

