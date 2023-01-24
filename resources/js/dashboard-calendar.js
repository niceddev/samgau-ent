window.addEventListener("load", () => {

    const nextBtn = document.querySelectorAll(".next-month > button");
    const prevBtn = document.querySelectorAll(".prev-month > button");

    nextBtn.forEach(function(btn, index){
        btn.addEventListener('click', function(){
            let id = index + 1;
            let tabElement = document.querySelectorAll("#questionNumbersTab > div > button")[id];
            let lastTab = new bootstrap.Tab(tabElement);
            lastTab.show();
        });
    });

    prevBtn.forEach(function(btn, index){
        btn.addEventListener('click', function(){
            let id = index + 1;
            let tabElement = document.querySelectorAll("#questionNumbersTab > div > button")[id];
            let lastTab = new bootstrap.Tab(tabElement);
            lastTab.show();
        });
    });

})
