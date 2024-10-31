=== Mixer Easy Embed Wall ===
Contributors: StreamWeasels
Tags: twitch, mixer.com, mixer.com widget, mixer.com embed
Requires at least: 4.9
Tested up to: 5.0
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily embed a group of Mixer Streams in your site with a simple shortcode and easy admin menu.

== Description ==

Need a plugin which lets you embed mixer.com streams in an easy and manageable way? Mixer Easy Embed wall allows you to embed a group of streams and customise the appearance.

* Show mixer streamers all playing a specific game.
* Show mixer streamers based on usernames.
* Show mixer streamers based on a mixer team.
* Customise the appearance by changing the colour scheme between light and dark.
* Custom manager screen and shortcode support.

The plugin works fluidly across all screen widths and devices, just add the code to your theme or use the shortcode and you're ready to go!

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Easy Embed for Mixer (Wall) screen to configure the plugin
4. To customize the feed from Mixer, fill either the 'Game' field or the 'Channel' field or the 'Team' field. Only fill one of these fields, or the feed will not work.
5. To add the widget to your site, you can use the shortcode [getMixerWall] within any page or post. Advanced Wordpress users could also add the function call directly to their theme to use the widget outside of a page or post (more on this below)

#### Shortcode Usage

To output the Mixer Wall configured on the settings page, simply use the following shortcode anywhere in a post or page within Wordpress:

[getMixerWall]

To output a Mixer Wall configured with custom settings, you can define the settings on the shortcode like this:

[getMixerWall game="fortnite"]

[getMixerWall channels="btcdaddy,namesx,jaredfps"]

[getMixerWall team="partners"]

The full list of shortcode settings:

`id`
`limit`
`game`
`channels`
`team`

If you are using multiple walls on a single page, then each of your shortcodes needs to have a unique ID. For detailed shortcode examples, please see our [demo page](https://www.streamweasels.com/mixer-wall/) on the StreamWeasels site.

#### Advanced Usage

For those of you who know your way around a Wordpress theme, it's possible to embed the Mixer Wall widget directly within your theme using the wordpress function do_shortcode. This will allow you to put the widget anywhere in your theme, even outside of a post or a page.

To do so, use the following PHP code anywhere in your theme.

`<?php echo do_shortcode('[getMixerWall]') ?>`

== Changelog ==

= 1.0.1 =
* Fixed a bug affecting multiple channels seperated by a comma.

= 1.0.0 =
* Initial Release.
