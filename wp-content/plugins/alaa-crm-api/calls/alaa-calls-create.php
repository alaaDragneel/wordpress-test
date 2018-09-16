<?php

function alaa_crm_call_create() {
    global $wpdb;
    $table_leads_name = "{$wpdb->prefix}alaa_crm_leads";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST["title"];
        $lead_id = $_POST["lead_id"];
        //insert
        if (isset($_POST['insert'])) {
            $table_name = "{$wpdb->prefix}alaa_crm_calls";
    
            $wpdb->insert(
                    $table_name, //table
                    [ 'title' => $title,  'lead_id' => $lead_id ], //data
                    ['%s', '%s'] //data format			
            );
            
            $message.="Success";
        }
    }
    $leads = $wpdb->get_results("SELECT `id`, `name` from {$table_leads_name}");
   ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/alaa-crm-api/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Call</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">title</th>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" class="ss-field-width" /></td>
                </tr>
     
               <tr>
                    <th class="ss-th-width">Lead</th>
                    <td>
                        <select name="lead_id" class="ss-field-width">
                            <?php foreach ($leads as $lead): ?>
                                <option value="<?= $lead->id ?>">
                                    <?= $lead->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}