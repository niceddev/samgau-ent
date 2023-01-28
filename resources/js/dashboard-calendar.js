window.addEventListener("load", () => {

    let calendarMonths = document.getElementById('calendarMonths')

    calendarMonths.addEventListener('change', function ({input}){

        let date = new Date(calendarMonths.value);
        let daysInMonth = new Date(date.getFullYear(), date.getMonth()+1, 0).getDate();
        let calendarDays = document.querySelector('.calendar-days')
        calendarDays.innerHTML = ''

        for (let i = 1; i <= daysInMonth; i++) {
            const span = document.createElement("span");
            const node = document.createTextNode(i);
            span.appendChild(node);

            calendarDays.appendChild(span);
        }

    })

})
