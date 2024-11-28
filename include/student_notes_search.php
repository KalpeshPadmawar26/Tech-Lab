<?php
include("../partials/globle_restriction.php");
if (isset($_POST["search_data"])) {
    $search_data = "%" . $_POST['search_data'] . "%";
    $notes_search = $sql->prepare("SELECT 
    notes.*, 
    department.d_name, 
    year.year, 
    year.semester, 
    subject.s_name,
    IF(notes_download.student_id IS NOT NULL, 1, 0) AS is_downloaded
    FROM 
        notes
    JOIN 
        department ON notes.department_id = department.id
    JOIN 
        year ON notes.year_sem_id = year.id
    JOIN 
        subject ON notes.subject_id = subject.id
    JOIN 
        users ON notes.year_sem_id = users.year_id
    LEFT JOIN 
        notes_download ON notes.id = notes_download.notes_id AND users.user_id = notes_download.student_id
    WHERE 
        users.user_id = ?
        AND users.dept_id = notes.department_id
        AND users.year_id = notes.year_sem_id 
        AND (department.d_name LIKE ? OR subject.s_name LIKE ?)
    ORDER BY notes.id");
    $notes_search->bind_param('sss',$_SESSION['user_id'],$search_data, $search_data);
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
                <td><?php switch ($notes["is_downloaded"]) {
                        case '1':
                            echo "Downloaded";
                            break;
                        case '0':
                            echo "<button class='secondary-btn' id='download-btn'>Mark Downloaded</button>";
                            break;
                        default:
                            echo "Unknown";
                            break;
                    } ?>
                </td>
                <td><?php echo $notes["time"]; ?></td>
            </tr>
<?php }
    }
}
?>