function hello(params) {
    console.log(params);
    let n = document.getElementsByTagName('nav')[0]
    let a = n.querySelectorAll('[data-target]')
    console.log(a);
    for (let i = 0; i < a.length; i++) {
        a[i].addEventListener('click', toggleSect, false)
        
    }
}
let toggleSect = (e)=>{
    let btn = e.target.closest('a')
    let trgt = btn.dataset.target
    console.log(btn);
    let box = document.getElementById('view')
    let sect = box.querySelectorAll('[data-sect]')
    for (let i = 0; i < sect.length; i++) {
        if(sect[i].dataset.sect == trgt){
            sect[i].classList.add('doDsp')
        }else{
            sect[i].classList.remove('doDsp')
        }
    }
}
let hello2 = function hello2(params) {
    console.log(params);
}
let hello3 = (imie) =>{
    console.log(imie);
}

let Obj ={
    hello4: (imie) =>{
        console.log(imie);
    },
    init: ()=>{
        hello('andrzej')
        hello2('duda')
        hello3('grzegorz')
        Obj.hello4('krzysztof')
    }
}
window.addEventListener('load', Obj.init)