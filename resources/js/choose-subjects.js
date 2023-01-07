window.addEventListener("load", () => {

    let startTestBtn = document.querySelector('#subjectsForm button')
    let tempGlobalSiblingIds = []
    let globalSiblingIds = []
    let allLabels = document.querySelectorAll('.subject-label')

    allLabels.forEach(function (el){

        let input = el.querySelector('.subject-item')

        input.addEventListener('change', function ({currentTarget}){

            let notCheckedInputs = document.querySelectorAll('.subjects input[type=checkbox]:not(:checked)')
            let checkedInputs = document.querySelectorAll('.subjects input[type=checkbox]:checked')

            let siblingIds = JSON.parse(currentTarget.dataset.siblings)

            siblingIds.forEach(function (id){
                if (currentTarget.checked) {
                    tempGlobalSiblingIds.push(currentTarget.value + '.' + id)
                } else{
                    tempGlobalSiblingIds = tempGlobalSiblingIds.filter(item => item !== currentTarget.value + '.' + id);
                }
            })

            globalSiblingIds = tempGlobalSiblingIds.map(id => Number(id.split('.')[1]))

            allLabels.forEach(function (label){

                if (globalSiblingIds.includes(Number(label.dataset.id))){
                    // Active

                    label.style.backgroundColor = label.dataset.color
                    label.style.transition = 'all 0.3s ease-out'
                    label.querySelector('input').disabled = false

                } else {
                    // Disabled

                    if (label.dataset.id === currentTarget.parentNode.dataset.id) return

                    label.style.backgroundColor = '#bfbfbf'
                    label.style.transition = 'all 0.3s ease-out'
                    label.querySelector('input').disabled = true

                }

            })

            if(globalSiblingIds.length === 0){
                allLabels.forEach(function (label){
                    label.style.backgroundColor = label.dataset.color
                    label.style.transition = 'all 0.3s ease-out'
                    label.querySelector('input').disabled = false
                })
            }

            startTestBtn.disabled = true
            startTestBtn.style.filter = 'grayscale(100%)'

            if(checkedInputs.length >= 2){
                notCheckedInputs.forEach(function (el){
                    let label = el.parentNode

                    label.style.backgroundColor = '#bfbfbf'
                    label.style.transition = 'all 0.3s ease-out'
                    label.querySelector('input').disabled = true
                })

                startTestBtn.disabled = false
                startTestBtn.style.filter = 'grayscale(0)'
            }

            try {
                checkedInputs[0].parentNode.style.backgroundColor = checkedInputs[0].parentNode.dataset.color
                checkedInputs[0].parentNode.style.transition = 'all 0.3s ease-out'
                checkedInputs[0].disabled = false
            } catch(e){}

        })

    })

});
