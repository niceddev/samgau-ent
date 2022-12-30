window.addEventListener("load", () => {

    let subjects = [].slice.call(document.querySelectorAll('#test-finish li'))
    let correctAnswersCount = subjects.map(el => Number(el.dataset.correct_answers_count)).reduce((a, b) => a + b, 0)
    let questionsCount = subjects.map(el => Number(el.dataset.questions_count)).reduce((a, b) => a + b, 0)

    const ctx = document.getElementById('resultsDoughnut')

    const percentageText = {
        id: 'percentageText',
        afterDatasetsDraw(chart){
            const { ctx, chartArea: { top, width, height } } = chart

            ctx.save()

            ctx.font = 'bolder 80px Arial'
            ctx.fillStyle = 'rgba(0,0,0,1)'
            ctx.textAlign = 'center'
            ctx.fillText(Math.ceil((100 * correctAnswersCount) / questionsCount) + '%', width/2, height/2 + top)
            ctx.restore()

            ctx.font = 'bolder 30px Arial'
            ctx.fillStyle = 'rgba(0,0,0,1)'
            ctx.textAlign = 'center'
            ctx.fillText('(' + correctAnswersCount + '/' + questionsCount + ')', width/2, height/1.5)
            ctx.restore()

        }
    }

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Red', 'Blue'],
            datasets: [{
                label: '',
                data: [4, 140],
                backgroundColor: [
                    'rgb(0,202,44)',
                    'rgb(255,167,167)',
                ],
            }]
        },
        plugins: [percentageText],
        options: {
            cutout: 95,
            plugins: {
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
