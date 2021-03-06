Views.Status=JSObject.extend({
    initialize:function()
    {
        this.$el.html(_template("status"));
        Events.Global.on("response-complete",_.bind(this.handleResponse,this));
    },
    handleResponse:function(xhr)
    {
        this.$el.find(".code").text(xhr.status);
        this.$el.find(".status").text(xhr.statusText);
    }
});