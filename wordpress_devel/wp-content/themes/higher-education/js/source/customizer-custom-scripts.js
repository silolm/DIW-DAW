/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 */
( function( api ) {
    wp.customize( 'higher_education_theme_options[reset_typography]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: higher_education_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );

    wp.customize( 'higher_education_theme_options[reset_footer_content]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: higher_education_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );

    wp.customize( 'higher_education_theme_options[reset_all_settings]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: higher_education_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );

    wp.customize( 'higher_education_theme_options[portfolio_type]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( 'jetpack-portfolio' == value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: higher_education_data.portfolio_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );

    wp.customize( 'higher_education_theme_options[testimonial_type]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( 'jetpack-testimonial' == value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: higher_education_data.testimonial_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );
} )( wp.customize );
