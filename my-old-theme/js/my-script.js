
var prevScrollpos = window.pageYOffset;
window.onscroll = function () {

    var currentScrollPos = window.pageYOffset;
    if (window.innerWidth <= 425) {
        
        if (currentScrollPos >= 1000) {

            document.getElementById("my-nav-small").style.backgroundColor = "black";
            document.getElementById("my-nav-small").style.animationName = "none";
            document.querySelector(".slides-menu").style.backgroundColor = "black"

        } else {

            document.getElementById("my-nav-small").style.animationName = "transparent";
            document.getElementById("my-nav-small").style.backgroundColor = "transparent";
            document.querySelector(".slides-menu").style.backgroundColor = "transparent"



        }

        if (prevScrollpos > currentScrollPos) {
            document.getElementById("my-nav-small").style.top = "0";
        } else {
            let x = document.querySelector(".container");
            document.getElementById("my-nav-small").style.top = "-100px";
            x.classList.remove("change");
            document.querySelector(".slides-menu").style.right = "-100%";
        }
        prevScrollpos = currentScrollPos;
    } else {
        if (currentScrollPos >= 1000) {

            document.getElementById("my-nav").style.backgroundColor = "black";
            document.getElementById("my-nav").style.animationName = "none";

        } else {

            document.getElementById("my-nav").style.animationName = "transparent";
            document.getElementById("my-nav").style.backgroundColor = "transparent";



        }

        if (prevScrollpos > currentScrollPos) {
            document.getElementById("my-nav").style.top = "0";
        } else {
            document.getElementById("my-nav").style.top = "-100px";
        }
        prevScrollpos = currentScrollPos;
    }
    

}

var slideTextIndex = 0;
showTextSlides();

function showTextSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideTextIndex++;
    if (slideTextIndex > slides.length) { slideTextIndex = 1 }

    slides[slideTextIndex - 1].style.display = "block";

    setTimeout(showTextSlides, 7000);
}
/*
var slideBgIndex = 0;
showBgSlides();

function showBgSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides-bg");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideBgIndex++;
    if (slideBgIndex > slides.length) { slideBgIndex = 1 }

    slides[slideBgIndex - 1].style.display = "block";

    setTimeout(showBgSlides, 10000);
}
*/




var elements = document.querySelector(".slides-menu");
function menu(x) {

    x.classList.toggle("change");

    if (elements.style.right == "-100%") {
        elements.style.right = "0px";
    } else {
        elements.style.right = "-100%";
    }



}
