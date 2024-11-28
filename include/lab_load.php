<?php
include("../partials/globle_restriction.php");
if (isset($_POST["start"]) && isset($_POST["limit"])) {
    $start = $_POST['start'];
    $limit = $_POST['limit'];
    $lab_load = $sql->prepare("SELECT lab.*, department.d_name, year.year,year.semester,subject.s_name
    FROM lab
    JOIN department ON lab.department_id = department.id
    JOIN year ON lab.year_id = year.id
    JOIN subject ON lab.subject_id = subject.id
    ORDER BY lab.id DESC
    LIMIT ?,?;
    ");
    $lab_load->bind_param('ss', $start, $limit);
    $lab_load->execute();
    $lab_result = $lab_load->get_result();
    if ($lab_result->num_rows > 0) {
        while ($lab = $lab_result->fetch_assoc()) { ?>
            <tr id="<?php echo $lab["id"]; ?>" class="table_row">
                <td><?php echo $lab["year"].' / '. $lab['semester']; ?></td>
                <td><?php echo $lab["d_name"]; ?></td>
                <td><?php echo $lab["s_name"]; ?></td>
                <td><?php echo ($lab["start_time"] < 12) ? $lab["start_time"] : $lab["start_time"]; ?></td>
                <td><?php echo ($lab["end_time"] < 12) ? $lab["end_time"] : $lab["end_time"]; ?></td>
<!--                 <td><?php echo $lab["task_title"]; ?></td>
                <td><?php echo $lab["task_desc"]; ?></td>
                <td><a href="./<?php echo $lab["task_file"]; ?>" target="_blank">Download / View</a></td> -->
                <td><?php echo $lab["date"]; ?></td>
                <td>
                    <a href="lab-edit.php?lab_id=<?php echo $lab["id"]; ?>"><img class="table_more_img" src="./images/edit.svg" alt="more"></a>
                    <a target="_self" style="cursor: pointer;"><img id="lab_data_remove_btn" src="./images/trash.svg" alt="more"></a>
                </td>
            </tr>
<?php }
    }
}
?>