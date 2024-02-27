define(['uiComponent', 'jquery'], function(Component, $) {
    return Component.extend({
        initialize: function() {
            this._super();
            $('#example3').css('backgroundColor', 'red');
        }
    });

});
