<?php
/*
 * Plugin Name: User Meta Advanced
 * Plugin URI: http://wordpress.org/plugins/user-meta-advanced/
 * Description: User Meta Pro add-on for advanced settings.
 * Author: Khaled Hossain
 * Version: 1.1
 * Author URI: http://khaledsaikat.com
 */
namespace UserMeta\Advanced;

/**
 *
 * @todo Handle exception when PluginBase not found
 */
add_action('user_meta_plugin_loaded', function () {
    global $userMetaAdvancedBase;
    $userMetaAdvancedBase = new \UserMeta\PluginBase(__FILE__);
    $userMetaAdvancedBase->setNamespace(__NAMESPACE__);
    $userMetaAdvancedBase->loadControllers();
});


