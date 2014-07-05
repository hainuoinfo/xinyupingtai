CKEDITOR.plugins.add('map_51',　{
　　　　requires:　['dialog'],
　　　　init:function(a){
　　　　　　　　var　b　=　a.addCommand('map_51',　new　CKEDITOR.dialogCommand('map_51'));
　　　　　　　　a.ui.addButton('map_51',　{
　　　　　　　　　　　　label:　'插入地图',
　　　　　　　　　　　　command:　'map_51',
　　　　　　　　　　　　icon:　this.path　+　'map.gif'
　　　　　　　　});
　　　　　　　　CKEDITOR.dialog.add('map_51',　this.path　+　'map.js');
　　　　}
});