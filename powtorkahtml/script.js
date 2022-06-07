let n = null
let snds = [
    '0.0','1.00000', '02','03','04','05','06','07','08','09'
]
let init = () =>{
    console.log("init");
    let c = document.getElementById('con')
    n =document.getElementById("numbers")
    let btns = c.querySelectorAll('button[data-snd]')
    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener('click', playSound);
    }
}

let playSound = (e)=>{
    let btn = e.target
    let no = btn.dataset.snd
    console.log(no);
    n.currentTime = snds[no-1]
}
window.addEventListener('load', init, false)