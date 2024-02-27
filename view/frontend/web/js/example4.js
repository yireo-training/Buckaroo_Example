define(['uiComponent', 'knockout'], function(Component, ko) {
    return Component.extend({
        initialize: function() {
            this._super();
            this.foo = ko.observable('bar');
            console.log('sdfs');
            //$('#example3').css('backgroundColor', 'blue');
        }
    });

});
