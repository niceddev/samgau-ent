window.addEventListener("load", () => {

    let checkedSubjectsCount = 3;
    const subjects = document.querySelectorAll('input[type=checkbox]')

    subjects.forEach(function (subject){

        subject.addEventListener('change', function (event){

            if (event.currentTarget.checked){
                const allSiblings = JSON.parse(event.currentTarget.dataset.siblings)

                checkedSubjectsCount++

                subjects.forEach(function (el){
                    console.log(event.currentTarget.dataset)
                    // if(el.value === event.currentTarget)
                })

                // const subjsToDisable = document.querySelectorAll('input[type=checkbox]:not([value=' + subject.value + '])')

                // if (checkedSubjectsCount >= 5){
                //     console.log('q')
                // }

                console.log(allSiblings)
            }else{

                checkedSubjectsCount--

                console.log('zxc')
            }

            console.log(checkedSubjectsCount)


            // allSiblings.forEach(function (id){
            //
            //     const sibling = document.querySelector(`[data-id="${id}"]`).querySelector('.img')
            //
            //     let arr = [];
            //     let checkboxes = document.querySelectorAll("input[type='checkbox']:checked");
            //     for (let i = 0; i < checkboxes.length; i++) {
            //         arr.push(checkboxes[i].value)
            //     }
            //     console.log(arr.length)
            //     subjects.forEach(function(el){
            //
            //         // el.querySelector('.img').style.filter = "grayscale(100%)"
            //         //
            //         // if (sibling.dataset.id === el.dataset.id){
            //         //     el.querySelector('.img').style.filter = "grayscale(0%)"
            //         // }
            //
            //     });
            //
            //     sibling.style.transition = 'all 0.2s ease-in'
            //
            // })

        })
    })

});
