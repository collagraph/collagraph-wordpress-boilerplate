$(function() {
    $(document).ready(function() {
        $('.p-name, .letter-subhead, .project-subhead').widowFix({
            letterLimit: 10,
            prevLimit: 8
        });

        $('.item-meta, .project-summary, .letter-transcript-text, .project-case-study p, .project-case-study figcaption, .credentials-item figcaption p, .daily-news .weather').widowFix();

        $('.h-entry .e-content, .project-case-study').fitVids();

        // replace transcript with show link
        // callConditionalElements();

        // fancybox
        $(".fancybox").fancybox({
            loop        : false,
            preload     : 0,
            openEffect  : 'none',
            closeEffect : 'none',
            nextEffect  : 'none',
            prevEffect  : 'none',
            padding     : 0,
            margin      : [20, 60, 20, 60],
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });

        // remove fancybox for small screens
        removeFancyBox();

        // collapse transcript
        collapseTranscript();

        // collapse credentials
        $('.credentials-details-title').collapsible();
    });

    $(window).bind("load", function() {

    });

    $(window).resize(function(){
        // remove fancybox for small screens
        removeFancyBox();
    });
});

// remove fancybox for small screens
function removeFancyBox() {
    var size = window.getComputedStyle(document.body,':after').getPropertyValue('content');

    if (size == 'xxs' || size == 'xs' || size == 's') {
        $('.fancybox').addClass('fancybox-removed');

        $('.fancybox-removed').removeClass('fancybox');
    } else {
        $('.fancybox-removed').addClass('fancybox');

        $('.fancybox').removeClass('fancybox-removed');
    }
}

function showTranscript() {
    if ($('.letter-transcript-title').hasClass('collapsible-heading-collapsed')) {
        $('.collapsible-heading-status').text('Hide');
        $('.letter-transcript-title').removeClass('collapsible-heading-collapsed');
        $('.letter-transcript-text').removeClass('collapsible-content-collapsed');
    }
}

function collapseTranscript() {
    // collapse letter transcript
    var size = window.getComputedStyle(document.body,':after').getPropertyValue('content');

    if (size == 'm' || size == 'l' || size == 'xl') {
        $('.letter-transcript-title').collapsible();
    }
}