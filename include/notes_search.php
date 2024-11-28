<?php
include("../partials/globle_restriction.php");
if (isset($_POST["search_data"])) {
    $search_data = "%" . $_POST['search_data'] . "%";
    $notes_search = $sql->prepare("SELECT notes.*, department.d_name, year.year,year.semester,subject.s_name
    FROM notes
    JOIN department ON notes.department_id = department.id
    JOIN year ON notes.year_sem_id = year.id
    JOIN subject ON notes.subject_id = subject.id
    WHERE `d_name` LIKE ? OR `s_name` LIKE ? ORDER BY id;");
    $notes_search->bind_param('ss', $search_data, $search_data);
    $notes_search->execute();
    $notes_result = $notes_search->get_result();
    if ($notes_result->num_rows >= 0) {
        while ($notes = $notes_result->fetch_assoc()) { ?>
            <tr id="<?php echo $notes["id"]; ?>" class="table_row">
                <td><?php echo $notes["year"].' / '. $notes['semester']; ?></td>
                <td><?php echo $notes["d_name"]; ?></td>
                <td><?php echo $notes["s_name"]; ?></td>
                <td><div style="max-height: 200px;overflow-y: scroll;"><?php echo $notes["notes"]; ?></div></td>
                <td><a href="./<?php echo $notes["notes_file"]; ?>" target="_blank">Download / View</a></td>
                <td><?php echo $notes["time"]; ?></td>
                <td>
                    <a href="notes-edit.php?notes_id=<?php echo $notes["id"]; ?>"><img class="table_more_img" src="./images/edit.svg" alt="more"></a>
                    <a target="_self" style="cursor: pointer;"><img id="notes_data_remove_btn" src="./images/trash.svg" alt="more"></a>
                </td>
            </tr>
<?php }
    }
}
?>