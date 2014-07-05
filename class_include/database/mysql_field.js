$(function(){
	$('#field_type').change(function(){
		var index=$(this).attr('selectedIndex');
		$('#byte_title').html($('#byte_title'+index).html());
		if($('#byte_title').html()){
			$('#byte_title_tr').show();
		} else {
			$('#byte_title_tr').hide();
		}
		if($(this).val()){
			var matches=[];
			if(matches=$(this).val().match(/^([a-z]+)\((.+?)\)$/i)){
				var sp=matches[2].split(',');
				if(sp.length==1){
					$('#field_other').html(sp[0]+'：<input type="text" id="field_'+sp[0]+'" />');
					$('#field_'+sp[0]).keyup(function(){
						var name=$(this).attr('id').replace(/^field_/,'');
						$('#field_info').val($('#field_type').val().replace(new RegExp('^([a-z]+)\\(.*?'+name+'.*?\\)$','i'),'$1('+$(this).val()+')'));							  
					});
				} else if(sp.length==2){
					$('#field_other').html(sp[0]+'：<input type="text" id="field_'+sp[0]+'" /><br />'+sp[1]+'：<input type="text" id="field_'+sp[1]+'" />');
					$('#field_'+sp[0]).keyup(function(){
						var matches=[];
						matches=$('#field_type').val().match(/^([a-z]+)\((.+?)\)$/i);
						var sp=matches[2].split(',');
						var name=$(this).attr('id').replace(/^field_/,'');
						$('#field_info').val($('#field_type').val().replace(new RegExp('^([a-z]+\\()'+sp.join(',')+'(\\))$','i'),'$1'+$('#field_'+sp[0]).val()+','+$('#field_'+sp[1]).val()+'$2'));							  
					});
					$('#field_'+sp[1]).keyup(function(){
						var matches=[];
						matches=$('#field_type').val().match(/^([a-z]+)\((.+?)\)$/i);
						var sp=matches[2].split(',');
						var name=$(this).attr('id').replace(/^field_/,'');
						$('#field_info').val($('#field_type').val().replace(new RegExp('^([a-z]+\\()'+sp.join(',')+'(\\))$','i'),'$1'+$('#field_'+sp[0]).val()+','+$('#field_'+sp[1]).val()+'$2'));							  
					});
				} else {
					$('#field_other').html('<textarea id="field_emnu" rows="3" cols="32"></textarea>一行一个值');
					$('#field_emnu').keyup(function(){
						$('#field_info').val($('#field_type').val().replace(new RegExp('^([a-z]+)\\(.+?\\)$','i'),'$1(\''+$(this).val().split("\n").join('\',\'').replace(",''",'')+'\')'));
					});
				}
				$('#field_other_tr').show();
			} else {
				$('#field_other').html('');
				$('#field_other_tr').hide();
				$('#field_info').val($(this).val());
			}
		} else {
			$('#field_other').html('');
			$('#field_other_tr').hide();
		}
	});
});