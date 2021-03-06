<?php //xlist_all_users.php 20180306
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

    $last_filters =  " building_id
                      ,building_name
                      ,description
                      ,creation_date
                      ,updating_date
                    ";

    $old_filters = explode(",", $last_filters);

    foreach ($old_filters as $key => $value) {
        $_SESSION["xlist_all_buildings.php"][$key] = array('Field' => $value);
    } 

    $sql    = "SELECT $last_filters
                 FROM buildings u 
                WHERE $query
               ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $rows .= '<tr>' . '<td>' . $row["building_id"] . '</td>'
                            . '<td>' . $row["building_name"] . '</td>'
                            . '<td>' . $row["description"] . '</td>'
                            . '<td>' . $row["creation_date"] . '</td>'
                            . '<td>' . $row["updating_date"] . '</td>'
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
                                    <th>ID Edificio</th>
                                    <th>Nombre</th>
                                    <th>Descricíon</th>
                                    <th>Fecha de Creación</th>
                                    <th>Actualización</th>
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

