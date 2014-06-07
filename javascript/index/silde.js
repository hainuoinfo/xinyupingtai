var slideMenu=function(){
	var sp,st,t,m,sa,l,w,sw,ot;
	return{
		build:function(sm,sw,mt,s,sl,h){
			sp=s; st=sw; t=mt;
			m=document.getElementById(sm);
            console.log('slidermenu   sm='+sm+' sw='+sw+' s='+s+' sl='+sl+' h='+h);
			sa=m.getElementsByTagName('li');
			l=sa.length; w=m.offsetWidth; sw=w/l;
			ot=Math.floor((w-st)/(l-1)); var i=0;
			for(i;i<l;i++){s=sa[i]; s.style.width=sw+'px'; this.timer(s)}
			if(sl!=null){m.timer=setInterval(function(){slideMenu.slide(sa[sl-1])},t)}
		},
		timer:function(s){s.onmouseover=function(){clearInterval(m.timer);m.timer=setInterval(function(){slideMenu.slide(s)},t)}},
		slide:function(s){
			var cw=parseInt(s.style.width,'10');
			if(cw<st){
				var owt=0; var i=0;
				for(i;i<l;i++){
					if(sa[i]!=s){
						var o,ow; var oi=0; o=sa[i]; ow=parseInt(o.style.width,'10');
						if(ow>ot){oi=Math.floor((ow-ot)/sp); oi=(oi>0)?oi:1; o.style.width=(ow-oi)+'px'}
						owt=owt+(ow-oi)}}
				s.style.width=(w-owt)+'px';
			}else{clearInterval(m.timer)}
		}
	};
}();
var slideFlag = 1;
function slideAuto() {
    var t = 1;
    var doSlide = function() {
        if (slideFlag == 0) {
            t = 1;
            return ;
        }
        t++;
        if (t > 4)
            t = 1;
        document.getElementById('sw_' + t).onmouseover();
    };
    window.setInterval(doSlide, 3000);
}
function isAuto(flag) {
    slideFlag = flag;
}
//addEvent(window, "load", function(){slideMenu.build('switch',406,4,10,1);slideAuto();});