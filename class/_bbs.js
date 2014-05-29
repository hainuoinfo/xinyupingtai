{
	plugins:{
        Upload:{c:'uploadIco',t:'上传图片(Ctrl+U)',s:'ctrl+u',e:function(){
            var _this=this;
            _this.showIframeModal('上传图片','{rewrite}/dialog/upload/',function(rs){
				_this.loadBookmark();
					if (rs.id) {
						var attach={'type':rs.type,'src':rs.src};
						attachList[rs.id] = attach;
						switch(attach.type){
							case 'img':
								_this.pasteHTML('<img src="'+attach.src+'" attach="'+rs.id+'" />');
							break;
							default:
								_this.pasteHTML('<a href="'+attach.src+'" attach="'+rs.id+'">下载附件</a>');
							break;
						}
					}
				},500,150);
        	}
		}
	},
	tools:'Cut,Copy,Paste,Pastetext,Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,SelectAll,Removeformat,Align,List,Outdent,Indent,Link,Unlink,Img,Upload,Flash,Media,Emot,Table,Source,Preview,Print,Fullscreen',
	emotPath:'{$weburl2}img/e/',
	emotMark:true,
	emots:{qq:{name:'QQ',count:77,width:24,height:24,line:11,index:-1}},
	defEmot:'qq',
	hideDefEmot:true,
	beforeSetSource:ubb2html,
	beforeGetSource:html2ubb,
	upImgUrl:'{$weburl2}ajax/upload.php?action=image',
	upImgExt:'jpg,jpeg,gif,png'
}