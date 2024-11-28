<?php
include("../partials/globle_restriction.php");
if (isset($_POST["search_data"])) {
    $search_data = "%" . $_POST['search_data'] . "%";
    $reports_search = $sql->prepare("SELECT entries.*,users.f_name,users.l_name,TIMEDIFF(out_time, in_time) AS time_difference FROM `entries`
    JOIN users ON users.user_id = entries.user_id
    WHERE `ip` LIKE ? OR `f_name` LIKE ? OR `l_name` LIKE ? ORDER BY e_id;");
    $reports_search->bind_param('sss', $search_data, $search_data, $search_data);
    $reports_search->execute();
    $reports_result = $reports_search->get_result();
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