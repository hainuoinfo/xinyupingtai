YundunNameSpace = typeof(YundunNameSpace) == "undefined" ? {}: YundunNameSpace;
YundunNameSpace.Fuckie = function() {
    this.ie = (function() {
        var undef, v = 3,
        div = document.createElement('div'),
        all = div.getElementsByTagName('i');
        while (div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->', all[0]);
        return v > 4 ? v: undef
    } ());
    this.urlParameters = (function(script) {
        var i = script.length - 1;
        me = !!document.querySelector ? script[i].src: script[i].getAttribute('src', 4);
        return me.split('?')[1]
    })(document.getElementsByTagName('script'))
};
YundunNameSpace.Fuckie.prototype = {
    getCookie: function(name) {
        var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
        if (arr != null) {
            return (arr[2])
        } else {
            return ""
        }
    },
    setCookie: function(name, value, Days) {
        var exp = new Date();
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString()
    },
    getParam: function(name) {
        var reg = new RegExp("(^|\\?|&)" + name + "=([^&]*)(\\s|&|$)", "i");
        return (reg.test(this.urlParameters)) ? encodeURIComponent(decodeURIComponent(RegExp.$2.replace(/\+/g, " "))) : ''
    },
    init: function() {
        var maxVersion = this.getParam('version');
        if (this.ie === undefined || this.ie >= maxVersion) {
            return true
        }
        if ((new YundunNameSpace.Fuckie).getCookie('cfapp_abetterbrowser') === '1') {
            return true
        }
        var moreInformationLink = 'http://browsehappy.com',
        translations = {
            'en': 'You are using an outdated browser. <a href="' + moreInformationLink + '" target="_blank">More information &#187;</a>',
            'zh': '&#24744;&#30340;&#27983;&#35272;&#22120;&#29256;&#26412;&#36807;&#26087;&#12290;&#32;<a href="' + moreInformationLink + '" target="_blank">&#26356;&#22810;&#20449;&#24687; &#187;</a>'
        },
        rules = '#yundun-old-browser {background:#45484d;position:absolute;z-index:100000;width:100%;height:26px;top:0;left:0;overflow:hidden;padding:0px 0;font:18px/26px Arial,sans-serif;text-align:center;color:#FFF}#yundun-old-browser a {text-decoration:underline;color:#EBEBF4}#yundun-old-browser a:hover, #yundun-old-browser a:active {text-decoration:none;color:#DBDBEB}#yundun-old-browser-close {background:#393b40;display:block;width:42px;height:42px;position:absolute;text-decoration:none !important;cursor:pointer;top:0;right:0;font-size:30px;line-height:28px}#yundun-old-browser-close:hover {background:#E04343;color:#FFF}',
        style = document.createElement('style');
        style.id = 'yundun-abetterbrowser';
        style.setAttribute('type', 'text/css');
        if (style.styleSheet) {
            style.styleSheet.cssText = rules
        } else {
            style.appendChild(document.createTextNode(rules))
        }
        var head = document.getElementsByTagName('head')[0];
        var firstChild = head.firstChild;
        head.insertBefore(style, firstChild);
        var language = window.navigator.browserLanguage || window.navigator.userLanguage || 'en',
        translation = translations[language.substring(0, 2)] || translations.en;
        var message = document.createElement('div');
        message.id = 'yundun-old-browser';
        message.innerHTML = translation;
        var closeButton = document.createElement('a');
        closeButton.id = 'yundun-old-browser-close';
        closeButton.innerHTML = '&times;';
        message.appendChild(closeButton);
        closeButton.onclick = function() {
            document.body.removeChild(message);
            document.body.className = document.body.className.replace(new RegExp('(\\s|^)yundun-old-browser-body(\\s|$)'), ''); (new YundunNameSpace.Fuckie).setCookie('cfapp_abetterbrowser', 1, 7);
            return false
        };
        document.body.appendChild(message);
        document.body.className += ' yundun-old-browser-body'
    }
}; (new YundunNameSpace.Fuckie).init();