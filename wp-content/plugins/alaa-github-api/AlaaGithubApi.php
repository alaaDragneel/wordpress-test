<?php

/*
    Plugin Name: Alaa Github Api
    Plugin URI: http://alaa-github-api.com
    description: a plugin to create awesomeness and spread joy
    Version: 1.2
    Author: Mr. Alaa
    Author URI: http://alaa.com
    License: GPL2
 */

// For security reasons, it’s also a good idea to deny direct access to the file
defined('ABSPATH') or die('No script kiddies please!');
require_once __DIR__ . '/vendor/autoload.php';

function github_issues_func( $atts, $githubApi = null ) {
    // Conditionally instantiate our class
    $githubApi = ($githubApi) ? $githubApi : new GithubApi();

    // Make the API call to get issues, passing in the GitHub owner and repository
    //                          Api          Username        Repository
    $issues = $githubApi->api('issue')->all(get_option("github_org"), get_option('github_repo'));


    // Handle the case when there are no issues
    if (empty($issues))
        return "<strong>" . __("No issues to show By The Way Alaa Is Very Cute") . "</strong>";

   // We're going to return a string. First, we open a list.
    $return = "<ul>";

   // Loop over the returned issues
    foreach ($issues as $issue) {

      // Add a list item for each issue to the string
      // Maybe make each one a link to the issue issuing $issue['url] )
        $return .= "<li>
            <a href='{$issue['url']}' target='_blank'>{$issue['title']}</a>
        </li>";

    }

   // Don't forget to close the list
    $return .= "</ul>";

    return $return;

}

add_shortcode("github_issues", "github_issues_func");


// Register the menu.
add_action("admin_menu", "github_plugin_menu_func");
function github_plugin_menu_func()
{
    /*
        $parent_slug, 
        $page_title,
        $menu_title,
        $capability,
        $menu_slug, 
        $function = '' 
     */
    add_submenu_page(
        "options-general.php",  // Which menu parent
        "Alaa GitHub Api",            // Page title
        "Alaa GitHub Api",            // Menu title
        "manage_options",       // Minimum capability (manage_options is an easy way to target administrators)
        "github",            // Menu slug
        "github_plugin_options"     // Callback that prints the markup
    );
}

if (isset($_GET['status']) && $_GET['status'] == 'success') {
?>
   <div id="message" class="updated notice is-dismissible">
      <p><?php _e("Settings updated!", "alaa-github-api"); ?></p>
      <button type="button" class="notice-dismiss">
         <span class="screen-reader-text"><?php _e("Done.", "alaa-github-api"); ?></span>
      </button>
   </div>
<?php

}

// Print the markup for the page
function github_plugin_options()
{
    if (!current_user_can("manage_options")) {
        wp_die(__("You do not have sufficient permissions to access this page."));
    }
?>
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">

        <input type="hidden" name="action" value="update_github_settings" />

        <h3><?php _e("Your GitHub Repository Info", "alaa-github-api"); ?></h3>
        <p>
            <label><?php _e("Your GitHub Organization:", "alaa-github-api"); ?></label>
            <input class="" type="text" name="github_org" value="<?php echo get_option('github_org'); ?>" />
        </p>

        <p>
            <label><?php _e("Your GitHub repository (slug):", "alaa-github-api"); ?></label>
            <input class="" type="text" name="github_repo" value="<?php echo get_option('github_repo'); ?>" />
        </p>

        <input class="button button-primary" type="submit" value="<?php _e("Save", "alaa-github-api"); ?>" />

    </form>
<?php
    echo do_shortcode("[github_issues]");
}

add_action('admin_post_update_github_settings', 'github_handle_save');


function github_handle_save()
{

   // Get the options that were sent
    $org = (!empty($_POST["github_org"])) ? $_POST["github_org"] : null;
    $repo = (!empty($_POST["github_repo"])) ? $_POST["github_repo"] : null;

   // Validation Here
   
   // Update the values
    update_option("github_org", $org, true);
    update_option("github_repo", $repo, true);

   // Redirect back to settings page
   // The ?page=github corresponds to the "slug" 
   // set in the fourth parameter of add_submenu_page() above.
    $redirect_url = get_bloginfo("url") . "/wp-admin/options-general.php?page=github&status=success";
    header("Location: " . $redirect_url);
    exit;
}
