const soh = {
	node: '[data-toggle="sect-menu"]',
tgl: (e)=>{
	console.log('Klik');
	let pnl = e.target.closest('.panel');
	pnl.classList.toggle('hide');
	//console.log(pnl);
},
init: ()=>{
	let btns = document.querySelectorAll( soh.node );
	for(let i=0; i<btns.length; i++){
		btns[i].addEventListener('click',soh.tgl,false);
	}
}

}
window.addEventListener('load',soh.init,false);
