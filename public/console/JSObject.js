window.JSObject = function(options)
{
    _.extend(this,_.pick(options,['el','className','events']));
    if(!this.el)
       this.el=document.createElement(this.tagName);
    this.$el=$(this.el);
    if(this.className) this.$el.addClass(this.className);
    this.initialize.apply(this,[options]);
    //events binding
    _.each(this.events,_.bind(function(func,event){
        var eventSelf=event.split(" ").slice(0,1).join("");
        var selector=event.split(" ").slice(1).join(" ");
        (selector.length?this.$el.find(selector):this.$el).on(eventSelf,_.bind(this[func],this));
    },this));

    return this;
};

_.extend(window.JSObject.prototype,{
    events:{},
    tagName:'div',
    initialize:function(){}
});


window.JSObject.extend=function(protoProps, staticProps) {
    var parent = this;
    var child;

    // The constructor function for the new subclass is either defined by you
    // (the "constructor" property in your `extend` definition), or defaulted
    // by us to simply call the parent constructor.
    if (protoProps && _.has(protoProps, 'constructor')) {
      child = protoProps.constructor;
    } else {
      child = function(){ return parent.apply(this, arguments); };
    }

    // Add static properties to the constructor function, if supplied.
    _.extend(child, parent, staticProps);

    // Set the prototype chain to inherit from `parent`, without calling
    // `parent`'s constructor function and add the prototype properties.
    child.prototype = _.create(parent.prototype, protoProps);
    child.prototype.constructor = child;

    // Set a convenience property in case the parent's prototype is needed
    // later.
    child.__super__ = parent.prototype;


    return child;
  };