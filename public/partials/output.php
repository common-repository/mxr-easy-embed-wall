<?php
$twitchOptions = get_option('mixer_ezembed_options_wall');
$appearanceOptions = get_option('mixer_ezembed_appearance_options_wall');
$defaultTheme = (empty($appearanceOptions['mixer_appearance_colour_theme']) ? 'dark-theme': sanitize_text_field($appearanceOptions['mixer_appearance_colour_theme']));
$id = '0';
$limit = sanitize_text_field($twitchOptions['mixer_settings_limit']);
$twitchGames = sanitize_text_field($twitchOptions['mixer_settings_game']);
$twitchNames = str_replace(' ', '', sanitize_text_field($twitchOptions['mixer_settings_channel']));
$twitchNames = str_replace(',', ';', sanitize_text_field($twitchOptions['mixer_settings_channel']));
$twitchTeam = sanitize_text_field($twitchOptions['mixer_settings_team']);
include (plugin_dir_path( __FILE__ ) . '../../templates/mixer-wall.php' );
?>