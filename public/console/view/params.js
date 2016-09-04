Views.Params=JSObject.extend({
    method:null,
    events:{
        "click button.append":"addParam",
        "click button.clear":"clearParams"
    },
    params:[],
    initialize:function()
    {
        this.event=new Events();
        this.$el.html(_template("params"));
        this.$list=this.$el.find(".list");
        this.$head=this.$el.find(".head");
        Events.Global.on("show-method",_.bind(this.setMethod,this));
        this.removeItemBinded=_.bind(this.removeItem,this);
        this.buildParamsBinded=_.bind(this.buildParams,this);
        this.renderParams();
    },
    setMethod:function(method)
    {
        this.method=method;
        this.params=[];
        _.each(this.method.params,_.bind(function(param){
            this.params.push({key:param,value:''});
        },this));
        this.renderParams();
    },
    renderParams:function()
    {
        if(!_.keys(this.params).length)
        {
            this.$list.html("<h2>Нет парамтеров</h2>");
            this.$head.hide();
            return;
        }

        this.$head.show();
        this.$list.html("");
        _.each(this.params,_.bind(function(param){
            var item=new Views.ParamsItem({model:param,event:this.event,remove:this.removeItemBinded,buildParams:this.buildParamsBinded});
            this.$list.append(item.el);
        },this));
    },
    buildParams:function()
    {
        var objectParams={};
        _.each(this.params,function(param){
            objectParams[param.key]=param.value;
        });
        Events.Global.fire("change-params",objectParams);
    },
    removeItem:function(item)
    {
        var indx=this.params.indexOf(item.model);
        this.params=[].concat(this.params.slice(0,indx),this.params.slice(indx+1));
        this.renderParams();
    },
    clearParams:function()
    {
        this.params=[];
        this.renderParams();
    },
    addParam:function()
    {
        this.params.push({key:'',value:''});
        this.renderParams();
    }
});