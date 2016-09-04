Views.ParamsItem=JSObject.extend({
    tagName:'li',
    events:{
        "click button":"onRemove",
        "change .value":"onChange",
        "change .name":"onChange",
        "keyup .value":"onChange",
        "keyup .name":"onChange"
    },
    initialize:function(options)
    {
        this.model=options.model;
        this.opts=options;
        this.$el.html(_template("params-item"));
        this.$name=this.$el.find(".name");
        this.$value=this.$el.find(".value");
        this.$button=this.$el.find(".button");
        this.$name.val(this.model.key);
        this.$value.val(this.model.value);
    },
    onChange:function()
    {
        this.model.key=this.$name.val();
        this.model.value=this.$value.val();
        this.opts.buildParams();
    },
    onRemove:function()
    {
        this.opts.remove(this);
    }
});