<?php //xlist_users_as_options.php 20180313
    
    require 'xsql_connection.php';

    $options = "<option value=''>USUARIOS</option>"; 

    $sql    = "SELECT  user_id 
    				  ,user_name
                      ,mac_address
                      ,creation_date
                      ,updating_date
                FROM users 
               ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $options .= '<option value =' . $row["user_id"] . '>'
                                          . $row["user_name"] . ' ('.$row["mac_address"].')</option>';
        }
    }

    $conn->close();

    echo $options;

    

