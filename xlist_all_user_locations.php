<?php //xlist_all_user_locations.php 20180227
    session_start();
    require 'xsql_connection.php';
    include 'xphp_functions.php';

    $filters = $_POST["filters"];
    $what    = $_POST["what"];
    $data    = array();
    $rows    = "";
    $query   = "";
    $default = ""; 

    if ($what != "all" && $what != "") {
        $query   = form_sql_filters_conditions($filters);
    } else {
        $query = "true ORDER BY creation_date DESC LIMIT 5";

        $default = '<div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>
                            <span class="fa fa-info-circle"></span> POR DEFECTO,
                        </strong> inLocate carga los <strong>ÚLTIMOS 5 REGISTROS</strong>. 
                        Si la salida está limpia, entonces no hay elementos que cumplan con la condición.
                    </div>';
    }

    $last_filters =  " u.user_id
                      ,u.user_name
                      ,u.mac_address
                      ,ul.x_location
                      ,ul.y_location
                      ,ul.creation_date
                    ";

    $old_filters = explode(",", $last_filters);

    foreach ($old_filters as $key => $value) {
        $_SESSION["xlist_all_user_locations.php"][$key] = array('Field' => $value);
    } 

    $sql    = "SELECT $last_filters
                 FROM user_locations ul
                      inner join users u on u.user_id = ul.user_id
                WHERE $query
               ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $rows .= '<tr>' . '<td>' . $row["user_id"] . '</td>'
                            . '<td>' . $row["user_name"] . '</td>'
                            . '<td>' . $row["mac_address"] . '</td>'
                            . '<td>' . $row["x_location"] . '</td>' 
                            . '<td>' . $row["y_location"] . '</td>'   
                            . '<td>' . $row["creation_date"] . '</td>'
                   . '</tr>'
                ;
        }
    }

    $resulting_table = '<!-- START DEFAULT DATATABLE -->
                        '.$default.'
                        <table id="datatable-responsive" 
                               class="table table-striped table-bordered dt-responsive nowrap" 
                               cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID Usuario</th>
                                    <th>Nombre</th>
                                    <th>MAC Address</th>
                                    <th>Posición X</th>
                                    <th>Posición Y</th>
                                    <th>Creación</th>
                                </tr>
                            </thead>
                            <tbody>'.
                                $rows
                                    .'
                            </tbody>
                        </table>
                        <!-- END DEFAULT DATATABLE -->
                        ';


    $data["answer"] = '' . $resulting_table;

    $conn->close();

    if ($what != "all" && $what != "") {
        echo json_encode($data);    
    } else {
        echo $data["answer"];
    }

