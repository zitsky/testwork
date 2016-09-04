/**
 * Created by Jonic on 03.09.2016.
 */

window.Views.Helper=JSObject.extend({
    events:{
        "click .open-arrow":"onOpenArrowClick"
    },
    initialize:function(options)
    {
        this.helperItems=options.items;
        var template=$(_template("helper"));
        if(_.isUndefined(localStorage.getItem("helperopen")) || +localStorage.getItem("helperopen"))
            this.$el.addClass("show");
        this.$el.append(template);
        this.$ul=template.find("ul");
        this.renderItems();
    },
    renderItems:function()
    {
        this.$ul.html("");
        var prevGroup="";
        _.each(this.helperItems,_.bind(function(helperItem){
            if(helperItem.group!=prevGroup)
            {
                var group=new Views.HelperItem({model:{isgroup:true,name:helperItem.group}});
                this.$ul.append(group.el);
                prevGroup=helperItem.group;
            }
            var item=new Views.HelperItem({model:helperItem});
            this.$ul.append(item.el);
        },this));
    },
    onOpenArrowClick:function()
    {
        if(this.$el.hasClass("show"))
        {
            this.$el.removeClass("show");
            localStorage.setItem("helperopen",0);
        }else{
            this.$el.addClass("show");
            localStorage.setItem("helperopen",1);
        }
    }
});