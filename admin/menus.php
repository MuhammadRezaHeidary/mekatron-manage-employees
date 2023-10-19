<?php

defined('ABSPATH') || exit;

add_action('admin_menu', 'mme_add_menus');

function mme_add_menus() {

    $list_employees_suffix = add_menu_page(
        "Manage Employees",
        "Employees",
        "manage_options",
        "mme_manage_employees",
        'mme_render_list'
    );

    add_action('load-'.$list_employees_suffix, "mme_process_list");

    $add_employees_suffix = add_submenu_page(
        "mme_manage_employees",
        "Add New Employees",
        "Add Employees",
        "manage_options",
        "mme_manage_employees_new",
        "mme_render_form"
    );

    add_action('load-'.$add_employees_suffix, "mme_process_add_new");

}

function mme_render_list() {
    global $wpdb;
    $table_dbname = $wpdb->prefix.'mme_employees';

    $page = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
    $per_page = 10;
    $limit = $per_page;
    $offset = ($page - 1)*$per_page;
    $employees = $wpdb->get_results(
            "SELECT SQL_CALC_FOUND_ROWS * FROM $table_dbname ORDER BY CreatedDate DESC LIMIT $limit OFFSET $offset"
    ); // return all data
    $found_rows = $wpdb->get_var("SELECT FOUND_ROWS()");
    $total_pages = ceil($found_rows/$per_page);
    include(MEKATRON_MANAGE_EMPLOYEES_VIEW_PATH."list_employees.php");
}

function mme_process_list() {
    global $wpdb;
    $table_dbname = $wpdb->prefix.'mme_employees';

    if(isset($_GET['action'])
        && $_GET['action'] == "delete_employee"
        && isset($_GET['employee_id'])) {

        $employee_id = absint($_GET['employee_id']);

        $format_id = [
            '%d',
        ];
        $delete_action = $wpdb->delete(
            $table_dbname,
            [
                'ID' => $employee_id,
            ],
            $format_id
        );

        if($delete_action) {
            $status = 'deleted';
        }
        else {
            $status = 'deleted_error';
        }
        wp_redirect(admin_url('admin.php?page=mme_manage_employees&mme_status='.$status));
        exit;
    }
    elseif(isset($_GET['action'])
        && $_GET['action'] == "add_mission"
        && isset($_GET['employee_id'])) {

        $employee_id = absint($_GET['employee_id']);

        //wpdb general query test
//        $n_affected_or_selected_rows = $wpdb->query("
//        UPDATE $table_dbname SET Mission = Mission + 1 , Weight = Weight + 0.35 WHERE ( ID = 19 ) OR ( Fname = 'رضا' AND Weight > 70 )
//        ");

        //wpdb general query test
        $add_mission_action = $wpdb->query("
            UPDATE $table_dbname SET Mission = Mission + 1 WHERE ID = $employee_id 
        ");

        if($add_mission_action) {
            $status = 'add';
        }
        else {
            $status = 'add_error';
        }
        wp_redirect(admin_url('admin.php?page=mme_manage_employees&mme_status='.$status));
        exit;
    }
    elseif(isset($_GET['action'])
        && $_GET['action'] == "subtract_mission"
        && isset($_GET['employee_id'])) {

        $employee_id = absint($_GET['employee_id']);

        //wpdb general query test
        $subtract_mission_action = $wpdb->query("
            UPDATE $table_dbname SET Mission = Mission - 1 WHERE ID = $employee_id 
        ");

        if($subtract_mission_action) {
            $status = 'subtract';
        }
        else {
            $status = 'subtract_error';
        }
        wp_redirect(admin_url('admin.php?page=mme_manage_employees&mme_status='.$status));
        exit;
    }

}

function mme_render_form() {
    global $wpdb;
    $table_dbname = $wpdb->prefix.'mme_employees';
    if(isset($_GET['employee_id'])) {
        $employee_id = absint($_GET['employee_id']);
        if($employee_id) {
            $employee = $wpdb->get_row(
                    "SELECT * FROM $table_dbname WHERE ID = $employee_id"
            );
        }
    }
    include(MEKATRON_MANAGE_EMPLOYEES_VIEW_PATH."form_employees.php");
}

function mme_process_add_new() {
    add_action('admin_enqueue_scripts', 'mme_load_scripts');
}

function mme_load_scripts() {
    wp_enqueue_media();
    wp_enqueue_script(
        'mme-form',
        MEKATRON_MANAGE_EMPLOYEES_JS_URL.'form.js',
        [],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER
    );
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

            // get ID from post (for updating)
            $employee_id = absint($_POST['ID']);

            $data = [
                'Fname'                 => sanitize_text_field($_POST['first_name']),
                'Lname'                 => sanitize_text_field($_POST['last_name']),
                'Mission'               => absint($_POST['n_mission']),
                'Weight'                => floatval($_POST['weight']),
                'BirthDate'             => sanitize_text_field($_POST['birhdate']),
                'Avatar'                => esc_url_raw($_POST['avatar']),
            ];

            global $wpdb;
            $table_dbname = $wpdb->prefix.'mme_employees';

            if($employee_id) {

                $format_u = [
                    '%s',
                    '%s',
                    '%d',
                    '%f',
                    '%s',
                    '%s'
                ];

                $format_w = [
                    '%d',
                ];

                $updated_rows = $wpdb->update(
                    $table_dbname,
                    $data,
                    [
                        'ID' => $employee_id,
                    ],
                    $format_u,
                    $format_w
                );

                if($updated_rows === false) {
                    $status = 'update_error';
                    wp_redirect(admin_url('admin.php?page=mme_manage_employees_new&mme_status='.$status.'&mme_id='.$employee_id));
                    exit;
                }
//                elseif($updated_rows === 0) {
//
//                }
                else {
                    $status = 'update';
                    wp_redirect(admin_url('admin.php?page=mme_manage_employees_new&mme_status='.$status.'&mme_id='.$employee_id));
                    exit;
                }
            }
//            else {
//                $data['CreatedDate'] = current_time('mysql');
//            }
            $data['CreatedDate'] = current_time('mysql');


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

            if($inserted2db){
                // @Success
                $employee_id = $wpdb->insert_id;
                $insert_status = 'success';
                // Redirect to admin.php?page=mme_manage_employees_new&mme_status=success&mme_id=1
                wp_redirect(admin_url('admin.php?page=mme_manage_employees_new&mme_status='.$insert_status.'&mme_id='.$employee_id));
            }
            else {
                // @Failed
                $insert_status = 'error';
                // Redirect to admin.php?page=mme_manage_employees_new&mme_status=success&mme_id=1
                wp_redirect(admin_url('admin.php?page=mme_manage_employees_new&mme_status='.$insert_status));
            }
        }
    }
}

add_action('admin_notices', 'mme_notices');

function mme_notices() {
    $type = '';
    $message = '';

    if(isset($_GET['mme_status'])) {
        $status = sanitize_text_field($_GET['mme_status']);
        if($status == 'success') {
            $message = "Employee inserted successfully";
            $type = 'success';
        }
        elseif($status == 'update') {
            $message = "Employee updated successfully";
            $type = 'info';
        }
        elseif($status == 'deleted') {
            $message = "Employee deleted successfully";
            $type = 'warning';
        }
        elseif($status == 'add') {
            $message = "Employee missions increased successfully";
            $type = 'info';
        }
        elseif($status == 'subtract') {
            $message = "Employee missions decreased successfully";
            $type = 'info';
        }
        elseif($status == 'subtract_error') {
            $message = "Error in decreasing employee missions";
            $type = 'error';
        }
        elseif($status == 'add_error') {
            $message = "Error in increasing employee missions";
            $type = 'error';
        }
        elseif($status == 'deleted_error') {
            $message = "Error in deleting employee";
            $type = 'error';
        }
        elseif($status == 'update_error') {
            $message = "Error in updating employee";
            $type = 'error';
        }
        elseif($status == 'error') {
            $message = "Error in inserting employee";
            $type = 'error';
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