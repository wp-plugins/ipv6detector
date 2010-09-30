<?php
/*
Plugin Name: ipv6detector
Plugin URI: http://patux.cl/ipv6detector
Description: Just a simple plugin to detect if a visitor is using ipv6 or not.
Version: 1.0
Author: Patux
Author URI: http://patux.cl
License: GPL2
*/

add_action('init','ipv6detector_register_widget');

function ipv6detector_register_widget () {
    register_sidebar_widget('ipv6detector', 'ipv6detector');
    register_widget_control('ipv6detector', 'ipv6detector_control');
}

function ipv6detector($args) {
    $ip = getenv ("REMOTE_ADDR");
    extract($args);
    echo $before_widget;
    echo $before_title."IPv6 detector".$after_title;
    if (substr_count($ip,":") > 0 && substr_count($ip,".") == 0) {
        echo "Walking to the future. You are using IPv6: ";
    } else {
        echo "You keep using IPv4: ";
    }
    $URL = get_option('ipv6detector_url');

    echo "<a href=\"$URL$ip\"> $ip </a>";
    echo "<ul>";
    echo "<li><a href=\"http://en.wikipedia.org/wiki/IPv4_address_exhaustion\">IPv4 exhaustion</a></li>";
    echo "<li><a href=\"http://www.iana.org/assignments/ipv4-address-space/ipv4-address-space.xml\">IPv4 address allocation</a></li>";
    echo "</ul>";
    echo $after_widget;
}

function ipv6detector_control() {
    if (isset($_POST['url']) && !empty($_POST['url'])) {
         update_option('ipv6detector_url', $_POST['url']);
    }
    $url=get_option('ipv6detector_url');

    echo "URL to link ip address: <input type='text' name='url' value='http://log.patux.cl/whois.php?obj='/><br />\n";

}



?>
