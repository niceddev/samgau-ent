window.addEventListener("load", () => {

    let calendarMonths = document.getElementById('calendarMonths')

    calendarMonths.addEventListener('change', function ({input}){

        let date = new Date(calendarMonths.value);
        let daysInMonth = new Date(date.getFullYear(), date.getMonth()+1, 0).getDate();



    })

})
