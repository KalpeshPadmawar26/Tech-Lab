<?php
include("../partials/globle_restriction.php");
if (isset($_POST["year"])) {
    $year_data = $_POST['year'];
    // Fetch entry counts for each month in the given year
    $count_query = $sql->prepare("SELECT COUNT(*) AS entry_count, MONTHNAME(`in_time`) AS month
    FROM `entries`
    WHERE YEAR(`in_time`) = ?
    GROUP BY MONTH(`in_time`);");
    $count_query->bind_param('i', $year_data);
    $count_query->execute();
    $count_result = $count_query->get_result();
    $month_counts = array();

    // Initialize the array with counts for all months set to 0
    $all_months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    foreach ($all_months as $month_name) {
        $month_counts[] = array(
            'y' => 0,
            'label' => $month_name
        );
    }

    while ($count_row = $count_result->fetch_assoc()) {
        // Update the count for the existing month
        $month_name = $count_row['month'];
        $index = array_search($month_name, array_column($month_counts, 'label'));
        
        if ($index !== false) {
            $month_counts[$index]['y'] = $count_row['entry_count'];
            $month_counts[$index]['label'] = $month_name." ".$year_data;
        }
    }

    // Return the counts as JSON
    header('Content-Type: application/json');
    echo json_encode($month_counts);
    exit;
}
?>