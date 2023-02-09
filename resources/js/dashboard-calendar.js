window.addEventListener("load", () => {

    let calendarMonths = document.getElementById("calendarMonths")
    let currentDate = new URLSearchParams(window.location.search).get("date")
    if (currentDate === null){
        calendarMonths.value = "2023-01"
    } else {
        calendarMonths.value = currentDate.slice(0,7)
    }

    const subjectId = new URLSearchParams(window.location.search).get('subject-id')

    let date = new Date(calendarMonths.value)
    let daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate()
    let calendarDays = document.querySelector(".calendar-days")
    calendarDays.innerHTML = ""

    let days = Array.from({length: daysInMonth}, (_, i) => i + 1);
    let weeks = [];

    while (days.length) {
        weeks.push(days.splice(0, 7));
    }

    weeks.map(function (week){
        const rowDiv = document.createElement("div")
        rowDiv.classList.add("row")

        week.map(function (day){
            const span = document.createElement("span")
            span.classList.add("col", "text-center", "p-0")
            span.style.maxWidth = "50px"

            const link = document.createElement("a")
            link.href = "detailed?subject-id=" + subjectId + "&date=" + calendarMonths.value + "-" + (day < 10 ? "0" + day : day)

            link.innerHTML = day
            span.appendChild(link)

            rowDiv.appendChild(span)
        })

        calendarDays.appendChild(rowDiv)
    })

    calendarMonths.addEventListener("change", function ({input}){
        let date = new Date(calendarMonths.value)
        let daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate()
        let calendarDays = document.querySelector(".calendar-days")
        calendarDays.innerHTML = ""

        let days = Array.from({length: daysInMonth}, (_, i) => i + 1);
        let weeks = [];

        while (days.length) {
            weeks.push(days.splice(0, 7));
        }

        weeks.map(function (week){
            const rowDiv = document.createElement("div")
            rowDiv.classList.add("row")

            week.map(function (day){
                const span = document.createElement("span")
                span.classList.add("col", "text-center", "p-0")
                span.style.maxWidth = "50px"

                const link = document.createElement("a")
                link.href = "detailed?subject-id=" + subjectId + "&date=" + calendarMonths.value + "-" + (day < 10 ? "0" + day : day)
                link.innerHTML = day
                span.appendChild(link)

                rowDiv.appendChild(span)
            })

            calendarDays.appendChild(rowDiv)
        })

    })

})
