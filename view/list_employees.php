<?php
global $wpdb;
$table_dbname = $wpdb->prefix.'mme_employees';
$id = 11;


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

$result2 = $wpdb->get_var("SELECT Mission FROM $table_dbname WHERE ID = $id"); // return first value after offset col 1 row 1
$result2_message = '';
if($result2) {
    $result2_message = $result2 . ' missions';
}
elseif ($result2 === NULL) {
    $result2_message = 'no records';
}
else {
    $result2_message = 'no missions';
}

print_r(PHP_EOL.$result2_message.PHP_EOL);

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
$result = $wpdb->get_results("SELECT * FROM $table_dbname"); // return all data
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", OBJECT); // return all data (output type: object) -> default type
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", OBJECT_K); // return all data (output type: object_k)
//$result = $wpdb->get_results("SELECT * FROM $table_dbname ORDER BY ID DESC", OBJECT_K); // return all data descending ID (output type: object_k)
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", ARRAY_A); // return all data (output type: array_a)
//$result = $wpdb->get_results("SELECT * FROM $table_dbname", ARRAY_N); // return all data (output type: array_n)

print_r($result);

exit;

?>
<div>

</div>
<?php

