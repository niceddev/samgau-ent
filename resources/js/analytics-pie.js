window.addEventListener("load", () => {

    const ctx = document.getElementById('anayticsPie')
    const backgroundColors = ['#fff', '#A0B5C2'];

    const testScores = [
        30,
        90,
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
                        let size = Math.round(width/5);

                        return {
                            size: size,
                            weight: 'bold',
                        };
                    },
                    color: '#c2d1dc',
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
