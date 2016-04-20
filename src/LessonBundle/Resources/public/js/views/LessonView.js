/**
 * Created by george on 4/20/2016.
 */

var LessonView = Backbone.View.extend({
    el: 'body',
    events: {
        'click .init-test': 'initModal',
        'change .answer-input': 'sendAnswer'
    },
    initModal: function (e) {
        $('.form-dialog').dialog({
            resizable: false,
            height: 400,
            modal: true
        });
    },
    sendAnswer: function (e) {
        var el = $(e.target);
        if (el.hasClass('radio-answer')) {
            el = el.find('input');
        }
        var option = el.val();
        var questionId = el.parents('.form-group').data('question-id');

        el.parents('.form-group').find('.answer-loader').show();
        $(document).trigger('post-answer', {'option': option, 'question_id': questionId});
    },
    renderSuccessPostAnswer: function (questionId, ajaxResponse) {
        var questionContainer = $('#question-' + questionId);
        questionContainer.find('.answer-loader-image').hide();
    },
    renderErrorPostAnswer: function (questionId, ajaxResponse) {
        var questionContainer = $('#question-' + questionId);
        questionContainer.find('.answer-loader-image').hide();
    },
});
