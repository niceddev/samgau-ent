window.addEventListener("load", () => {

    const subjects = document.querySelectorAll('.subjects')

    subjects.forEach(function (subject){

        subject.addEventListener('click', function (el){

            const allSiblings = JSON.parse(el.currentTarget.dataset.siblings)

            allSiblings.forEach(function (item){

                const sibling = document.querySelector(`[data-id="${item}"]`).querySelector('.img')

                if (sibling.style.filter == "grayscale(100%)") {
                    sibling.style.filter = "grayscale(0%)"
                } else {
                    sibling.style.filter = "grayscale(100%)"
                }

                sibling.style.transition = 'all 0.2s ease-in'


            })

        })
    })

});
