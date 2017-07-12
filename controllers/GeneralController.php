<?php
namespace UserMeta\Advanced;

/**
 *
 * @author Khaled Hossain
 *        
 * @since 1.1
 */
class GeneralController
{

    public function __construct()
    {
        add_action('plugins_loaded', [
            $this,
            'loadTextDomain'
        ]);
        add_action('admin_menu', [
            $this,
            'pluginSettingsLink'
        ]);
    }

    /**
     * Loading language files
     */
    public function loadTextDomain()
    {
        global $userMetaAdvancedBase;
        load_plugin_textdomain($userMetaAdvancedBase->cleanName(), false, $userMetaAdvancedBase->basePath('/helper/languages'));
    }

    /**
     * Add plugin's settings link in plugins listing page
     */
    public function pluginSettingsLink()
    {
        global $userMetaAdvancedBase;
        add_filter('plugin_action_links_' . $userMetaAdvancedBase->pluginData('slug'), [
            $this,
            '_pluginSettingsLink'
        ]);
    }

    public function _pluginSettingsLink($links)
    {
        $settings_link = '<a href="' . get_admin_url(null, 'admin.php?page=user-meta-advanced') . '">Settings</a>';
        array_unshift($links, $settings_link);
        return $links;
    }
}
