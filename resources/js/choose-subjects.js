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

            globalSiblingIds = tempGlobalSiblingIds.map(id => Number(id.split('.')[1]))

            allLabels.forEach(function (label){

                if (!globalSiblingIds.includes(Number(label.dataset.id))){

                    if (label.dataset.id === currentTarget.parentNode.dataset.id) return

                    label.style.backgroundColor = '#bfbfbf'
                    label.style.transition = 'all 0.3s ease-out'
                    label.querySelector('input').disabled = true


                    // if (currentTarget.checked) {
                    //
                    //     currentTarget.parentNode.style.backgroundColor = currentTarget.disabled = false
                    //
                    //     if (label.dataset.id === currentTarget.parentNode.dataset.id) return
                    //
                    //     label.style.backgroundColor = '#bfbfbf'
                    //     label.style.transition = 'all 0.3s ease-out'
                    //     label.querySelector('input').disabled = true
                    //
                    // } else {
                    //
                    //     label.style.backgroundColor = label.dataset.color
                    //     label.style.transition = 'all 0.3s ease-out'
                    //     label.querySelector('input').disabled = false
                    //
                    // }

                } else {

                    if (label.dataset.id === currentTarget.parentNode.dataset.id) return

                    label.style.backgroundColor = label.dataset.color
                    label.style.transition = 'all 0.3s ease-out'
                    label.querySelector('input').disabled = false

                }

                if (label.querySelector('input').checked) {
                    label.style.backgroundColor = label.dataset.color
                    label.querySelector('input').disabled = false
                }

            })

            console.log(globalSiblingIds)

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
