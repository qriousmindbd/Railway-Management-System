<?php
// Function to check duplicate value insert in a table
function isDuplicateValue($valueToCheck, $condition = '', $tableName, $conn) {
    // Prepare the SQL query
    if (isset($condition)) {
        $sql = "SELECT COUNT(*) AS count FROM $tableName WHERE $condition = ?";
    } else {
        $sql = "SELECT COUNT(*) AS count FROM $tableName";
    }
    $stmt = $conn->prepare($sql);

    // Bind the parameter and execute the query
    $stmt->bind_param("s", $valueToCheck);
    $stmt->execute();

    // Get the result and check if the value exists
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row["count"];

    // Close the statement
    $stmt->close();

    // Return true if the value exists, false otherwise
    return $count > 0;
}

function getLastIdValue($columnName, $tableName, $conn){
    $lastid_query = "SELECT MAX($columnName) AS last_id FROM $tableName";
    $result = $conn->query($lastid_query);

    return mysqli_fetch_assoc($result)['last_id'];
}

?>