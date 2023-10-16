<?php
//global $wpdb;
//$table_dbname = $wpdb->prefix.'mme_employees';
//$id = 11;

/*
#############################################################################################
                                            get_var
#############################################################################################
*/
/*
 * Use get_var to get a single variable form the database
 */
//$result = $wpdb->get_var("SELECT Lname FROM $table_dbname WHERE ID = $id"); // return specific value
//$result = $wpdb->get_var("SELECT * FROM $table_dbname"); // return first value
//$result = $wpdb->get_var("SELECT * FROM $table_dbname", 1, 1); // return first value after offset col 1 row 1
//print_r($result);

//$result2 = $wpdb->get_var("SELECT Mission FROM $table_dbname WHERE ID = $id"); // return first value after offset col 1 row 1
//$result2_message = '';
//if($result2) {
//    $result2_message = $result2 . ' missions';
//}
//elseif ($result2 === NULL) {
//    $result2_message = 'no records';
//}
//else {
//    $result2_message = 'no missions';
//}
//
//print_r(PHP_EOL.$result2_message.PHP_EOL);

/*
#############################################################################################
                                            get_row
#############################################################################################
*/
/*
 * Use get_row to get a row data form the database
 */
//$result = $wpdb->get_row("SELECT * FROM $table_dbname WHERE ID = $id"); // return specific row
//$result = $wpdb->get_row("SELECT * FROM $table_dbname"); // return first row

//$result = $wpdb->get_row("SELECT * FROM $table_dbname", OBJECT,2); // return first row after offset 2 (output type: object) -> default type
//print_r($result->BirthDate); // Used for object type

//$result = $wpdb->get_row("SELECT * FROM $table_dbname", ARRAY_A,2); // return first row after offset 2 (output type: array_a)
//print_r($result['BirthDate']); // Used for array_a type

//$result = $wpdb->get_row("SELECT * FROM $table_dbname", ARRAY_N,2); // return first row after offset 2 (output type: array_n)
//print_r($result[3]); // Used for array_a type

//print_r($result);


/*
#############################################################################################
                                            get_col
#############################################################################################
*/
/*
 * Use get_col to get a col data form the database
 */
//$result = $wpdb->get_col("SELECT Fname FROM $table_dbname"); // return specific col
//$result = $wpdb->get_col("SELECT * FROM $table_dbname"); // return first col
//$result = $wpdb->get_col("SELECT * FROM $table_dbname", 4); // return first col after offset 4

//print_r($result);


/*
#############################################################################################
                                        get_results
#############################################################################################
*/
//$result = $wpdb->get_results("SELECT * FROM $table_dbname"); // return all data
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", OBJECT); // return all data (output type: object) -> default type
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", OBJECT_K); // return all data (output type: object_k)
//$result = $wpdb->get_results("SELECT * FROM $table_dbname ORDER BY ID DESC", OBJECT_K); // return all data descending ID (output type: object_k)
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", ARRAY_A); // return all data (output type: array_a)
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", ARRAY_N); // return all data (output type: array_n)

//print_r($result);

//exit;

?>
<br>
<?php ?>
<style>
    .mme-center {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
    }

    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #ddd;
        padding: 2px;
        text-align: center;
    }

    tr:nth-child(even){background-color: #f2f2f2;}
    tr:nth-child(odd){background-color: #ffffff;}

    tr:hover {background-color: #ddd;}

    th {
        padding-top: 8px;
        padding-bottom: 8px;
        background-color: #04AA6D;
        color: white;
    }
</style>

<h2>Employees</h2>

<div class="mme-center">
<!--    <table class="widefat">-->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mission Count</th>
                <th>Weight</th>
                <th>Birth Date</th>
                <th>Creation Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($employees):
                    foreach ($employees as $employee):
            ?>
            <tr>
                <th scope="row"><?php echo $employee->ID;?></th>
                <td><a href="<?php echo admin_url("admin.php?page=mme_manage_employees&id=$employee->ID"); ?>"><?php echo $employee->Fname . ' ' . $employee->Lname;?></a></td>
                <td><?php echo $employee->Mission;?></td>
                <td><?php echo $employee->Weight;?></td>
                <td><?php echo $employee->BirthDate;?></td>
                <td><?php echo $employee->CreatedDate;?></td>
            </tr>
            <?php
                endforeach;
                else:
            ?>
            <tr>
                <td colspan="6">
                    ############### No data is available ###############
                </td>
            </tr>
            <?php

                endif;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mission Count</th>
                <th>Weight</th>
                <th>Birth Date</th>
                <th>Creation Date</th>
            </tr>
        </tfoot>
    </table>
</div>




