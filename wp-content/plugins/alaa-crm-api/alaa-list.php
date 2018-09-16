<?php

function alaa_crm_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/alaa-crm-api/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Leads</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=alaa_crm_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
            // Global WorPress
            global $wpdb;
            $table_name = "{$wpdb->prefix}alaa_crm_leads";

            $rows = $wpdb->get_results("SELECT `id`, `name`, `email` from {$table_name}");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Name</th>
                <th class="manage-column ss-list-width">Email</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->email; ?></td>
                    <td><a href="<?php echo admin_url("admin.php?page=alaa_crm_update&id={$row->id}"); ?>">Update</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php
}