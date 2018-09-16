<?php

function alaa_crm_update() {
    global $wpdb;

    $table_name = $wpdb->prefix . "alaa_crm_leads";
    $id = $_GET["id"];
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    //update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                ['name' => $name, 'email' => $email], //data
                ['id' => $id], //where
                ['%s', '%s'], //data format
                ['%s'] //where format
        );
    }
    //delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $Leads = $wpdb->get_results($wpdb->prepare("SELECT `id`, `name`, `email` from $table_name where id=%s", $id));
        foreach ($Leads as $s) {
            $name = $s->name;
            $email = $s->email;
        }
    }

    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/alaa-crm-api/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Leads</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Lead deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=alaa_crm_list') ?>">&laquo; Back to Leads list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Lead updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=alaa_crm_list') ?>">&laquo; Back to Leads list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Name</th><td><input type="text" name="name" value="<?php echo $name; ?>"/></td></tr>
                    <tr><th>Email</th><td><input type="text" name="email" value="<?php echo $email; ?>"/></td></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('&iquest;Danger&aacute; Are You Sure')">
            </form>
        <?php } ?>

    </div>
    <?php
}