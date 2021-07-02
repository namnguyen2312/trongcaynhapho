<?php
function foodfarm_vc_animation_type() {
    return array(
        "type" => "foodfarm_animation_type",
        "heading" => esc_html__("Animation Type", 'foodfarm'),
        "param_name" => "animation_type",
        "admin_label" => true
    );
}
function foodfarm_vc_woo_order_by() {
    return array(
        '',
        esc_html__( 'Date', 'js_composer' ) => 'date',
        esc_html__( 'ID', 'js_composer' ) => 'ID',
        esc_html__( 'Author', 'js_composer' ) => 'author',
        esc_html__( 'Title', 'js_composer' ) => 'title',
        esc_html__( 'Modified', 'js_composer' ) => 'modified',
        esc_html__( 'Random', 'js_composer' ) => 'rand',
        esc_html__( 'Comment count', 'js_composer' ) => 'comment_count',
        esc_html__( 'Menu order', 'js_composer' ) => 'menu_order',
    );
}
function foodfarm_shortcodeiconpicker_type_foodfarmfont( $icons ) {
    $foodfarmfont_icons = array(
        array( 'icon-1' => '' ),
        array( 'icon-2' => '' ),
        array( 'icon-3' => '' ),
        array( 'icon-4' => '' ),
        array( 'icon-5' => '' ),
        array( 'icon-6' => '' ),
        array( 'icon-7' => '' ),
        array( 'icon-8' => '' ),
        array( 'icon-9' => '' ),
        array( 'icon-10' => '' ),
        array( 'icon-11' => '' ),
        array( 'icon-12' => '' ),
        array( 'icon-22' => '' ),
        array( 'icon-32' => '' ),
        array( 'icon-42' => '' ),
        array( 'icon-52' => '' ),
        array( 'icon-62' => '' ),
        array( 'icon-icon1-01' => '' ), 
        array( 'icon-icon1-02' => '' ), 
        array( 'icon-icon1-03' => '' ), 
        array( 'icon-icon1-04' => '' ), 
        array( 'icon-icon1-05' => '' ), 
        array( 'icon-icon1-06' => '' ), 
        array( 'icon-icon1-07' => '' ), 
        array( 'icon-icon1-08' => '' ), 
        array( 'icon-icon1-09' => '' ), 
        array( 'icon-icon1-10' => '' ),      
        array( 'ff-fresh-meaticon63' => '' ),
        array( 'ff-fresh-meaticon64' => '' ),
        array( 'ff-fresh-meaticon65' => '' ), 
        array( 'ff-fresh-meaticon66' => '' ),
        array( 'ff-fresh-meaticon67' => '' ),
        array( 'ff-fresh-meaticon68' => '' ),
        array( 'ff-fresh-meaticon69' => '' ),
        array( 'ff-fresh-meaticon70' => '' ),
        array( 'ff-fresh-meaticon71' => '' ),
        array( 'ff-fresh-meaticon72' => '' ),
        array( 'ff-fresh-meaticon73' => '' ),
        array( 'ff-fresh-meaticon74' => '' ),
        array( 'ff-fresh-meaticon75' => '' ),
        array( 'ff-fresh-meaticon76' => '' ),
        array( 'ff-fresh-meaticon77' => '' ),
        array( 'ff-fresh-meaticon78' => '' ),
        array( 'ff-fresh-meaticon79' => '' ),
        array( 'ff-fresh-meaticon80' => '' ),
    );
    return array_merge( $icons, $foodfarmfont_icons );
}
add_filter( 'vc_iconpicker-type-foodfarmfont', 'foodfarm_shortcodeiconpicker_type_foodfarmfont' );
function foodfarm_animation_custom() {
    return array(
        '',
        esc_html__('bounce', 'arrowpress-shortcodes') => 'bounce',
        esc_html__('flash', 'arrowpress-shortcodes') => 'flash',
        esc_html__('pulse', 'arrowpress-shortcodes') => 'pulse',
        esc_html__('rubberBand', 'arrowpress-shortcodes') => 'rubberBand',
        esc_html__('shake', 'arrowpress-shortcodes') => 'shake',
        esc_html__('swing', 'arrowpress-shortcodes') => 'swing',
        esc_html__('tada', 'arrowpress-shortcodes') => 'swing',
        esc_html__('wobble', 'arrowpress-shortcodes') => 'wobble',
        esc_html__('jello', 'arrowpress-shortcodes') => 'jello',
        esc_html__('bounceIn', 'arrowpress-shortcodes') => 'bounceIn',
        esc_html__('bounceInDown', 'arrowpress-shortcodes') => 'bounceInDown',
        esc_html__('bounceInLeft', 'arrowpress-shortcodes') => 'bounceInLeft',
        esc_html__('bounceInRight', 'arrowpress-shortcodes') => 'bounceInRight',
        esc_html__('bounceInUp', 'arrowpress-shortcodes') => 'bounceInUp',
        esc_html__('bounceOut', 'arrowpress-shortcodes') => 'bounceOut',
        esc_html__('bounceOutDown', 'arrowpress-shortcodes') => 'bounceOutDown',
        esc_html__('bounceOutLeft', 'arrowpress-shortcodes') => 'bounceOutLeft',
        esc_html__('bounceOutRight', 'arrowpress-shortcodes') => 'bounceOutRight',
        esc_html__('bounceOutUp', 'arrowpress-shortcodes') => 'bounceOutUp',
        esc_html__('fadeIn', 'arrowpress-shortcodes') => 'fadeIn',
        esc_html__('fadeInDown', 'arrowpress-shortcodes') => 'fadeInDown',
        esc_html__('fadeInDownBig', 'arrowpress-shortcodes') => 'fadeInDownBig',
        esc_html__('fadeInLeft', 'arrowpress-shortcodes') => 'fadeInLeft',
        esc_html__('fadeInLeftBig', 'arrowpress-shortcodes') => 'fadeInLeftBig',
        esc_html__('fadeInRight', 'arrowpress-shortcodes') => 'fadeInRight',
        esc_html__('fadeInUp', 'arrowpress-shortcodes') => 'fadeInUp',
        esc_html__('fadeInUpBig', 'arrowpress-shortcodes') => 'fadeInUpBig',
        esc_html__('fadeOut', 'arrowpress-shortcodes') => 'fadeOut',
        esc_html__('fadeOutDown', 'arrowpress-shortcodes') => 'fadeOutDown',
        esc_html__('fadeOutDownBig', 'arrowpress-shortcodes') => 'fadeOutDownBig',
        esc_html__('fadeOutLeft', 'arrowpress-shortcodes') => 'fadeOutLeft',
        esc_html__('fadeOutLeftBig', 'arrowpress-shortcodes') => 'fadeOutLeftBig',
        esc_html__('fadeOutRight', 'arrowpress-shortcodes') => 'fadeOutRight',
        esc_html__('fadeOutUp', 'arrowpress-shortcodes') => 'fadeOutUp',
        esc_html__('fadeOutUpBig', 'arrowpress-shortcodes') => 'fadeOutUpBig',
        esc_html__('flip', 'arrowpress-shortcodes') => 'flip',
        esc_html__('flipInX', 'arrowpress-shortcodes') => 'flipInX',
        esc_html__('flipInY', 'arrowpress-shortcodes') => 'flipInY',
        esc_html__('flipOutX', 'arrowpress-shortcodes') => 'flipOutX',
        esc_html__('flipOutY', 'arrowpress-shortcodes') => 'flipOutY',
        esc_html__('lightSpeedIn', 'arrowpress-shortcodes') => 'lightSpeedIn',
        esc_html__('lightSpeedOut', 'arrowpress-shortcodes') => 'lightSpeedOut',
        esc_html__('rotateIn', 'arrowpress-shortcodes') => 'rotateIn',
        esc_html__('rotateInDownLeft', 'arrowpress-shortcodes') => 'rotateInDownLeft',
        esc_html__('rotateInDownRight', 'arrowpress-shortcodes') => 'rotateInDownRight',
        esc_html__('rotateInUpLeft', 'arrowpress-shortcodes') => 'rotateInUpLeft',
        esc_html__('rotateInUpRight', 'arrowpress-shortcodes') => 'rotateInUpRight',
        esc_html__('rotateOut', 'arrowpress-shortcodes') => 'rotateOut',
        esc_html__('rotateOutDownLeft', 'arrowpress-shortcodes') => 'rotateOutDownLeft',
        esc_html__('rotateOutDownRight', 'arrowpress-shortcodes') => 'rotateOutDownRight',
        esc_html__('rotateOutUpLeft', 'arrowpress-shortcodes') => 'rotateOutUpLeft',
        esc_html__('rotateOutUpRight', 'arrowpress-shortcodes') => 'rotateOutUpRight',
        esc_html__('slideInUp', 'arrowpress-shortcodes') => 'slideInUp',
        esc_html__('slideInDown', 'arrowpress-shortcodes') => 'slideInDown',
        esc_html__('slideInLeft', 'arrowpress-shortcodes') => 'slideInLeft',
        esc_html__('slideInRight', 'arrowpress-shortcodes') => 'slideInRight',
        esc_html__('slideOutUp', 'arrowpress-shortcodes') => 'slideOutUp',
        esc_html__('zoomIn', 'arrowpress-shortcodes') => 'zoomIn',
        esc_html__('zoomInDown', 'arrowpress-shortcodes') => 'zoomInDown',
        esc_html__('zoomInLeft', 'arrowpress-shortcodes') => 'zoomInLeft',
        esc_html__('zoomInRight', 'arrowpress-shortcodes') => 'zoomInRight',
        esc_html__('zoomInUp', 'arrowpress-shortcodes') => 'zoomInUp',
        esc_html__('zoomOut', 'arrowpress-shortcodes') => 'zoomOut',
        esc_html__('zoomOutDown', 'arrowpress-shortcodes') => 'zoomOutDown',
        esc_html__('zoomOutLeft', 'arrowpress-shortcodes') => 'zoomOutLeft',
        esc_html__('zoomOutRight', 'arrowpress-shortcodes') => 'zoomOutRight',
        esc_html__('zoomOutUp', 'arrowpress-shortcodes') => 'zoomOutUp',
        esc_html__('hinge', 'arrowpress-shortcodes') => 'hinge',
        esc_html__('rollIn', 'arrowpress-shortcodes') => 'rollIn',
        esc_html__('rollOut', 'arrowpress-shortcodes') => 'rollOut',
    );
}
function foodfarm_vc_woo_order_way() {
    return array(
        '',
        esc_html__( 'Descending', 'js_composer' ) => 'DESC',
        esc_html__( 'Ascending', 'js_composer' ) => 'ASC',
    );
}
function foodfarm_vc_slider_item_device_type_field($settings, $value) {
    $output = '<input type="number" min="0" max="5" class="wpb_vc_param_value ' . $settings['param_name'] . '" name="' . $settings['param_name'] . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />';
    return $output;
}
function foodfarm_shortcode_template( $name = false ) {
    if (!$name)
        return false;

    if ( $overridden_template = locate_template( 'vc_templates' . $name . '.php' ) ) {
        return $overridden_template;
    } else {
        // If neither the child nor parent theme have overridden the template,
        // we load the template from the 'templates' sub-directory of the directory this file is in
        return FOODFARM_SHORTCODES_TEMPLATES . $name . '.php';
    }
}
function foodfarm_shortcode_extract_class( $el_class ) {
    $output = '';
    if ( $el_class != '' ) {
        $output = " " . str_replace( ".", "", $el_class );
    }

    return $output;
}

function foodfarm_shortcode_js_remove_wpautop( $content, $autop = false ) {

    if ( $autop ) {
        $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }

    return do_shortcode( shortcode_unautop( $content ) );
}

function foodfarm_shortcode_end_block_comment( $string ) {
    return WP_DEBUG ? '<!-- END ' . $string . ' -->' : '';
}

function foodfarm_shortcode_image_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
    // this is an attachment, so we have the ID
    $image_src = array();
    if ( $attach_id ) {
        $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
        $actual_file_path = get_attached_file( $attach_id );
        // this is not an attachment, let's use the image url
    } else if ( $img_url ) {
        $file_path = parse_url( $img_url );
        $actual_file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
        $actual_file_path = ltrim( $file_path['path'], '/' );
        $actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
        $orig_size = getimagesize( $actual_file_path );
        $image_src[0] = $img_url;
        $image_src[1] = $orig_size[0];
        $image_src[2] = $orig_size[1];
    }
    if(!empty($actual_file_path)) {
        $file_info = pathinfo( $actual_file_path );
        $extension = '.' . $file_info['extension'];

        // the image path without the extension
        $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

        $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

        // checking if the file size is larger than the target size
        // if it is smaller or the same size, stop right here and return
        if ( $image_src[1] > $width || $image_src[2] > $height ) {

            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if ( file_exists( $cropped_img_path ) ) {
                $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
                $vt_image = array(
                    'url' => $cropped_img_url,
                    'width' => $width,
                    'height' => $height
                );

                return $vt_image;
            }

            // $crop = false
            if ( $crop == false ) {
                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

                // checking if the file already exists
                if ( file_exists( $resized_img_path ) ) {
                    $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                    $vt_image = array(
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0],
                        'height' => $proportional_size[1]
                    );

                    return $vt_image;
                }
            }

            // no cache files - let's finally resize it
            $img_editor = wp_get_image_editor( $actual_file_path );

            if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
                return array(
                    'url' => '',
                    'width' => '',
                    'height' => ''
                );
            }

            $new_img_path = $img_editor->generate_filename();

            if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
                return array(
                    'url' => '',
                    'width' => '',
                    'height' => ''
                );
            }
            if ( ! is_string( $new_img_path ) ) {
                return array(
                    'url' => '',
                    'width' => '',
                    'height' => ''
                );
            }

            $new_img_size = getimagesize( $new_img_path );
            $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

            // resized output
            $vt_image = array(
                'url' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1]
            );

            return $vt_image;
        }

        // default output - without resizing
        $vt_image = array(
            'url' => $image_src[0],
            'width' => $image_src[1],
            'height' => $image_src[2]
        );

        return $vt_image;
    }
    return false;
}

function foodfarm_shortcode_get_image_by_size(
    $params = array(
        'post_id' => null,
        'attach_id' => null,
        'thumb_size' => 'thumbnail',
        'class' => ''
    )
) {
    //array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size )
    if ( ( ! isset( $params['attach_id'] ) || $params['attach_id'] == null ) && ( ! isset( $params['post_id'] ) || $params['post_id'] == null ) ) {
        return false;
    }
    $post_id = isset( $params['post_id'] ) ? $params['post_id'] : 0;

    if ( $post_id ) {
        $attach_id = get_post_thumbnail_id( $post_id );
    } else {
        $attach_id = $params['attach_id'];
    }

    $thumb_size = $params['thumb_size'];
    $thumb_class = ( isset( $params['class'] ) && $params['class'] != '' ) ? $params['class'] . ' ' : '';

    global $_wp_additional_image_sizes;
    $thumbnail = '';

    if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, array(
                'thumbnail',
                'thumb',
                'medium',
                'large',
                'full'
            ) ) )
    ) {
        $thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, array( 'class' => $thumb_class . 'attachment-' . $thumb_size ) );
    } elseif ( $attach_id ) {
        if ( is_string( $thumb_size ) ) {
            preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
            if ( isset( $thumb_matches[0] ) ) {
                $thumb_size = array();
                if ( count( $thumb_matches[0] ) > 1 ) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = $thumb_matches[0][1]; // height
                } elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = $thumb_matches[0][0]; // height
                } else {
                    $thumb_size = false;
                }
            }
        }
        if ( is_array( $thumb_size ) ) {
            // Resize image to custom size
            $p_img = foodfarm_shortcode_image_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
            $alt = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
            $attachment = get_post( $attach_id );
            if(!empty($attachment)) {
                $title = trim( strip_tags( $attachment->post_title ) );

                if ( empty( $alt ) ) {
                    $alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
                }
                if ( empty( $alt ) ) {
                    $alt = $title;
                } // Finally, use the title
                if ( $p_img ) {
                    $img_class = '';
                    //if ( $grid_layout == 'thumbnail' ) $img_class = ' no_bottom_margin'; class="'.$img_class.'"
                    $thumbnail = '<img class="' . esc_attr( $thumb_class ) . '" src="' . esc_attr( $p_img['url'] ) . '" width="' . esc_attr( $p_img['width'] ) . '" height="' . esc_attr( $p_img['height'] ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" />';
                }
            }
        }
    }

    $p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

    return apply_filters( 'vc_wpb_getimagesize', array(
        'thumbnail' => $thumbnail,
        'p_img_large' => $p_img_large
    ), $attach_id, $params );
}
function foodfarm_vc_animation_duration() {
    return array(
        "type" => "textfield",
        "heading" => esc_html__("Animation Duration", 'foodfarm'),
        "param_name" => "animation_duration",
        "description" => esc_html__("numerical value (unit: milliseconds)", 'foodfarm'),
        "value" => '1000'
    );
}

function foodfarm_vc_animation_delay() {
    return array(
        "type" => "textfield",
        "heading" => esc_html__("Animation Delay", 'foodfarm'),
        "param_name" => "animation_delay",
        "description" => esc_html__("numerical value (unit: milliseconds)", 'foodfarm'),
        "value" => '0'
    );
}

function foodfarm_vc_custom_class() {
    return array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Extra class name', 'foodfarm' ),
        'param_name' => 'el_class',
        'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'foodfarm' )
    );
}

function foodfarm_shortcode_widget_title( $params = array( 'title' => '' ) ) {
    if ( $params['title'] == '' ) {
        return '';
    }

    $extraclass = ( isset( $params['extraclass'] ) ) ? " " . $params['extraclass'] : "";
    $output = '<h2 class="wpb_heading' . $extraclass . '">' . $params['title'] . '</h2>';

    return apply_filters( 'wpb_widget_title', $output, $params );
}

function foodfarm_vc_slider_pagination_style_type_field($settings, $value) {
    $param_line = '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

    $options = array(
        'none', 
        'load more',
        'pagination',
         );
    foreach ($options as $option) {
        $selected = '';
        if ($option == $value)
            $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</select>';

    return $param_line;
}
if (function_exists('vc_add_shortcode_param')){
    vc_add_shortcode_param('foodfarm_animation_type', 'foodfarm_vc_animation_type_field');
}
function foodfarm_vc_animation_type_field($settings, $value) {
    $param_line = '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

    $param_line .= '<option value="">none</option>';

    $param_line .= '<optgroup label="' . esc_html__('Enter', 'foodfarm') . '">';
    $options = array("enter top", "enter left", "enter right", "enter bottom");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . esc_html__('Scale', 'foodfarm') . '">';
    $options = array("scale up", "scale down");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . ' 20%"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $selected = '';
    if ( 'move 24px' == $value ) $selected = ' selected="selected"';
    $param_line .= '<option value="move 24px"' . $selected . '>move</option>';
    
    $selected = '';
    if ( 'over 0.6s' == $value ) $selected = ' selected="selected"';
    $param_line .= '<option value="over 0.6s"' . $selected . '>over</option>';
    
    $param_line .= '<optgroup label="' . esc_html__('Flip', 'foodfarm') . '">';
    $options = array("flip 45deg", "flip -90deg");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';
    
    $param_line .= '<optgroup label="' . esc_html__('Spin', 'foodfarm') . '">';
    $options = array("spin 180deg", "spin -30deg");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';
    
    $param_line .= '<optgroup label="' . esc_html__('Roll', 'foodfarm') . '">';
    $options = array("roll 15deg", "roll -45deg");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';
    
    $param_line .= '<optgroup label="' . esc_html__('Wait', 'foodfarm') . '">';
    $options = array("wait 0.2s", "wait 0.4s", "wait 0.6s", "wait 0.8s", "wait 1s");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';
    
    $selected = '';
    if ( 'vFactor 0.8' == $value ) $selected = ' selected="selected"';
    $param_line .= '<option value="vFactor 0.8"' . $selected . '>vFactor</option>';

    $param_line .= '</select>';

    return $param_line;
}

