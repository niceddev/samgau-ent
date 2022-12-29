window.addEventListener("load", () => {

    let startTestBtn = document.querySelector('#subjectsForm button')
    let tempGlobalSiblingIds = []
    let globalSiblingIds = []
    let allLabels = document.querySelectorAll('.subject-label')

    allLabels.forEach(function (el){

        let label = el.querySelector('.subject-item')

        label.addEventListener('change', function ({currentTarget}){

            let notCheckedLabels = document.querySelectorAll('.subjects input[type=checkbox]:not(:checked)')
            let checkedLabels = document.querySelectorAll('.subjects input[type=checkbox]:checked')

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

                    currentTarget.parentNode.style.backgroundColor =
                    currentTarget.disabled = false

                    if (el.dataset.id === currentTarget.parentNode.dataset.id) return

                    el.style.backgroundColor = '#bfbfbf'
                    el.style.transition = 'all 0.3s ease-out'
                    el.querySelector('input').disabled = true

                } else {

                    el.style.backgroundColor = el.dataset.color
                    el.style.transition = 'all 0.3s ease-out'
                    el.querySelector('input').disabled = false

                }
            })

            console.log(notSiblingLabels)
            console.log(siblingIds)

            if (checkedLabels.length !== 2){
                startTestBtn.disabled = true
                startTestBtn.style.filter = 'grayscale(100%)'

                notCheckedLabels.forEach(input => input.disabled = false)
            } else {
                startTestBtn.disabled = false
                startTestBtn.style.filter = 'grayscale(0%)'

                notCheckedLabels.forEach(input => input.disabled = true)
            }

        })

    })

});
