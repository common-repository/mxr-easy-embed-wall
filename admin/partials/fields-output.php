<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function mixer_wall_settings_game() {
$options = get_option('mixer_ezembed_options_wall'); ?>
<input class='mixer_settings_gct' id='mixer_settings_game' name='mixer_ezembed_options_wall[mixer_settings_game]' size='40' type='text' value="<?php echo $options['mixer_settings_game']; ?>" placeholder='Fortnite'/><br><label>The <strong>game</strong> to fill the Mixer Wall with. This will pull the top streamers for the game.</label><br><p>Limited to <strong>9 streams</strong>. <span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/mixer-wall-pro/' target='_blank'>Mixer Wall PRO</a> to increase this limit to 50.</span></p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>
<?php }

function mixer_wall_settings_channel() {
$options = get_option('mixer_ezembed_options_wall');
echo "<input class='mixer_settings_gct' id='mixer_settings_channel' name='mixer_ezembed_options_wall[mixer_settings_channel]' size='40' type='text' value='{$options['mixer_settings_channel']}' placeholder='btcdaddy,namesx,jaredfp'/><br><label>The mixer.com <strong>channels</strong> to fill the Mixer Wall with. This can be a single channel or multiple channels. Seperate multiple channels with a comma.</label><br><p>Limited to <strong>9 streams</strong>. <span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/mixer-wall-pro/' target='_blank'>Mixer Wall PRO</a> to increase this limit to 50.</span></p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>";
}

function mixer_wall_settings_team() {
$options = get_option('mixer_ezembed_options_wall');
echo "<input class='mixer_settings_gct' id='mixer_settings_team' name='mixer_ezembed_options_wall[mixer_settings_team]' size='40' type='text' value='{$options['mixer_settings_team']}' placeholder='partners'/><br><label>The mixer.com <strong>team</strong> to fill the Mixer Wall with. This will pull the entire team but it will only show team members which are online.</label><br><p>Limited to <strong>9 streams</strong>. <span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/mixer-wall-pro/' target='_blank'>Mixer Wall PRO</a> to increase this limit to 50.</span></p><span class='error'>Choose either the GAME field, the CHANNEL field or the TEAM field.</span>";
}

function mixer_wall_settings_limit() {
$options = get_option('mixer_ezembed_options_wall');
echo "<input id='mixer_settings_limit' name='mixer_ezembed_options_wall[mixer_settings_limit]' size='40' type='text' value='{$options['mixer_settings_limit']}' placeholder='9'/><br><label>The limit on the number of streams returned.<br><span class='upsell'>Upgrade to <a href='https://www.streamweasels.com/store/plugins/mixer-wall-pro/' target='_blank'>Mixer Wall PRO</a> to increase this limit to 50.</span></p></label>";
}

function mixer_wall_appearance_colour_theme() {
$options = get_option('mixer_ezembed_appearance_options_wall');
$html = '<select id="mixer_appearance_colour_theme" name="mixer_ezembed_appearance_options_wall[mixer_appearance_colour_theme]"/>
            <option value="dark-theme" '.selected( $options['mixer_appearance_colour_theme'], 'dark-theme', false ).'>Dark Theme</option>
            <option value="light-theme" '.selected( $options['mixer_appearance_colour_theme'], 'light-theme', false ).'>Light Theme</option>
        </select>';
    echo $html;
}

function mixer_wall_settings_show_default() {
    $options = get_option('mixer_ezembed_options_wall');
    echo "<input disabled class='disabled' id='mixer_wall_settings_show_default' name='mixer_ezembed_options_wall_pro[mixer_wall_settings_show_default]' type='checkbox' value='1' " . checked( 1, $options['mixer_wall_settings_show_default'], false ) . "/><label for='mixer_wall_settings_show_default'>Load the top stream when the page loads.</label><div><p class='upsell'>This feature is only available in <a href='https://www.streamweasels.com/store/plugins/mixer-wall-pro/' target='_blank'>Mixer Wall PRO</a>. Get this feature and all the others, plus premium support <a href='https://www.streamweasels.com/store/plugins/mixer-wall-pro/' target='_blank'>here</a>.</p></div>";
}

?>