jQuery.fn.extend({
    slideRightShow: function() {
        return this.each(function() {
            jQuery(this).animate({width: 'show'});
        });
    },
    slideLeftHide: function() {
        return this.each(function() {
            jQuery(this).animate({width: 'hide'});
        });
    }
    });

$('.h-collapse-opener').click(function() {
    var siblings = $(this).siblings('.h-collapse-opener');
    for(var i = 0; i< siblings.length; i++) {
        $($(siblings[i]).attr('data-target')).hide();
    }

    var menu = $($(this).attr('data-target'));
    if(menu.is(':visible')) {
        menu.slideLeftHide();
    } else {
        menu.slideRightShow();
    }
});

$('.app-card').mouseover(function() {
    $(this).find(' a > img').css('background-color', '#ccc');
});

$('.app-card').mouseout(function() {
    $(this).find('a > img').css('background-color', '');
});

$('.overflow-toggler').click(function() {
    if(!$(this).parent().hasClass('let-overflow')) {
        $(this).text('LESS');
    } else {
        $(this).text('MORE');
    }
    $(this).parent().toggleClass('let-overflow')
});

$('.custom-dialog-filter').click(function() {
    $('.custom-dialog').addClass('hidden');
    $(this).addClass('hidden');
});

$('.custom-dialog-opener').click(function() {
    var target = $(this).attr('href');
    console.log(target);
    $(target).toggleClass('hidden');
    $('.custom-dialog-filter').toggleClass('hidden');
});

$('.notifications-toggle').click(function() {
    $('.notifications').toggleClass('hidden');
});

$('#admin-mode').click(function() {
    if($(this).data('mode') == '2') {
        $(this).data('mode', '3');
        $(this).text('ADMIN');
        $('.admin-mode-items').toggleClass('hidden');
    } else if($(this).data('mode') == '3') {
        $(this).data('mode', '2');
        $(this).text('DEV');
        $('.admin-mode-items').toggleClass('hidden');
    }
});
