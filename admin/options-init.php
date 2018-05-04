<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "sudotech_pngpdwlv";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'sudotech_pngpdwlv',
        'dev_mode' => FALSE,
        'display_name' => 'PNG PDWLV',
        'display_version' => '1.2.2',
        'page_slug' => 'sudotech_pngpdwlv_options',
        'page_title' => 'PNG PDLWV Options',
        'update_notice' => TRUE,
        'intro_text' => '<p>Use this options page to customize the tool to suit your requirements.</p>’',
        'footer_text' => '<p>Developed by <a href="fb.me/sylver.yagi">Sylver Yagi</a>.</p>',
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'PNG PDLWV',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'hints' => array(
            'icon' => 'el el-adult',
            'icon_position' => 'left',
            'icon_color' => '#1e73be',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/sylvery/pngpdlwv',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/sudotech.biz',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/sylvery',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/in/sylvery',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection( $opt_name, array(
        'title' => __( 'Form Settings', 'redux-framework-demo' ),
        'id'    => 'basic',
        'desc'  => __( 'Basic form configurations subsection.', 'redux-framework-demo' ),
        'icon'  => 'el el-home'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Form Options', 'redux-framework-demo' ),
        'desc'       => __( 'Configuration options for your form', 'redux-framework-demo'),
        'id'         => 'form_config',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'        => 'checkbox_datafield',
                'type'      => 'checkbox',
                'title'     => __('Available Fields','redux-framework-demo'),
                'subtitle'  => __('Select appropriately for form to function correctly.','redux-framework-demo'),
                'desc'      => __('Select the fields you want available for your form users','redux-framework-demos'),
                'options'   => array(
                    '1'  => 'Provinces',
                    '2'  => 'Districts',
                    '3'  => 'LLGs',
                    '4'  => 'Wards',
                    '5'  => 'Villages',
                ),
                'default'   => array(
                    '1'  => '1',
                    '2'  => '1',
                    '3'  => '1',
                    '4'  => '1',
                    '5'  => '0',
                ),
            ),
            array(
                'id'        => 'radio_formlabels',
                'type'      => 'radio',
                'title'     => __('Form Labels','redux-framework-demo'),
                'subtitle'  => __('Show or Hide Labels','redux-framework-demo'),
                'desc'      => __('Easily hide or show data labels for your form.','redux-framework-demos'),
                'options'   => array(
                    '1'  => 'Show',
                    '2'  => 'Hide',
                ),
                'default'   => '1'
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header/Footer', 'redux-framework-demo' ),
        'desc'       => __( 'Form header and footer configuration.', 'redux-framework-demo' ),
        'id'         => 'form-header-conf',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'showSocial',
                'type'     => 'checkbox',
                'title'    => __('Social Links', 'redux-framework-demo'), 
                'subtitle'    => __('Show/Hide Social Links', 'redux-framework-demo'), 
                'desc'    => __('Show or hide social links in header/footer. Checking the box next to either header or footer will show or hide the social icons in either the header or the footer.', 'redux-framework-demo'), 
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    '1' => 'Header',
                    '2' => 'Footer',
                ),
                //See how default has changed? you also don't need to specify opts that are 0.
                'default' => array(
                    '1' => '0', 
                    '2' => '1', 
                )
            ),
            array(
                'id'       => 'form_header',
                'type'     => 'textarea',
                'title'    => __( 'Form Header', 'redux-framework-demo' ),
                'subtitle' => __( 'HTML tags are allowed', 'redux-framework-demo' ),
                'desc'     => __( 'Enter any html you would like to display on the form header', 'redux-framework-demo' ),
                'default'  => 'Default Text',
            ),
            array(
                'id'       => 'form_footer',
                'type'     => 'textarea',
                'title'    => __( 'Form Footer', 'redux-framework-demo' ),
                'subtitle' => __( 'HTML tags are allowed', 'redux-framework-demo' ),
                'desc'     => __( 'Enter any html you would like to display on the form footer', 'redux-framework-demo' ),
                'default'  => 'Default Text',
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */
