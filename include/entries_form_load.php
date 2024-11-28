<?php
// include("../partials/globle_restriction.php");
include("../conf/connection.php");

if (isset($_POST["start"]) && isset($_POST["limit"])) {
    $start = $_POST['start'];
    $limit = $_POST['limit'];
    $entries_load = $sql->prepare("SELECT entries.*,users.f_name,users.l_name,TIMEDIFF(out_time, in_time) AS time_difference 
    FROM `entries` 
    JOIN users ON users.user_id = entries.user_id
    ORDER BY e_id DESC LIMIT ?,?");
    $entries_load->bind_param('ss', $start, $limit);
    $entries_load->execute();
    $entries_result = $entries_load->get_result();
    if ($entries_result->num_rows > 0) {
        while ($entries = $entries_result->fetch_assoc()) { ?>
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