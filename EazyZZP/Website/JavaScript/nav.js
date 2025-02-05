// navigatie/scroll elementen om navbar te uitvouwen.
let navigatieBalk = document.querySelector(".navbar");
let laatsteScrollTop = 0;

// navbalk verbergen als je de pagina beneden scroolt
window.addEventListener("scroll", (e) => {
    let scrollTop = document.documentElement.scrollTop;

    if (scrollTop > laatsteScrollTop) {
        navigatieBalk.style.top = '-30vh';
        // als je pagina boven scroolt dan verschijnt de navbalk 
    } else {
        navigatieBalk.style.top = '0';
    }

    laatsteScrollTop = scrollTop;
    console.log('laatste:' + laatsteScrollTop);
    console.log('scrollTop' + scrollTop);
});
