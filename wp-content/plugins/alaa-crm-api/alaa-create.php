<?php

function alaa_crm_create() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST["email"];
        $name = $_POST["name"];
        //insert
        if (isset($_POST['insert'])) {
            global $wpdb;
            $table_name = "{$wpdb->prefix}alaa_crm_leads";
    
            $wpdb->insert(
                    $table_name, //table
                    [ 'email' => $email,  'name' => $name ], //data
                    ['%s', '%s'] //data format			
            );
            
            $message.="Success";
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/alaa-crm-api/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Lead</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Lead</th>
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="ss-field-width" /></td>
                </tr>
     
               <tr>
                    <th class="ss-th-width">Email</th>
                    <td><input type="text" name="email" value="<?php echo $email; ?>" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}