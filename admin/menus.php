<?php

defined('ABSPATH') || exit;

add_action('admin_menu', 'mme_add_menus');

function mme_add_menus() {

    add_menu_page(
        "Manage Employees",
        "Employees",
        "manage_options",
        "mme_manage_employees",
        'mme_render_list'
    );

    add_submenu_page(
        "mme_manage_employees",
        "Add New Employees",
        "Add Employees",
        "manage_options",
        "mme_manage_employees_new",
        function () {
            include(MEKATRON_MANAGE_EMPLOYEES_VIEW_PATH."form_employees.php");
        }
    );

}

function mme_render_list() {
    global $wpdb;
    $table_dbname = $wpdb->prefix.'mme_employees';
    $employees = $wpdb->get_results("SELECT * FROM $table_dbname ORDER BY CreatedDate DESC"); // return all data
    include(MEKATRON_MANAGE_EMPLOYEES_VIEW_PATH."list_employees.php");
}

/*
 *1) Action after all admin requirements(pages, database, menus and etc.) initialized
 *2) This action will affect on all admin pages
 *3) It is better to use admin menu suffix load hook action
 *4) $mme_employees_admin_suffix = add_menu_page(...);
 *5) add_action('load-'.$mme_employees_admin_suffix, function () {});
 */
add_action('admin_init', 'mme_form_submit');

function mme_form_submit()
{
    // Check page is "mme_manage_employees_new" page
    global $pagenow;
    if ($pagenow === 'admin.php' && isset($_GET['page']) && $_GET['page'] === "mme_manage_employees_new") {
        if(isset($_POST['save_employee'])) {
            $data = [
                'Fname'                 => sanitize_text_field($_POST['first_name']),
                'Lname'                 => sanitize_text_field($_POST['last_name']),
                'Mission'               => absint($_POST['n_mission']),
                'Weight'                => floatval($_POST['weight']),
                'BirthDate'             => sanitize_text_field($_POST['birhdate']),
                'Avatar'                => esc_url_raw($_POST['avatar']),
                'CreatedDate'           => current_time('mysql')
            ];

            global $wpdb;
            $table_dbname = $wpdb->prefix.'mme_employees';

            $format = [
                '%s',
                '%s',
                '%d',
                '%f',
                '%s',
                '%s',
                '%s'
            ];

            $inserted2db = $wpdb->insert(
                $table_dbname,
                $data,
                $format
            );

            $insert_status = '';
            if($inserted2db){
                // @Success
                $employee_id = $wpdb->insert_id;
                $insert_status = 'success';
                // Redirect to admin.php?page=mme_manage_employees_new&mme_inserted=success&mme_id=1
                wp_redirect(admin_url('admin.php?page=mme_manage_employees_new&mme_inserted='.$insert_status.'&mme_id='.$employee_id));
            }
            else {
                // @Failed
                $insert_status = 'error';
                // Redirect to admin.php?page=mme_manage_employees_new&mme_inserted=success&mme_id=1
                wp_redirect(admin_url('admin.php?page=mme_manage_employees_new&mme_inserted='.$insert_status));
            }
        }
    }
}

add_action('admin_notices', 'mme_notices');

function mme_notices() {
    $type = '';
    $message = '';

    if(isset($_GET['mme_inserted'])) {
        $status = sanitize_text_field($_GET['mme_inserted']);
        if($status == 'success') {
            $message = "Employee inserted successfully";
            $type = $status;
        }
        else if($status == 'error') {
            $message = "Error in inserting employee";
            $type = $status;
        }
    }

    if($type && $message) {
        ?>
        <div class="notice notice-<?php echo $type;?> is-dismissible">
            <p><?php echo $message;?></p>
        </div>
        <?php
    }

}