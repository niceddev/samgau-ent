window.addEventListener("load", () => {

    let checkedSubjectsCount = 3;
    const subjectLabels = document.querySelectorAll('.subject-label')

    subjectLabels.forEach(function (el){

        let subjectLabel = el.querySelector('.subject-item')

        subjectLabel.addEventListener('change', function ({currentTarget}){

                let siblingSubjectIds = JSON.parse(currentTarget.dataset.siblings)
                let notSiblingSubjectLabels = []

                subjectLabels.forEach(function (el){
                    if (!siblingSubjectIds.includes(Number(el.dataset.id))){
                        notSiblingSubjectLabels.push(el)
                    }
                })

                if (currentTarget.checked){

                    notSiblingSubjectLabels.forEach(function (el){
                        el.style.filter = 'grayscale(100%)'
                        el.style.transition = 'all 0.3s ease-out'
                        // el.querySelector('input').disabled = true
                    })

                    checkedSubjectsCount++
                }else{

                    notSiblingSubjectLabels.forEach(function (el){
                        el.style.filter = 'grayscale(0%)'
                        el.style.transition = 'all 0.3s ease-out'
                        // el.querySelector('input').disabled = false
                    })

                    checkedSubjectsCount--
                }

            })

    })

});
