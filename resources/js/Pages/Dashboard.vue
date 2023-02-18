<template>
    <Head>
        <meta type="description" content="Information about my app" head-key="description">
    </Head>
    <Layout>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-revenue-budget">
                    <div class="row mx-0">
                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center me-2">
                                    <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                                    <span>Earning</span>
                                </div>
                                <div class="d-flex align-items-center ms-75">
                                    <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                    <span>Expense</span>
                                </div>
                            </div>
                        </div>
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-revenue-budget">
                    <div class="row mx-0">
                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center me-2">
                                    <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                                    <span>Earning</span>
                                </div>
                                <div class="d-flex align-items-center ms-75">
                                    <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                    <span>Expense</span>
                                </div>
                            </div>
                        </div>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
        </div>

    </Layout>
</template>

<script setup>
import Layout from "../Shared/Layout.vue";
import {onMounted} from "vue";
import VueApexCharts from "vue-apexcharts";

const doWOrk = () =>{
}
const options = {
    chart: {
        type: 'line',
        toolbar: { show: false }
    },
    series: [{
        name: 'sales',
        data: [0,30,40,35,50,49,60,70,91,125,0,30,40,35,50,49,60,70,91,125]
    }],
    xaxis: {
        categories: [1900,1991,1992,1993,1994,1995,1996,1997, 1998,1999,1900,1991,1992,1993,1994,1995,1996,1997, 1998,1999]
    }
}




const revenueReportChartOptions = {
    chart: {
        height: 230,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
    },
    plotOptions: {
        bar: {
            columnWidth: '17%',
            endingShape: 'rounded'
        },
        distributed: true
    },
    colors: ['#fdd', "#fff333"],
    series: [
        {
            name: 'Earning',
            data: [95, 177, 284, 256, 105, 63, 168, 218, 72]
        },
        {
            name: 'Expense',
            data: [-145, -80, -60, -180, -100, -60, -85, -75, -100]
        }
    ],
    dataLabels: {
        enabled: false
    },
    legend: {
        show: false
    },
    grid: {
        padding: {
            top: -20,
            bottom: -10
        },
        yaxis: {
            lines: { show: false }
        }
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        labels: {
            style: {
                colors: "white",
                fontSize: '0.86rem'
            }
        },
        axisTicks: {
            show: false
        },
        axisBorder: {
            show: false
        }
    },
    yaxis: {
        labels: {
            style: {
                colors: "white",
                fontSize: '0.86rem'
            }
        }
    }
};




onMounted(() => {
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    const revenueReportChart = new ApexCharts(document.querySelector("#chart2"), revenueReportChartOptions);
    revenueReportChart.render();

})


</script>
