window.addEventListener("load", () => {

    let seconds = 0
    let timer = document.getElementById('timer')
    setInterval(function () {

        timer.value = seconds++

    }, 1000)

    markAsComplete()

    multipleTabContent()

    navigationBetweenQuestions()

})

function markAsComplete(){

    let optionInputs = document.querySelectorAll('.options input')

    optionInputs.forEach(function (input){
        input.addEventListener('change', function ({currentTarget}){

            // after choice any option colorize questionTab(circle) to green
            let questionTab = document.querySelectorAll(`button[aria-controls="${currentTarget.dataset.question}"]`)
            let questionOptions = document.querySelectorAll('#' + input.dataset.question + ' .options input')

            if (Array.prototype.some.call(questionOptions, checkbox => checkbox.checked)) {
                questionTab[0].classList.add('question-complete-tab')
            } else {
                questionTab[0].classList.remove('question-complete-tab')
            }

            // count answered questions and change innerHtml of span(above 'next' button)
            let completedTabs = questionTab[0].parentNode.parentNode.parentNode.querySelectorAll('.question-complete-tab')
            let answeredQuestionsSpans = document.querySelectorAll('.control-section-' + questionTab[0].parentNode.parentNode.parentNode.id.replace('nav-subject-', '') + ' .answered-questions-count')

            answeredQuestionsSpans.forEach(function (span){
                span.innerHTML = completedTabs.length
            })

            // show Finish button after all questions complete
            let answeredQuestionsButtons = document.querySelectorAll('.answered-questions-button')

            if(document.querySelectorAll('.question-complete-tab').length === answeredQuestionsButtons.length){
                answeredQuestionsButtons.forEach(function (button){
                    button.style.backgroundColor = '#EDB021'
                    button.style.height = '70px'
                    button.innerHTML = 'Готово'
                    button.setAttribute('type', 'submit');
                })
            } else {
                answeredQuestionsButtons.forEach(function (button){
                    button.style.backgroundColor = '#2695e0'
                    button.innerHTML = 'Следующий вопрос'
                    button.setAttribute('type', 'button');
                })
            }

        })
    })

}

function navigationBetweenQuestions(){

    const nextBtn = document.querySelectorAll(".next-question > button");
    console.log(nextBtn)
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
