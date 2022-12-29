window.addEventListener("load", () => {

    let startTestBtn = document.querySelector('#subjectsForm button')
    let checkedCount = 3;
    let tempGlobalSiblingIds = []
    let globalSiblingIds = []
    let allLabels = document.querySelectorAll('.subject-label')

    allLabels.forEach(function (el){

        let label = el.querySelector('.subject-item')

        label.addEventListener('change', function ({currentTarget}){

            // let notChecked
            let siblingIds = JSON.parse(currentTarget.dataset.siblings)

            siblingIds.forEach(function (id){
                if (currentTarget.checked) {
                    tempGlobalSiblingIds.push(currentTarget.value + '.' + id)
                } else{
                    tempGlobalSiblingIds = tempGlobalSiblingIds.filter(item => item !== currentTarget.value + '.' + id);
                }
            })

            let notSiblingLabels = []

            globalSiblingIds = tempGlobalSiblingIds.map(id => Number(id.split('.')[1]))

            allLabels.forEach(function (el){
                if (!globalSiblingIds.includes(Number(el.dataset.id))){
                    notSiblingLabels.push(el)
                }
            })

            notSiblingLabels.forEach(function (el){
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

            if (currentTarget.checked) {
                checkedCount++
            } else {
                checkedCount--
            }

            if (checkedCount < 5){
                startTestBtn.disabled = true
                startTestBtn.style.filter = 'grayscale(100%)'

                // disable rest of active subj that not checked
            } else {
                startTestBtn.disabled = false
                startTestBtn.style.filter = 'grayscale(0%)'
            }

        })

    })

});
