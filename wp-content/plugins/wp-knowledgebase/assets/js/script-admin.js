jQuery(document).ready( function($) {

    /**
     * Strips one query argument from a given URL string
     *
     */
    function remove_query_arg( key, sourceURL ) {

        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";

        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }

            rtn = rtn + "?" + params_arr.join("&");

        }

        if(rtn.split("?")[1] == "") {
            rtn = rtn.split("?")[0];
        }

        return rtn;
    }


    /**
     * Adds an argument name, value pair to a given URL string
     *
     */
    function add_query_arg( key, value, sourceURL ) {

        sourceURL = remove_query_arg( key, sourceURL );

        return sourceURL + '&' + key + '=' + value;

    }
    

	/**
     * Initialize Color Picker
     *
     */
    $('.cp-field').wpColorPicker();


    /**
     * Initialize jQuery select2
     *
     */
    if( $.fn.select2 ) {
        $('.kbe-select2').select2({
            minimumResultsForSearch : Infinity
        }).on('select2:open', function() {
            var container = $('.select2-container').last();
            container.addClass('kbe-select2-container');
        });
    }


    /**
     * Initialize datepicker
     *
     */
    if( $.fn.datepicker ) {

        $('.kbe-datepicker').datepicker({
            dateFormat : 'yy-mm-dd',
            beforeShow : function(i) { if ($(i).attr('readonly')) { return false; } }
        });

    }


    /**
     * Tab Navigation
     *
     */
    $('.kbe-nav-tab').on( 'click', function(e) {

        if ( typeof $(this).attr('data-tab')  != 'undefined' ) {            
            e.preventDefault();

            // Nav Tab activation
            $('.kbe-nav-tab').removeClass('kbe-active');
            $(this).addClass('kbe-active');

            // Show tab
            $('.kbe-tab').removeClass('kbe-active');

            var nav_tab = $(this).attr('data-tab');
            $('.kbe-tab[data-tab="' + nav_tab + '"]').addClass('kbe-active');
            $('input[name=active_tab]').val( nav_tab );


            // Change "tab" query var
            url = window.location.href;
            url = remove_query_arg( 'tab', url );
            url = add_query_arg( 'tab', $(this).attr('data-tab'), url );

            window.history.replaceState( {}, '', url );

            // Change http referrer
            $_wp_http_referer = $('input[name=_wp_http_referer]');

            var _wp_http_referer = $_wp_http_referer.val();
            _wp_http_referer = remove_query_arg( 'tab', _wp_http_referer );
            $_wp_http_referer.val( add_query_arg( 'tab', $(this).attr('data-tab'), _wp_http_referer ) );

            // Change hidden tab input
            $(this).closest('form').find('input[name=active_tab]').val( $(this).attr('data-tab') );
        }
    });


    /**
     * Handle template option based on the legacy enable option
     *
     */
    $(document).on( 'change', '[name="kbe_enable_legacy_templates"]', function() {

        if( $(this).is( ':checked' ) ) {

            $(this).closest('.kbe-field-wrapper').find('.kbe-field-notice').show();

            $('.kbe-field-group-current-templates').hide();
            $('.kbe-field-group-legacy-templates').show();

        } else {

            $(this).closest('.kbe-field-wrapper').find('.kbe-field-notice').hide();

            $('.kbe-field-group-current-templates').show();
            $('.kbe-field-group-legacy-templates').hide();

        }

    });

    $('[name="kbe_enable_legacy_templates"]').trigger( 'change' );


    /**
     * Moves the plugin's header to be the first element of its parent
     *
     */
    if( typeof $('#kbe-header') != 'undefined' ) {

        var $header = $('#kbe-header');
        var $parent = $header.parent();

        var $screenMeta      = $('#screen-meta');
        var $screenMetaLinks = $('#screen-meta-links');

        $header.after( $screenMetaLinks );
        $header.after( $screenMeta );

        $screenMetaLinks.show();

    }


    /**
     * Register and deregister customer website from our servers
     *
     */
    $(document).on( 'click', '#kbe-register-license-key', function(e) {

        e.preventDefault();

        if( $('#kbe-is-website-registered').length == 0 )
            return false;

        var action = ( $('#kbe-is-website-registered').val() == 'false' ? 'register' : 'deregister' );

        $button = $(this);

        // Exit if button is disabled
        if( $button.hasClass( 'kbe-disabled' ) )
            return false;

        // Exit if the license key field is empty
        if( $button.siblings( 'input[type="text"]' ).val() == '' ) {
            $button.siblings( 'input[type="text"]' ).focus();
            return false;
        }

        // Disable license key field
        $button.siblings( 'input[type="text"]' ).attr( 'disabled', 'true' );

        // Disable the button
        $button.addClass( 'kbe-disabled' );

        // Remove the label
        $button.find( 'span' ).hide();
        
        // Add a spinner
        if( $button.find( '.spinner' ).length == 0 )
            $button.append( '<div class="spinner"></div>' );

        // Prepare AJAX call data
        var data = {
            action      : 'kbe_action_ajax_' + action + '_website',
            kbe_token   : $('#kbe_token').val(),
            license_key : $('#kbe-license-key').val()
        }

        // Make AJAX call
        $.post( ajaxurl, data, function( response ) {

            // Remove API message
            $button.closest( '.kbe-field-wrapper' ).find( '.kbe-api-action-message' ).remove();

            // Re-enable the button
            $button.siblings( 'input[type="text"]' ).removeAttr( 'disabled' );

            // Re-enable the button
            $button.removeClass( 'kbe-disabled' );

            // Remove spinner
            $button.find( '.spinner' ).remove();
            
            if( response.success == false ) {

                if( action == 'register' )
                    $button.find( 'span.kbe-register' ).show();

                if( action == 'deregister' )
                    $button.find( 'span.kbe-deregister' ).show();

                $button.closest( '.kbe-field-wrapper' ).append( '<div class="kbe-api-action-message kbe-api-action-message-error">' + response.data.message + '</div>' );
                $button.closest( '.kbe-field-wrapper' ).find( '.kbe-api-action-message' ).fadeIn();

            } else {

                if( action == 'register' )
                    $button.find( 'span.kbe-deregister' ).show();

                if( action == 'deregister' )
                    $button.find( 'span.kbe-register' ).show();

                $button.closest( '.kbe-field-wrapper' ).append( '<div class="kbe-api-action-message kbe-api-action-message-success">' + response.data.message + '</div>' );
                $button.closest( '.kbe-field-wrapper' ).find( '.kbe-api-action-message' ).fadeIn();

                if( action == 'register' )
                    $('#kbe-is-website-registered').val( 'true' );

                if( action == 'deregister' )
                    $('#kbe-is-website-registered').val( 'false' );

                if( action == 'deregister' )
                    $button.siblings( 'input[type="text"]' ).val( '' );

            }

        });

    });

    
    /**
     * Handles "Getting Started" page
     *
     */
    if( $('.kbe-card-getting-started').length > 0 ) {

        $('.kbe-card-getting-started').not('.kbe-finished').first().addClass('kbe-open');

    }

    $(document).on( 'click', '.kbe-card-getting-started-title', function(e) {

        e.preventDefault();

        $(this).closest('.kbe-card').toggleClass('kbe-open');

    });

    $(document).on( 'click', '.kbe-card-getting-started .kbe-card-footer .kbe-button-primary', function(e) {

        e.preventDefault();

        if( $(this).hasClass('kbe-disabled') )
            return false;

        // Add animation
        $(this).addClass('kbe-disabled');
        $(this).siblings('.spinner').css( 'opacity', 1 ).css( 'visibility', 'visible' );

        // Prepare AJAX data
        var data = {
            action    : 'kbe_action_ajax_mark_lesson_complete',
            kbe_token : $('#kbe_token').val(),
            lesson    : $(this).closest('.kbe-card').attr( 'data-lesson' )
        };

        // Make AJAX request
        setTimeout( function(){

            $.post( ajaxurl, data, function( response ) {

                // Remove animation
                $('[data-lesson="' + data.lesson + '"]').find('.kbe-button-primary').html( 'Completed' );
                $('[data-lesson="' + data.lesson + '"]').find('.spinner').css( 'opacity', 0 ).css( 'visibility', 'hidden' );

                // Go back to top
                $('html, body').animate({

                    scrollTop: $('[data-lesson="' + data.lesson + '"]').offset().top - 55

                }, 800, function() {

                    setTimeout( function() {

                        // Mark current card as complete
                        $('[data-lesson="' + data.lesson + '"]').addClass('kbe-finished');

                        // Close current card and open the next one
                        $('[data-lesson="' + data.lesson + '"]').removeClass('kbe-open');
                        $('[data-lesson="' + data.lesson + '"]').next('.kbe-card-getting-started').addClass('kbe-open');

                    }, 500 );

                    setTimeout( function() {
                        $('html, body').animate({
                            scrollTop: $('[data-lesson="' + data.lesson + '"]').next('.kbe-card-getting-started').offset().top - 55
                        });
                    }, 1000 );

                })

            });

        }, 1200 );

    });

});