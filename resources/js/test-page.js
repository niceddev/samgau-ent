window.addEventListener("load", () => {

    // multipleTabContent()


    // const nextBtn = document.querySelectorAll(".btnNext");
    // const prevBtn = document.querySelectorAll(".btnPrev");
    //
    // nextBtn.forEach(function(item, index){
    //     item.addEventListener('click', function(){
    //         let id = index + 1;
    //         let tabElement = document.querySelectorAll("#myTabContent a")[id];
    //         var lastTab = new bootstrap.Tab(tabElement);
    //         lastTab.show();
    //     });
    // });
    //
    // prevBtn.forEach(function(item, index){
    //     item.addEventListener('click', function(){
    //         let id = index;
    //         let tabElement = document.querySelectorAll("#myTabContent a")[id];
    //         var lastTab = new bootstrap.Tab(tabElement);
    //         lastTab.show();
    //     });
    // });


})

function multipleTabContent(){

    const tabEl = document.querySelectorAll('button[data-bs-toggle="tab"]')

    tabEl.forEach(function (el){

        el.addEventListener('shown.bs.tab', event => {

            let curTarget = document.querySelector('.' + event.currentTarget.dataset.target)

            curTarget.classList.add("active", "show")
            curTarget.parentNode.querySelectorAll('div').forEach(function (el){

                if (el.dataset.content === event.currentTarget.dataset.target)
                    return

                el.classList.remove("active", "show")

            })

        })

    })

}
