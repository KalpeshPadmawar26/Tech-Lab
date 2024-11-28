<?php

include('./conf/connection.php');
// Function to generate random user_id
function getRandomUserId() {
    $userIds = [1, 9, 11];
    return $userIds[array_rand($userIds)];
}

// Function to generate random IP address
function getRandomIp() {
    return long2ip(mt_rand());
}

// Function to generate random timestamp within a date range
function getRandomTimestamp($start, $end) {
    $randomTimestamp = mt_rand(strtotime($start), strtotime($end));
    return date('Y-m-d H:i:s', $randomTimestamp);
}
function getRandomTimestampAfter($referenceTimestamp) {
    // Check if $referenceTimestamp is '23:59:59'
    if (substr($referenceTimestamp, 11) === '23:59:59') {
        return $referenceTimestamp;
    }

    $endTime = strtotime(date('Y-m-d 23:59:59', strtotime($referenceTimestamp)));
    
    // Generate a random timestamp until it's after $referenceTimestamp
    do {
        $randomTimestamp = mt_rand(strtotime($referenceTimestamp), $endTime);
    } while ($randomTimestamp <= strtotime($referenceTimestamp));

    return date('Y-m-d H:i:s', $randomTimestamp);
}
// Function to insert random data into the 'entries' table
function insertRandomData($sql) {
    $userId = getRandomUserId();
    $ip = getRandomIp();
    $inTime = getRandomTimestamp('2020-01-01', date('Y-m-d'));
    $outTime = getRandomTimestampAfter($inTime);

    $sql_cron = $sql->prepare("INSERT INTO `entries`(`user_id`, `ip`, `in_time`, `out_time`) VALUES (?, ?, ?, ?)");
    $sql_cron->bind_param('ssss', $userId, $ip, $inTime, $outTime);
    $sql_cron->execute();

    echo "Data Inserted.";
}

// Insert random data into the 'entries' table
for($i=0;$i<100;$i++){
    echo $i;
    insertRandomData($sql);
}

?>
