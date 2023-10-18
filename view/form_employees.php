<?php

defined('ABSPATH') || exit;
global $title;
$id = 0;
$Fname = '';
$Lname = '';
$mission = 0;
$weight = 0.0;
$birth_date = '';
$avatar = '';

if($employee) {
    $id = $employee->ID;
    $Fname = $employee->Fname;
    $Lname = $employee->Lname;
    $mission = $employee->Mission;
    $weight = $employee->Weight;
    $birth_date = $employee->BirthDate;
    $avatar = $employee->Avatar;
}


?>
<h1 id="headlinethatchanges"><?php echo $Fname ? 'Update Employee': $title;?></h1>
<form action="" method="post">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label for="first_name">First Name</label>
                </th>
                <td>
                    <input type="text" name="first_name" id="first_name" value="<?php echo esc_attr($Fname);?>" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="last_name">Last Name</label>
                </th>
                <td>
                    <input type="text" name="last_name" id="last_name" value="<?php echo esc_attr($Lname);?>" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="n_mission">Mission Count</label>
                </th>
                <td>
                    <input type="number" name="n_mission" id="n_mission" value="<?php echo esc_attr($mission);?>" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="weight">Weight (Kg)</label>
                </th>
                <td>
                    <input type="number" step="0.001" name="weight" id="weight" value="<?php echo esc_attr($weight);?>" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="birhdate">Birth Date</label>
                </th>
                <td>
                    <input type="date" name="birhdate" id="birhdate" value="<?php echo esc_attr($birth_date);?>" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="avatar">Avatar</label>
                </th>
                <td>
                    <input type="url" name="avatar" id="avatar" value="<?php echo esc_attr($avatar);?>" style="width: 30%">
                    <button type="button" class="button button-secondary button-add-media" id="employee_avatar_select">Select Avatar</button>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="submit">
        <input type="hidden" name="ID" value="<?php echo esc_attr($id);?>">
        <button class="button button-primary" name="save_employee">
            <?php echo $employee ? "Update" : "Create" ?>
        </button>
    </p>
</form>

