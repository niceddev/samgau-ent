window.addEventListener("load", () => {

    let checkedSubjectsCount = 3;
    const subjectLabels = document.querySelectorAll('.subject-label')

    subjectLabels.forEach(function (el){

        let subjectLabel = el.querySelector('.subject-item')
        let globalSiblingSubjectIds = []

        subjectLabel.addEventListener('change', function ({currentTarget}){

            let siblingSubjectIds = JSON.parse(currentTarget.dataset.siblings)
            let notSiblingSubjectLabels = []

            siblingSubjectIds.forEach(function (el){
                if (currentTarget.checked && !globalSiblingSubjectIds.includes(el)) {

                    globalSiblingSubjectIds.push(el)

                } else {

                    console.log('asd')

                }
            })

            subjectLabels.forEach(function (el){
                if (!siblingSubjectIds.includes(Number(el.dataset.id))){
                    notSiblingSubjectLabels.push(el)
                }
            })

            notSiblingSubjectLabels.forEach(function (el){
                if (currentTarget.checked) {

                    currentTarget.parentNode.style.filter = 'none'
                    currentTarget.disabled = false

                    el.style.filter = 'grayscale(100%)'
                    el.style.transition = 'all 0.3s ease-out'
                    el.querySelector('input').disabled = true

                } else {

                    el.style.filter = 'grayscale(0%)'
                    el.style.transition = 'all 0.3s ease-out'
                    el.querySelector('input').disabled = false

                }
            })

            checkedSubjectsCount = currentTarget.checked ? checkedSubjectsCount++ : checkedSubjectsCount--

        })

    })

});
