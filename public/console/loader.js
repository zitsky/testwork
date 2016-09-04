(function(){
    //injection scripts, and wait for loading
    var scripts=[
        'jquery.js',
        'underscore.js',
        'jsformat.js',
        'events.js',
        'JSObject.js',
        'APICaller.js',
        'methods.js',
        'view/header.js',
        'view/help.js',
        'view/help-item.js',
        'view/params.js',
        'view/params-item.js',
        'view/response.js',
        'view/status.js',
        'view/main.js',
        'app.js'
    ];
    
    //make globals
    window.Views={};
    window.Events={};
    window._template=function(tempalte)
    {
        return $("#"+tempalte).text();
    };
    //callback hunt events of script complete load and injected in page

    
    var _loadScript=function(baseLink,callback) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.onload = function(){callback(callback)};
        script.src = '/console/'+baseLink;
        document.getElementsByTagName('head')[0].appendChild(script);
    };

    var _scriptIterator=function(iterator)
    {
        if(!scripts.length)
        {
            return appMain();
        }
        var current=scripts.slice(0,1).join("");
        scripts=scripts.slice(1);
        _loadScript(current,iterator);
    };

    _scriptIterator(_scriptIterator);

})();