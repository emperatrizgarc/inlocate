<?php //xcount_users.php 20180320
    require 'xsql_connection.php';

    $sql    = "SELECT count(user_id) as nusers
                FROM users 
               ";

    $result = $conn->query($sql);

    $data   = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data["answer"] = $row["nusers"];
        }
    }
    $conn->close();

    echo json_encode($data);

    

