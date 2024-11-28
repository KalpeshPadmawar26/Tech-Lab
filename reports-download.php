<?php

// Load the database configuration file 
include 'conf/connection.php';

// Fetch records from database 
$entries_form_sql = $sql->prepare("SELECT entries.*,TIMEDIFF(out_time, in_time) AS time_difference,users.f_name,users.l_name,users.mobile,users.email,users.enrollment_id,users.PRN,
department.d_name,year.year,year.semester 
FROM `entries` 
JOIN users ON users.user_id = entries.user_id
JOIN department ON users.dept_id = department.id
JOIN year ON users.year_id = year.id
ORDER BY e_id DESC");
$entries_form_sql->execute();
$entries_form_result = $entries_form_sql->get_result();

if ($entries_form_result->num_rows > 0) {
    $delimiter = ",";
    $filename = "reports-data_" . date('Y-m-d') . ".csv";

    // Create a file pointer 
    $f = fopen('php://memory', 'w');

    // Set column headers 
    $fields = array('ID', 'NAME', 'MOBILE', 'EMAIL', 'DEPARTMENT', 'YEAR', 'ENROLLMENT', 'PRN', 'IP', 'IN_TIME', 'OUT_TIME', 'TOTAL_TIME', 'ATTENDANCE');
    fputcsv($f, $fields, $delimiter);

    // Output each contact_form of the data, format line as csv and write to file pointer 
    while ($entries_form = $entries_form_result->fetch_assoc()) {
        $attendance = ($entries_form['isAttended'] == 1) ? 'Present' : 'Absent';
        $lineData = array($entries_form['e_id'],$entries_form['f_name'].' '.$entries_form['l_name'],$entries_form['mobile'],$entries_form['email'],$entries_form['d_name'],'Year '.$entries_form['year'].'/ Semester '.$entries_form['semester'],$entries_form['enrollment_id'],$entries_form['PRN'],$entries_form['ip'],$entries_form['in_time'],$entries_form['out_time'],$entries_form['time_difference'],$attendance);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file 
    fseek($f, 0);

    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer 
    fpassthru($f);
}
exit;
