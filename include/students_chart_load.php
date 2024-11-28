<?php
include("../partials/globle_restriction.php");

    // Assuming your department table has columns 'dept_id' and 'd_name'
    $dept_query = $sql->prepare("SELECT u.dept_id, d.d_name, COUNT(u.user_id) AS student_count, MAX(COUNT(u.user_id)) OVER () AS max_student_count
        FROM users u
        LEFT JOIN department d ON d.id = u.dept_id
        GROUP BY d.id, d.d_name;");
    $dept_result = $dept_query->execute();
    $dept_result = $dept_query->get_result();
    $dept_counts = array();

    while ($dept_row = $dept_result->fetch_assoc()) {
        $max_student_count = $dept_row['max_student_count'];
        $student_count = $dept_row['student_count'];
        $dept_counts[] = array(
            'y' => $student_count,
            'label' => $dept_row['d_name'],
            'exploded' => ($student_count === $max_student_count) // Set 'exploded' to true for the max student count
        );
    }

    // Return the counts as JSON
    header('Content-Type: application/json');
    echo json_encode($dept_counts);
    exit;
?>
