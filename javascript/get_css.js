/**
* 为当前整篇文档应用CSS文件样式
*
* @author  Sanders Yao
* @example JQuery.getCSS('CSSFilePath');
* @example JQuery.getCSS('CSSFilePath', function (css) {
*              //do something after all style applied
*          });
* @example JQuery.getCSS('CSSFilePath', {
*              beforeApp           : function (css) {
*                  //do something before all style apply
*              }
*              beforeSelectorApp   : function (selector, cssObject) {
*                  //do something before a style apply
*              }
*              afterSelectorApp    : function (selector, cssObject) {
*                  //do something after a style applied
*              }
*              afterApp            : function (css) {
*                  //do something after all style applied
*              }
*          });
*/
$.extend({
    getCSS  : function (url, option) {
        $.get(url, function (css) {
            var clip    = css.match(/[^{]+\{[^}]+?\}/g);
            if ('object' == typeof option && 'function' == typeof option.beforeApp) {
                if (false === option.beforeApp(css)) {
                    return  null;
                }
            }
            for(var i = 0;i < clip.length;i ++) {
                //删除注释
                var styleCode   = clip[i].replace(/\/\*(.|\s)*?\*\//g, '');
                //获取选择器
                var selector    = styleCode.replace(/^([^{]+)(.|\s)+$/g, "$1").replace(/(^[^;]*;\s*|^\s+|\s+$)/g, '');
                //获取样式定义
                var attrList    = styleCode.replace(/^[^{]+\{([^}]+)\}[^}]*$/g, "$1").split(';');
                var cssObject   = {};
                for (var j = 0;j < attrList.length;j ++) {
                    var attr    = attrList[j].split(':');
                    if (2 == attr.length) {
                        var tmpVarName  = attr[0].replace(/(^\s+|\s+$)/g, '');
                        var varName     = '';
                        for (var k = 0;k < tmpVarName.length;k ++) {
                            if ('-' == tmpVarName.charAt(k)) {
                                ++ k;
                                varName += tmpVarName.charAt(k).toUpperCase();
                            } else {
                                varName += tmpVarName.charAt(k);
                            }
                        }
                        cssObject[varName]  = attr[1].replace(/(^\s+|\s+$)/g, '');
                    }
                }
                if ('object' == typeof option && 'function' == typeof option.beforeSelectorApp) {
                    if (false === option.beforeSelectorApp(selector, cssObject)) {
                        continue;
                    }
                }
                $(selector).css(cssObject);
                if ('object' == typeof option && 'function' == typeof option.afterSelectorApp) {
                    option.afterSelectorApp(selector, cssObject);
                }
            }
            if ('function' == typeof option) {
                option(css);
            }
            if ('object' == typeof option && 'function' == typeof option.afterApp) {
                option.afterApp(css);
            }
        });
    }
});