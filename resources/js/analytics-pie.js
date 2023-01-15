window.addEventListener("load", () => {

    const ctx = document.getElementById('anayticsPie')
    const backgroundColors = ['#f33c3c', '#A0B5C2', '#ffd823', '#0090ec', '#ccc'];

    const testScores = [
        30,
        90,
        40,
        145,
        25
    ]

    new Chart(ctx, {
        type: 'pie',
        plugins: [ChartDataLabels],
        data: {
            labels: '',
            datasets: [{
                label: '',
                data: testScores,
                borderWidth: 0,
                backgroundColor: backgroundColors,
            }]
        },
        options: {
            hover: {mode: null},
            plugins: {
                datalabels: {
                    font: (context) => {
                        let width = context.chart.width;
                        let size = Math.round(width/10);

                        return {
                            size: size,
                            weight: 'bold',
                        };
                    },
                    color: '#fff'
                },
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: false,
                }
            }
        }
    })

})
