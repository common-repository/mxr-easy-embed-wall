<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// validate our options
function mixer_ezembed_options_wall_validate($input) {
$i = 0;
$new_input = array();
$sanitized_colour_theme = '';
$sanitized_publish_status = '';
        if( isset( $input['mixer_settings_game'] ) ) {
            if ($input['mixer_settings_game'] !== '') $i++;
            $new_input['mixer_settings_game'] = sanitize_text_field( $input['mixer_settings_game'] );
        }
        if( isset( $input['mixer_settings_channel'] ) ) {
            if ($input['mixer_settings_channel'] !== '') $i++;
            $new_input['mixer_settings_channel'] = sanitize_text_field( $input['mixer_settings_channel'] );
        }
        if( isset( $input['mixer_settings_team'] ) ) {
            if ($input['mixer_settings_team'] !== '') $i++;
            $new_input['mixer_settings_team'] = sanitize_text_field( $input['mixer_settings_team'] );
        }
        if ($i > 1) {
          add_settings_error('mixer_settings_game', 'channel-game-error', 'You must choose either GAME or CHANNEL or TEAM. Only one will work at a time.', 'error');
        }
        if( isset( $input['mixer_settings_language'] ) )
            $new_input['mixer_settings_language'] = sanitize_text_field( $input['mixer_settings_language'] );

        if( isset( $input['mixer_settings_limit'] ) && ($input['mixer_settings_limit'] < 10) ) {
                $new_input['mixer_settings_limit'] = sanitize_text_field( $input['mixer_settings_limit'] );
            } else {
                $new_input['mixer_settings_limit'] = 9;
            }

        if( isset( $input['mixer_appearance_colour_theme'] ) ) {
            // Should only be set to either 'dark-theme' or 'light-theme'.
            $sanitized_colour_theme = sanitize_text_field( $input['mixer_appearance_colour_theme'] );
            if ($sanitized_colour_theme !== 'light-theme' && $sanitized_colour_theme !== 'dark-theme') {
                $new_input['mixer_appearance_colour_theme'] = 'dark-theme';
            } else {
                $new_input['mixer_appearance_colour_theme'] = $sanitized_colour_theme;
            }
        }
        
        if( isset( $input['mixer_wall_settings_channel_offline'] ) ) {
                $new_input['mixer_wall_settings_channel_offline'] = (int) $input['mixer_wall_settings_channel_offline'];
            } else {
                $new_input['mixer_wall_settings_channel_offline'] = 0;
            }   
            
        if( isset( $input['mixer_wall_settings_show_default'] ) ) {
                $new_input['mixer_wall_settings_show_default'] = (int) $input['mixer_wall_settings_show_default'];
            } else {
                $new_input['mixer_wall_settings_show_default'] = 0;
            }               
            
        if( isset( $input['mixer_wall_license_key'] ) )
            $new_input['mixer_wall_license_key'] = sanitize_text_field( $input['mixer_wall_license_key'] );             
            
        return $new_input;
}
?>