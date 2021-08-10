jQuery(document).bind('gform_post_render', function(){
    jQuery("[class*='count[']").each(function() {
        var elClass = jQuery(this).attr('class');
        var maxWords = 0;
        var countControl = elClass.substring((elClass.indexOf('['))+1, elClass.lastIndexOf(']')).split(',');

        if (countControl.length > 1) {
            minWords = countControl[0];
            maxWords = countControl[1];
        } else {
            maxWords = countControl[0];
        }

        jQuery(this).find('textarea').bind('keyup click blur focus change paste', function() {
            var numWords = jQuery.trim(jQuery(this).val()).replace(/\s+/g," ").split(' ').length;

            if (jQuery(this).val() === '') {
                numWords = 0;
            }

            jQuery(this).siblings('.word-count-wrapper').children('.word-count').text(numWords);

            if (numWords > maxWords && maxWords != 0) {
                jQuery(this).siblings('.word-count-wrapper').addClass('error');

                var trimmedString = '';
                var wordArray = jQuery(this).val().split(/[\s\.\?]+/);
                for (var i = 0; i < maxWords; i++) {
                    trimmedString += wordArray[i] + ' ';
                }

                jQuery(this).val(trimmedString);
            }
            else if (numWords == maxWords && maxWords != 0) {
                jQuery(this).siblings('.word-count-wrapper').addClass('error');
            }
            else {
                jQuery(this).siblings('.word-count-wrapper').removeClass('error');
            }

        }).after('<span class="word-count-wrapper">Approximate Word Count: <span class="word-count">0</span></span>');
    });
});