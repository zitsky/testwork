window.Views.Header=JSObject.extend({
    currentModel:null,
    urlParts:[],
    urlInputs:[],
    endUrl:'',
    events:{
        "click button":"onExecuteClick"
    },
    initialize:function()
    {
        this.$el.html(_template("header"));
        this.$url=this.$el.find(".urlbox");
        this.$method=this.$el.find(".method");
        this.renderUrl();
        Events.Global.on("show-method",_.bind(this.onSelectMethod,this));
    },
    renderUrl:function()
    {
        if(!this.currentMethod)
        {
            this.$url.html("Выберете метод из списка").addClass("gray");
            return;
        }
        this.$url.html("");
        this.urlInputs=[];
        _.each(this.urlParts,_.bind(function(part){
            if(part=='')
                return;
            if(part.replace(/[^{}]+/,'')=='{}')
            {
                this.$url.append($("<span/>").text("/"));
                var inputPart=$("<input />").attr("data-part",part).attr("placeholder",part);
                inputPart.css("width",this.calcWidth(part)+"px");
                inputPart.on("keydown keyup",_.bind(function(){
                    inputPart.css("width",this.calcWidth(inputPart.val().length?inputPart.val():part)+"px");
                    this.partChange();
                },this));
                this.urlInputs.push(inputPart);
                this.$url.append(inputPart);
            }else{
                this.$url.append($("<span/>").text("/"+part));
            }
        },this));
    },
    onSelectMethod:function(method)
    {
        if(this.currentMethod)
            this.$method.removeClass(this.currentMethod.method);
        this.currentMethod=method;
        this.$method.addClass(this.currentMethod.method);

        this.$method.text(method.method);
        this.urlParts=this.currentMethod.url.split("/");
        Events.Global.fire("change-url",this.currentMethod.url);
        Events.Global.fire("change-method",this.currentMethod.method);
        this.renderUrl();
    },
    partChange:function()
    {
        var beginUrl=this.currentMethod.url;
        _.each(this.urlInputs,function(part){
            beginUrl=beginUrl.split($(part).attr("data-part")).join($(part).val());
        });
        this.endUrl=beginUrl;
        Events.Global.fire("change-url",this.endUrl);
    },
    calcWidth:function(text)
    {
        var tt=$('.invisible-input-tester');
        tt.text(text);
        var w=tt.width();
        return w+20;
    },
    onExecuteClick:function()
    {
        Events.Global.fire("api-execute");
    }
});