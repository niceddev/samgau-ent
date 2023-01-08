window.addEventListener("load", () => {

    markAsComplete()

    multipleTabContent()

    navigationBetweenQuestions()

})

function markAsComplete(){

    let optionInputs = document.querySelectorAll('.options input')

    optionInputs.forEach(function (input){
        input.addEventListener('change', function ({currentTarget}){

            let questionTab = document.querySelectorAll(`button[aria-controls="${currentTarget.name}"]`)
            let questionOptions = document.querySelectorAll('#' + input.name + ' .options input')

            if (Array.prototype.some.call(questionOptions, checkbox => checkbox.checked)) {
                questionTab[0].style.backgroundColor = '#5beb7b'
                questionTab[0].style.boxShadow = 'none'
            } else {
                questionTab[0].style.backgroundColor = '#bac4cb'
                questionTab[0].style.boxShadow = '-0.1px -0.1px 9px 0.4px #33a94f inset'
            }

        })
    })

}

function navigationBetweenQuestions(){

    const nextBtn = document.querySelectorAll(".next-question > button");

    nextBtn.forEach(function(btn, index){
        btn.addEventListener('click', function(){
            let id = index + 1;
            let tabElement = document.querySelectorAll("#questionNumbersTab > div > button")[id];
            let lastTab = new bootstrap.Tab(tabElement);
            lastTab.show();
        });
    });

}

function multipleTabContent(){

    const tabEl = document.querySelectorAll('#subjectsTab button')

    tabEl.forEach(function (el){

        el.addEventListener('shown.bs.tab', event => {

            let curTarget = document.querySelector('.' + event.currentTarget.dataset.target)
            let activeQuestionTab = document.querySelector(event.currentTarget.dataset.bsTarget).querySelector('.active')
            let question = document.querySelector(activeQuestionTab.dataset.bsTarget)

            curTarget.classList.add("active", "show")

            curTarget.parentNode.querySelectorAll('div').forEach(function (el){

                if (el.dataset.content === event.currentTarget.dataset.target)
                    return

                el.classList.remove("active", "show")

            })

            question.classList.add("active", "show")

        })

    })

}
