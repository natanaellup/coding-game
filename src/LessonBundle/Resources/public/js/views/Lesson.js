/**
 * Created by george on 4/20/2016.
 */

var Lesson = Backbone.View.extend({
    el: '.lesson-details',
    events: {
        'click .init-test': 'initModal'
    },
    initModal: function(e){
        $('.form-dialog').dialog({
            resizable: false,
            height:400,
            modal: true,
        });
    }
});

var obj = new Lesson();