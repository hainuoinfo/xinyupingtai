CKEDITOR.dialog.add('map_51',　function(editor){
		var map_x=0,map_y=0,map_z=0;
		var js_list=['http://api.51ditu.com/js/maps.js','http://api.51ditu.com/js/search.js','http://api.51ditu.com/js/ezmarker.js'];
		var toid=function(id){return document.getElementById(id);};
		var load_js=function(list,index){
			if(index==void(0))index=0;
			if(index<list.length){
				CKEDITOR.scriptLoader.load(list[index].src,function(){
					
				});
			}
		};
　　　　var escape=function(value){
　　　　	return value;
　　　　};
　　　　return {
　　　　　　　　title:'插入地图',
　　　　　　　　resizable:　CKEDITOR.DIALOG_RESIZE_BOTH,
　　　　　　　　minWidth:　620,
　　　　　　　　minHeight:　380,
　　　　　　　　contents:　[{
　　　　　　　　　　　　id:　'cb',
　　　　　　　　　　　　name:　'cb',
　　　　　　　　　　　　label:　'cb',
　　　　　　　　　　　　title:　'cb',
　　　　　　　　　　　　elements:　[
							{
　　　　　　　　　　　　　　　　type:'html',
　　　　　　　　　　　　　　　	html:'<div style="width:620px;height:380px;"><iframe src="/map_select.htm?editor='+editor.name+'" scrolling="no" frameborder="0" width="600" height="350" style="width:620px;height:380px;"></iframe></div>'
　　　　　　　　　　　　	}
						]
　　　　　　　　}],
　　　　　　　　onOk:function(){
　　　　　　　　	//var html=''+escape('123');
　　　　　　　　　　//editor.insertHtml(html);
　　　　　　　　},
　　　　　　　　onLoad:　function(){
					//由于51地图的JS需要即使输出，有点特殊，所以就只有在加载的时候就一并加载了！-_-!
					/*CKEDITOR.scriptLoader.load(js_list,function(u,v){
						alert(v.length+'|'+u.length);
						alert(LTPoint);
						var ezmarker = new LTEZMarker("pos",1,toid('map_box'));
					});*/
					//var ezmarker = new LTEZMarker("pos",1,toid('map_box'));
　　　　　　　　}
　　　　};
});