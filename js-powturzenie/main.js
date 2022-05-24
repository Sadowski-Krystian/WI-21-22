function hello(params) {
    console.log(params);
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