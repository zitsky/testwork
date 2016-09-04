window.Views.HelperItem=JSObject.extend({
    tagName:'li',
    events:{
        "click":"onClick"
    },
    initialize:function(options)
    {
        this.model=options.model;
        this.$el.html(_template("helper-item"));
        if(!_.isUndefined(this.model.isgroup))
        {
            this.$el.html(this.model.name);
            this.$el.addClass("group");
        }else {
            this.$el.find("span").text(this.model.url);
            this.$el.find("a").attr("href","/docs/index.html#"+this.model.hash);
            this.$el.addClass(this.model.method);
        }
    },
    onClick:function(e)
    {
        if(e.target.tagName=='A')
            return;
        Events.Global.fire("show-method",this.model);
    }
});