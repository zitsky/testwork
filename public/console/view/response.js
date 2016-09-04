Views.Response=JSObject.extend({
    initialize:function()
    {
        this.$el.html(_template("response"));
        this.$response=this.$el.find(".response");
        Events.Global.on('response-complete',_.bind(this.handleResponse,this));

    },
    handleResponse:function(xhr)
    {
        this.renderResponse(_.isUndefined(xhr.responseJSON)?{html:xhr.responseText}:{json:xhr.responseJSON});
    },
    renderResponse:function(response)
    {
        this.$response.html("");
        if(response.json)
        {
            var formatter = new JSONFormatter(response.json,1,{theme:'dark',hoverPreviewEnabled: true});
            this.$response.append(formatter.render());
        }else{
            var iframe=$("<iframe></iframe>");
            iframe[0].src = "data:text/html;charset=utf-8,"+response.html;
            this.$response.append(iframe);
        }

    }
});