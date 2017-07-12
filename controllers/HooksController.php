<?php
namespace UserMeta\Advanced;

class HooksController
{

    public function __construct()
    {
        add_filter('user_meta_wp_hook', [
            $this,
            'toggleWpHooks'
        ], 10, 3);
        add_filter('user_meta_execution_page_config', [
            $this,
            'hookViews'
        ], 10, 2);
        add_filter('user_meta_default_login_form', [
            $this,
            'hookLoginForm'
        ]);
    }

    public function toggleWpHooks($enable, $hookName, $args)
    {
        global $userMeta;
        $advanced = $userMeta->getData('advanced');
        if (empty($advanced['integration']['ump_wp_hooks']))
            return $enable;
        
        return in_array($hookName, $advanced['integration']['ump_wp_hooks']) ? true : false;
    }

    public function hookViews($configs, $key)
    {
        global $userMeta;
        $advanced = $userMeta->getData('advanced');
        if (! empty($advanced['views'][$key]))
            return $advanced['views'][$key];
        
        return $configs;
    }

    public function hookLoginForm($configs)
    {
        global $userMeta;
        $advanced = $userMeta->getData('advanced');
        if (! empty($advanced['views']['login']))
            return $advanced['views']['login'];
        
        return $configs;
    }
}
