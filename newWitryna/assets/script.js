const items = document.querySelector('main').querySelectorAll('article')
const obs = new IntersectionObserver((items) =>{
    items.forEach((item)=>{
        if(item.isIntersecting){
            let menuBtn = item.target.id
            soh.tgl(menuBtn)
        }
    })
},{
    threshold: 0.6,
})
items.forEach((item)=>{
    obs.observe(item)
})
const soh ={
    active: 'active',
    closest: 'a',
    node: 'a[href',
    tgl: (e)=>{
        let pnl = null
        if(typeof e!=='string'){
            pnl = e.target.closest(soh.closest)
        }else{
            pnl = document.querySelector(soh.node+'="#'+e+'"]')
        }
        let btns = document.querySelectorAll(soh.node+']');
        for(let i=0; i<btns.length;i++){
            btns[i].classList.remove(soh.active)
        }
        pnl.classList.add(soh.active)
    },
    init: ()=>{
        let btns = document.querySelectorAll(soh.node+']');
        for(let i=0; i<btns.length;i++){
            btns[i].addEventListener('click', soh.tgl,false)
        }
        console.log('soh');
    }
}
const mystyle ={
    changeTheme: ()=>{
        let link = document.getElementById('pagestyle')
        if(link.getAttribute('href')=="tablestyle_1.css"){
            link.setAttribute('href', 'tablestyle_2.css');
        }else{
            link.setAttribute('href', 'tablestyle_1.css');
        }
    }
}
window.addEventListener('load', soh.init,false)
document.getElementById('theme').addEventListener('click', mystyle.changeTheme,false)

