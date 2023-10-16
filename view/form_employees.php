<?php

defined('ABSPATH') || exit;
global $title;

?>
<h1 id="headlinethatchanges"><?php echo $title;?></h1>
<form action="" method="post">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label for="first_name">First Name</label>
                </th>
                <td>
                    <input type="text" name="first_name" id="first_name" value="" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="last_name">Last Name</label>
                </th>
                <td>
                    <input type="text" name="last_name" id="last_name" value="" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="n_mission">Mission Count</label>
                </th>
                <td>
                    <input type="number" name="n_mission" id="n_mission" value="" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="weight">Weight (Kg)</label>
                </th>
                <td>
                    <input type="number" step="0.001" name="weight" id="weight" value="" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="birhdate">Birth Date</label>
                </th>
                <td>
                    <input type="date" name="birhdate" id="birhdate" value="" style="width: 30%">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="avatar">Avatar</label>
                </th>
                <td>
                    <input type="url" name="avatar" id="avatar" value="" style="width: 30%">
                    <button type="button" class="button button-secondary" id="employee_avatar_select">Select Avatar</button>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="submit">
        <button class="button button-primary" name="save_employee">Add Employee</button>
    </p>
</form>

