<?php //xshow_query_filters.php
    session_start();
    require 'xsql_connection.php'; 

    $session  = $_POST['function'];
    $data     = array();
    $filters  = "";
    $date     = "";
    $dates    = "";
    $counter  = 0;

    $function    = "search_anywhere_info('$session', 'yes')";
    $old_filters = $_SESSION[$session];

    foreach ($old_filters as $key => $value) {

        $value['Field'] = trim($value['Field']);

        if (strpos($value['Field'], ".") !== false) {
            $name = explode(".", $value['Field'])[1];
        } else {
            $name = $value['Field'];
        }

        $name_user = str_replace("_", " ", $name);

        if (strpos($value['Field'], "date") !== false) {

            $date         = " datepicker";
            $dates       .= '$("#'.$name.'").datepicker();'; 
        }

        $filters .= '<div class="form-group">
                        <div class="col-md-6">
                            <input type="text" 
                                   class="form-control '.$date.'"
                                   id="'.$name.'"
                                   name="'.$value['Field'].'"
                                   placeholder="'.$name_user.'" 
                                   value=""/>
                        </div>
                     </div>';
    }

    $filters .= '<div class="form-group">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control '.$date.'" id="start_date_eu" name="start_date_eu" placeholder="start_date" value=""/>
                            <span class="input-group-addon add-on"> - </span>
                            <input type="text" class="form-control '.$date.'" id="end_date_eu" name="end_date_eu" placeholder="end_date" value=""/>
                        </div>
                    </div>
                  </div>';

    $details = '<div class="col-md-12">
                    <div class="x_panel">
                        <form class="form-horizontal" 
                              role="form" 
                              id="query_filters_form"
                              name="query_filters_form"
                              >
                            <div class="x_title">
                                <h3><strong>Filtros</strong></h3>
                                <ul class="class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="'.$function.';">
                                            <span class="fa fa-search"></span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body" id="query_filters">                                  
                                '.$filters.'                                                                         
                            </div>
                        </form>
                    </div> 
                </div>';

    $js = '<script type="text/javascript">
              $("#start_date_eu").datepicker();
              $("#end_date_eu").datepicker();
              '.$dates.'
          </script>';
    
    $data['answer'] = '<hr>' . $js . $details;

    $conn->close();
    
    echo json_encode($data);

    

