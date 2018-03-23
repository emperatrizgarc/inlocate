<?php //xlist_floors_as_options.php  20180313
    
    require 'xsql_connection.php';

    $options = "<option value=''>PISOS</option>"; 

    $sql    = "SELECT  floor_id 
    				  ,floor_name
                      ,floor_description
                      ,creation_date
                      ,updating_date
                FROM floors  
               ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $options .= '<option value =' . $row["floor_id"] . '>'
                                          . $row["floor_name"] . ' ('.$row["floor_description"].')</option>';
        }
    }

    $conn->close();

    echo $options;

    

