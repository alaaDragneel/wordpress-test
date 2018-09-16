<?php

function alaa_crm_call_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/alaa-crm-api/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Calls</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=alaa_crm_call_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
            // Global WorPress
            global $wpdb;
            $table_name = "{$wpdb->prefix}alaa_crm_calls";
            $table_leads_name = "{$wpdb->prefix}alaa_crm_leads";

            $rows = $wpdb->get_results(
                "SELECT 
                    {$table_name}.*, 
                    {$table_leads_name}.* 
                FROM 
                    {$table_name}
                INNER JOIN 
                    {$table_leads_name}
                ON 
                    {$table_leads_name}.id = {$table_name}.lead_id"
            );
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Title</th>
                <!-- <th class="manage-column ss-list-width">Email</th> -->
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->title; ?></td>
                    <!-- <td class="manage-column ss-list-width"><?php echo $row->email; ?></td> -->
                    <td><a href="<?php echo admin_url("admin.php?page=alaa_crm_call_update&id={$row->id}"); ?>">Update</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php
}