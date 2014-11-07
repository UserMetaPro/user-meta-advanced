<?php

if ( ! class_exists( 'umHooksController' ) ) :
class umHooksController {
    
    function __construct() {
        add_filter( 'user_meta_admin_pages',            array( $this, 'addAdvancedMenu' ) );
        
        add_filter( 'user_meta_wp_hook',               array( $this, 'toggleWpHooks' ), 10, 3 );
        add_filter( 'user_meta_execution_page_config',  array( $this, 'hookViews' ), 10, 2 );
        add_filter( 'user_meta_default_login_form',     array( $this, 'hookLoginForm' ) );
    }
    
    
    function addAdvancedMenu( $pages ) {
        global $userMeta;
        
          $pages['advanced']      = array(
                'menu_title'    => __( 'Advanced', $userMeta->name ),
                'page_title'    => __( 'Advanced Settings', $userMeta->name ),
                'menu_slug'     => 'user-meta-advanced',
                'position'      => 5,
                'is_free'       => true,
            );
        
        return $pages;
    }
    
    
    function toggleWpHooks( $enable, $hookName, $args ) {
        global $userMeta;
        
        $advanced = $userMeta->getData( 'advanced' );
        
        if ( empty( $advanced['integration']['ump_wp_hooks'] ) )
            return $enable;
        
        return in_array( $hookName, $advanced['integration']['ump_wp_hooks'] ) ? true : false;
    }
    
    
    function hookViews( $configs, $key ) {
        global $userMeta;
        
        $advanced = $userMeta->getData( 'advanced' );
        if ( ! empty( $advanced['views'][ $key ] ) )
            return $advanced['views'][ $key ];
        
        return $configs;
    }
    
    
    function hookLoginForm( $configs ) {
        global $userMeta;
        
        $advanced = $userMeta->getData( 'advanced' );
        if ( ! empty( $advanced['views']['login'] ) )
            return $advanced['views']['login'];
        
        return $configs;
    }

}
endif;
    
