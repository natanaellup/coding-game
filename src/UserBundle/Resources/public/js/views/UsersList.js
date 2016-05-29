var UsersList = Backbone.View.extend({
    el: '.users',
    allBadges: null,
    initialize: function () {
        this.allBadges = $('.all-badges').data('all_badges');
        console.log(this.allBadges);
        this.initTooltips();
    },
    initTooltips: function () {
        var _this = this;
        this.$el.find('.user').each(function (index, el) {
            _this.initTooltipByUser($(el));
        });
    },
    initTooltipByUser: function (user) {
        user.tooltipster({
            content: this.getTooltipContent(user)
        });
    },
    getTooltipContent: function (user) {
        var userBadges = user.find('.info').data('badges');
        var userXp = user.find('.info').data('xp');
        var wrapper = $("<div></div>").addClass('user-tooltip-wrapper');
        var ul = $('<ul></ul>');
        wrapper.append(ul);

        $.each(this.allBadges, function (index, value) {
            var badge = $("<div></div>");
            if (typeof userBadges[index] === "undefined") {
                badge.addClass("inactive-badge");
            } else {
                badge.addClass("active-badge");
            }
            var img = $('<img>').attr('src', "/" + badge.badge_logo_url);
            var name = $('<span></span>').text(badge.badge_title);
            ul.append($("<li></li>").append(img).append(name));
        });

        return wrapper.innerHTML;
    }

});

var obj = new UsersList();