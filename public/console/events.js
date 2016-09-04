window.Events=function()
{
    this.events={};
    return this;
};

_.extend(window.Events.prototype,{
    on:function(event,callback)
    {
        if(_.isUndefined(this.events[event]))
            this.events[event]=[];
        this.events[event].push(callback);
    },
    fire:function(event)
    {
        var args=Array.prototype.slice.call(arguments,1);
        console.log("fire:",event,args);
        _.each(this.events[event],function(f){
            f.apply(f,args);
        });
    }
});

window.Events.Global=new Events();