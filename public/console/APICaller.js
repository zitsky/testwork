
window.APICaller=function(){
    this.init();
    return this;
};

_.extend(window.APICaller.prototype,{
    params:{},
    method:'get',
    url:'',
    init:function()
    {
        Events.Global.on("change-url",_.bind(this.setUrl,this));
        Events.Global.on("change-params",_.bind(this.setParams,this));
        Events.Global.on("change-method",_.bind(this.setMethod,this));
        Events.Global.on("api-execute",_.bind(this.execute,this));
    },
    setUrl:function(url){
        this.url=url;
    },
    setParams:function(params)
    {
        this.params=params;
    },
    setMethod:function(method)
    {
        this.method=method;
    },
    execute:function()
    {
        //build request and execute.
        $.ajax(this.url,{
            type:this.method.toUpperCase(),
            data:this.params,
            dataType:'json',
            beforeSend:function(xhr){
                console.log("before",xhr);
            },
            complete:function(xhr){
                console.log("complete apicall",xhr);
                Events.Global.fire("response-complete",xhr);
            }
        });
    }
});