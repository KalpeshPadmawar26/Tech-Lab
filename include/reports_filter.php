<?php
include("../partials/globle_restriction.php");
if (isset($_POST["month"]) && isset($_POST["year"])) {
    $month_data = $_POST['month'];
    $year_data = $_POST['year'];
    $reports_filter = $sql->prepare("SELECT *, TIMEDIFF(out_time, in_time) AS time_difference FROM `entries`
    JOIN users ON users.user_id = entries.user_id
    WHERE MONTH(`in_time`) = ? AND YEAR(`in_time`) = ? ORDER BY e_id;");
    $reports_filter->bind_param('ii', $month_data, $year_data);
    $reports_filter->execute();
    $reports_result = $reports_filter->get_result();
    if ($reports_result->num_rows >= 0) {
        while ($entries = $reports_result->fetch_assoc()) { ?>
            <tr id="<?php echo $entries["e_id"]; ?>" class="table_row">
                <td><?php echo $entries["user_id"]; ?></td>
                <td><?php echo $entries["f_name"].' '.$entries["l_name"]; ?></td>
                <td><?php echo $entries["ip"]; ?></td>
                <td><?php echo $entries["in_time"]; ?></td>
                <td><?php echo $entries["out_time"]; ?></td>
                <td><?php echo $entries["time_difference"]; ?></td>
                <td>
                    <?php echo ($entries["isAttended"] == 0)?"Absent":"Present"; ?>&nbsp;
                    <button class='secondary-btn' id='change-attendance-btn'>Alter</button>
                </td>
                <td>
                    <a target="_self" style="cursor: pointer;"><img id="entries_data_remove_btn" src="./images/trash.svg" alt="more"></a>
                </td>
            </tr>
<?php }
    }
}
?>