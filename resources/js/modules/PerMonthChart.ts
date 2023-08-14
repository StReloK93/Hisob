const Highcharts = require('highcharts')
export function mainChartInit(id, documents, title){
    return Highcharts.chart(id, {
        accessibility: {
            enabled: false 
        },
        chart: {type: 'line'},
        title: {text: title},
        xAxis: {
            categories: ['Yan', 'Fev', 'Mart', 'Aprel', 'May', 'Iyun', 'Iyul', 'Avg', 'Sen', 'Okt', 'Noy', 'Dek']
        },
        legend: {enabled: true},
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: documents
    });
}