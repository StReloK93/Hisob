const Highcharts = require('highcharts')

// Create the chart
export function organizationChart(id, data, title){
    return Highcharts.chart(id, {
        accessibility: {
            enabled: false
        },
        chart: {type: 'pie'},
        title: {text: title},    
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}:  {point.y}'
                },
                showInLegend: true,
                cursor: 'pointer',
                allowPointSelect: true,

            },
        },
        series: [{
            name: "Bo'linmalar",
            colorByPoint: true,
            data: data
        }],
    });
}