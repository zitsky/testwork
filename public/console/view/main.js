/**
 * Created by Jonic on 03.09.2016.
 */
window.Views.Main=JSObject.extend({
    initialize:function()
    {
        this.$el.append(_template("layout"));

        this.helper=new Views.Helper({el:this.$el.find('.helper'),items:Methods});
        this.header=new Views.Header({el:this.$el.find(".header")});
        this.params=new Views.Params({el:this.$el.find(".params")});
        this.response=new Views.Response({el:this.$el.find(".response")});
        this.status=new Views.Status({el:this.$el.find(".statusbar")});
        this.apicaller=new APICaller();
        this.$el.find(".loading").fadeOut(500,function(){$(this).remove()});

    }
});