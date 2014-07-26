<?php $html="";if($page>$minpage){$html.="
				<a href=\"".(($page-1)==$minpage&&$url_default?$url_default:($urls[0].($page-1).$urls[1]))."\" class=\"pre\"><</a>
				";};$html.="
				";for($i=$pagestart;$i<=$pageend;$i++){if($i==1&&$url_default)$url=$url_default;else $url=$urls[0].$i.$urls[1];$html.="";if($i==$page){$html.="<a class=\"nov\" href=\"".$url."\">".$i."</a>";}else{$html.="<a href=\"".$url."\">".$i."</a>";};$html.="";}$html.="
				";if($page<$maxpage){$html.="
				<a href=\"".(($page+1)==$minpage&&$url_default?$url_default:($urls[0].($page+1).$urls[1]))."\" class=\"next\">></a>
				";};$html.="
				";?>