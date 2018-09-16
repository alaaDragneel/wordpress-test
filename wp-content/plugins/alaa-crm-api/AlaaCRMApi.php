<?php

/*
    Plugin Name: Alaa CRM Api
    Plugin URI: http://alaa-CRM-api.com
    description: a plugin to create awesomeness and spread joy
    Version: 1
    Author: Mr. Alaa
    Author URI: http://alaa.com
    License: GPL2
*/

// Start Init The Plugin With Some Custom Modifications On The Activation  Of The Plugin
function init_plugin_options() {
    // Get The Global Database Object / Variable
    global $wpdb;

    // Generate The table name With The WordPress Prefix
    $table_name = "{$wpdb->prefix}alaa_crm_leads";
    $table_call_name = "{$wpdb->prefix}alaa_crm_calls";

    // Get The Character Set Of The Database
    // It seems The WordPress Has A Default Method For That
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table_name} (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , 
            `name` VARCHAR(50) NOT NULL , 
            `email` VARCHAR(255) NOT NULL , 
            PRIMARY KEY (`id`), 
            UNIQUE (`email`) 
        ) {$charset_collate};";

    $call_sql = "CREATE TABLE {$table_call_name} (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , 
            `title` VARCHAR(50) NOT NULL , 
            `lead_id` INT UNSIGNED NOT NULL , 
            PRIMARY KEY (`id`), 
            UNIQUE (`lead_id`)
        ) {$charset_collate};";

    // Require The Upgrade PHP Script File To Access The Functions That Can Modify The Database
    require_once( ABSPATH . "wp-admin/includes/upgrade.php" );
    // Modifies the database based on specified SQL statements
    dbDelta($sql);
    dbDelta($call_sql);
}

// Run And Install The Plugin Scripts When plugin activation
register_activation_hook(__FILE__, 'init_plugin_options');


// Add New Menu Items
add_action( 'admin_menu', 'alaa_crm_modify_menu' );
function alaa_crm_modify_menu()
{
	leads_menu();
	calls_menu();
}

function leads_menu() {

	//this is the main item for the menu
    add_menu_page(
        'Alaa CRM', //page title
        'Alaa CRM', //menu title
        'manage_options', //capabilities
        'alaa_crm_list', //menu slug
        'alaa_crm_list' //function
    );
	
    //this is a submenu
    add_submenu_page(
        'alaa_crm_list', //parent slug
        'Add New Lead', //page title
        'Add New Lead', //menu title
        'manage_options', //capability
        'alaa_crm_create', //menu slug
        'alaa_crm_create'
    ); //function

	
	//this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(
        null, //parent slug
        'Update Lead', //page title
        'Update', //menu title
        'manage_options', //capability
        'alaa_crm_update', //menu slug
        'alaa_crm_update'
    ); //function
}

function calls_menu() {
    //this is a submenu
    add_submenu_page(
        'alaa_crm_list', //parent slug
        'All Calls', //page title
        'All Calls', //menu title
        'manage_options', //capability
        'alaa_crm_call_list', //menu slug
        'alaa_crm_call_list'
    ); //function
    
    //this is a submenu
    add_submenu_page(
        'alaa_crm_list', //parent slug
        'Add New Call', //page title
        'Add New Call', //menu title
        'manage_options', //capability
        'alaa_crm_call_create', //menu slug
        'alaa_crm_call_create'
    ); //function

	
	//this submenu is HIDDEN, however, we need to add it anyways
    // add_submenu_page(
    //     null, //parent slug
    //     'Update Lead', //page title
    //     'Update', //menu title
    //     'manage_options', //capability
    //     'alaa_crm_update', //menu slug
    //     'alaa_crm_update'
    // ); //function
}

define('ROOTDIR', plugin_dir_path(__FILE__));
// Leads
require_once(ROOTDIR . 'alaa-list.php');
require_once(ROOTDIR . 'alaa-create.php');
require_once(ROOTDIR . 'alaa-update.php');
// Calls
require_once(ROOTDIR . '/calls/alaa-calls-list.php');
require_once(ROOTDIR . '/calls/alaa-calls-create.php');
require_once(ROOTDIR . '/calls/alaa-calls-update.php');