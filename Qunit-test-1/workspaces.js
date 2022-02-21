/* Classname	- Layers Switcher
 * Version		- 0.3.1
 * Date			- 2021-12-21
 * Copyright	- Grzegorz Petri © 2021
 */
const lays = {
	meta: { author:'Petri Grzegorz', appName:'Layers Switcher', version: '0.3.1', desc:'Switches nodes-containers containing data to display' },
	conf: {
		btnBox: '#workspaceNav',
		canvBox: '#content',
		lyBtn: '[data-sohbtn="workspace"]',
		lyCnv: '[data-sohcanv="workspace"]'
	},
	actNo: 0,
createWrkspc: (srcBtn)=>{
	let btnBox = ( lays.conf.btnBox==null ) ? document : document.querySelector( lays.conf.btnBox );
	let btns = btnBox.querySelectorAll( lays.conf.lyBtn );
	let nextNo = btns.length;
		srcBtn.dataset.sohno = nextNo;
		srcBtn.textContent = nextNo;
	let newBtn = mkNode('a',{href:'#w',text:'+',dataset:{sohbtn:'workspace',sohgroup:'workspace',sohno:'new'}});
	let newWks = mkNode('section',{text:'Body #'+nextNo,dataset:{sohcanv:'workspace',sohgroup:'workspace',sohno:nextNo}});
		newBtn.addEventListener('click',lays.switchWrkspc,false);
		btnBox.appendChild(newBtn);
	let canvBox = ( lays.conf.canvBox==null ) ? document : document.querySelector( lays.conf.canvBox );
		canvBox.appendChild(newWks);
	return nextNo;
},
switchWrkspc: (e)=>{
	e.preventDefault();
	// find real button with data-attribs
	let btn = e.target.closest('[data-sohno]');
	// read what container ID to look for
	let mkActive = btn.dataset.sohno;
	if( mkActive=='new')
		mkActive = lays.createWrkspc(btn);
	let canvs = [];
	// find containers using Node or in whole Document
	let box = ( lays.conf.canvBox==null ) ? document : document.querySelector( lays.conf.canvBox );
	canvs = box.querySelectorAll( lays.conf.lyCnv );
	// deactivate CSS for previusly clicked Button
	let prevBtn = document.querySelector( lays.conf.lyBtn+'[data-sohno="'+lays.actNo+'"]');
	(prevBtn!==null) ? prevBtn.dataset.active=false : null;
	for(let i=0; i<canvs.length; i++)
	{	// iterate through all containers
		let cnv = canvs[i];
		if(cnv.dataset.sohno==mkActive){
			lays.actNo = cnv.dataset.sohno;
			btn.dataset.active = true;
			cnv.dataset.active = true;
		} else {
			cnv.dataset.active = false;
		}
	}
},
init: ()=>{
	let box = ( lays.conf.btnBox==null ) ? document : document.querySelector( lays.conf.btnBox );
	let btns = box.querySelectorAll( lays.conf.lyBtn );
	for(let i=0; i<btns.length; i++)
		btns[i].addEventListener('click',lays.switchWrkspc,false);
}
}

var actLayer = null;
var init = function(){
	var as = document.querySelector('aside');
	if(as!==null){
		var inp = as.querySelector('ul').querySelectorAll('input');
		for(var i=0; i<inp.length; i++){
			if(inp[i].name=='soh'){
				inp[i].addEventListener('change',soh2, false);
				inp[i].checked = false;
			}
			if(inp[i].name=='select'){
				inp[i].addEventListener('click',pick, false);
				inp[i].nextSibling.addEventListener('click',rename,false);
			}
		}
	}
	//document.getElementById('trashLayer').addEventListener('click',trash,false);
}
var rename = function(e){
	var self = e.target;
console.log(e.target.nodeName);
	if( self.nodeName=='SPAN' ){
	var inp = document.createElement('input');
		inp.addEventListener('focusout',rename,false);
		inp.id = 'editMe';
		inp.value = self.textContent;
		self.parentNode.appendChild(inp)
	} else {
		console.log('editMe');
		self.previousSibling.innerHTML = self.value;
		self.parentNode.removeChild(document.getElementById('editMe'));
	}
}
var trash = function(){// delete()
	var layer = document.getElementById(actLayer);
	var ul = layer.parentNode;
	ul.removeChild(layer);
	document.getElementById('workspace').removeChild(document.getElementById('e'+actLayer));
	actLayer = null;
}
//window.addEventListener('load',init,false);
window.addEventListener('load',lays.init,false);
