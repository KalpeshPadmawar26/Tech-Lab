<?php
include("../partials/globle_restriction.php");
if (isset($_POST["search_data"])) {
    $search_data = "%" . $_POST['search_data'] . "%";
    $user_load = $sql->prepare("SELECT users.*, department.d_name, year.year,year.semester
    FROM users
    JOIN department ON users.dept_id = department.id
    JOIN year ON users.year_id = year.id
    WHERE `f_name` LIKE ? OR `m_name` LIKE ? OR `l_name` LIKE ? OR `email` LIKE ? OR `mobile` LIKE ? OR `enrollment_id` LIKE ? ORDER BY user_id;");
    $user_load->bind_param('ssssss', $search_data, $search_data, $search_data, $search_data, $search_data, $search_data);
    $user_load->execute();
    $user_result = $user_load->get_result();
    if ($user_result->num_rows >= 0) {
        while ($user = $user_result->fetch_assoc()) { ?>
            <tr id="<?php echo $user["user_id"]; ?>" class="table_row">
                <td><?php echo $user["f_name"].' '.$user["m_name"].' '.$user["l_name"]; ?></td>
                <td><?php echo $user["email"]; ?></td>
                <td><?php echo $user["mobile"]; ?></td>
                <td>
                    <div class="image-input-preview-img-area">
                        <?php $location2 = $user["user_img"]; ?>
                        <img src="<?php echo $location2; ?>" alt="Image" class="image-input-preview-img" id="image-input-preview-img">
                    </div>
                </td>
                <td><?php switch ($user["gender"]) {
                        case '1':
                            echo "Male";
                            break;
                        case '2':
                            echo "Female";
                            break;
                        case '3':
                            echo "Other";
                            break;
                        default:
                            echo "Unknown";
                            break;
                    } ?></td>
                <td><?php echo $user["enrollment_id"]; ?></td>
                <td><?php echo $user["PRN"]; ?></td>
                <td><?php echo $user["d_name"]; ?></td>
                <td><?php echo "Year ".$user["year"]." / Sem ".$user["semester"]; ?></td>
                <td><?php switch ($user["role"]) {
                        case '1':
                            echo "Admin";
                            break;
                        case '2':
                            echo "Student";
                            break;
                        default:
                            echo "Unknown";
                            break;
                    } ?>
                </td>
                <td><?php switch ($user["status"]) {
                        case '1':
                            echo "Active";
                            break;
                        case '0':
                            echo "Suspended";
                            break;
                        default:
                            echo "Unknown";
                            break;
                    } ?>
                </td>
                <td><?php switch ($user["isVerified"]) {
                        case '1':
                            echo "Verified";
                            break;
                        case '0':
                            echo "<button class='secondary-btn' id='verify-btn'>Verify</button>";
                            break;
                        default:
                            echo "Unknown";
                            break;
                    } ?>
                </td>
                <td>
                    <a href="user-edit.php?user_id=<?php echo $user["user_id"]; ?>"><img class="table_more_img" src="./images/edit.svg" alt="more"></a>
                    <a target="_self" style="cursor: pointer;"><img id="user_data_remove_btn" src="./images/trash.svg" alt="more"></a>
                </td>
            </tr>
<?php }
    }
}
?>