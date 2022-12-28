window.addEventListener("load", () => {

    let checkedSubjectsCount = 3;
    const subjectsLabels = document.querySelectorAll('.subject-label')

    subjectsLabels.forEach(function (subjectsLabel){

        subjectsLabel.querySelector('.subject-item')
            .addEventListener('change', function ({currentTarget}){

                if (currentTarget.checked){

                    currentTarget.parentElement.style.filter = 'grayscale(100%)';

                    console.log(subjectsLabels)

                    // JSON.parse(event.currentTarget.dataset.siblings)

                    checkedSubjectsCount++

                    console.log('asd')
                }else{

                    currentTarget.parentElement.style.filter = 'grayscale(0%)';

                    checkedSubjectsCount--

                    console.log('zxc')
                }


            })

    })

});
