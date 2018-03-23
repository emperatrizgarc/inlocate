<?php //xlist_all_users.php 20180306
    session_start();
    require 'xsql_connection.php';
    include 'xphp_functions.php';

    $data = array();
    $row  = "";
    $rows = "";   

    $floor_name  = $_POST['floor_name'];
    $description 	= $_POST['description'];
    $creation_date  = date('Y-m-d H:i:s');

    $sql = "INSERT INTO floors (
                                     floor_name
                                    ,floor_description
                                    ,creation_date
                                 )
                          VALUES (
                                   '".$floor_name."'
                                  ,'".$description."'
                                  ,'".$creation_date."'
                                 )
            ";

    if ($conn->query($sql) === true) {

        $last_id = $conn->insert_id;

        $sql    = "SELECT  floor_id
                          ,floor_name
                          ,floor_description 
                          ,creation_date
                          ,updating_date
                    FROM  floors
                    WHERE floor_id = '$last_id'
                   ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
   
            while ($row = $result->fetch_assoc()) {

                $details = '<div class="x_panel">
			                  <div class="x_title">
			                    <h2>Resultados <small>de registro</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li>
			                      	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li class="dropdown">
			                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			                          <i class="fa fa-wrench"></i>
			                        </a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <p class="text-muted font-13 m-b-30">
			                      <div class="alert alert-success alert-dismissible fade in" role="alert">
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
				                    </button>
				                    <strong>¡Operación Exitosa!</strong> Data insertada correctamente.
				                  </div>
			                    </p>
			                    <div>
			                      <br />
			                      <form id="floor_fieldsx" 
			                            name="floor_fieldsx" data-parsley-validate class="form-horizontal form-label-left">
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="floor_id">ID Piso<span class="required">*</span>
			                          </label>
			                          <div class="col-md-6 col-sm-6 col-xs-12">
			                            <input type="text" 
			                                   id="floor_id"
			                                   value="'.$row["floor_id"].'"
			                                   readonly 
			                                   required="required" class="form-control col-md-7 col-xs-12">
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="floor_name">Nombre de Piso <span class="required">*</span>
			                          </label>
			                          <div class="col-md-6 col-sm-6 col-xs-12">
			                            <input type="text" 
			                                   id="floor_name"
			                                   value="'.$row["floor_name"].'" 
			                                   required="required" class="form-control col-md-7 col-xs-12">
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="floor_name">Descripción Edificio <span class="required"></span>
			                          </label>
			                          <div class="col-md-6 col-sm-6 col-xs-12">
			                            <input type="text" 
			                                   id="description" 
			                                   name="description"
			                                   value="'.$row["description"].'"  
			                                   required="required" 
			                                   class="form-control col-md-7 col-xs-12">
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="creation_date">Fecha Creación <span class="required"></span>
			                          </label>
			                          <div class="col-md-6 col-sm-6 col-xs-12">
			                            <input type="text" 
			                                   id="creation_date" 
			                                   name="creation_date"
			                                   value="'.$row["creation_date"].'"  
			                                   required="required" 
			                                   class="form-control col-md-7 col-xs-12">
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="updating_date">Fecha Actualización <span class="required"></span>
			                          </label>
			                          <div class="col-md-6 col-sm-6 col-xs-12">
			                            <input type="text" 
			                                   id="updating_date" 
			                                   name="updating_date"
			                                   value="'.$row["updating_date"].'"  
			                                   required="required" 
			                                   class="form-control col-md-7 col-xs-12">
			                          </div>
			                        </div>
			                        <div class="ln_solid"></div>
			                        <div class="form-group">
			                          <hr>
			                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			                          	<button type="btn btn-danger" 
			                                    class="btn btn-danger" 
			                                    onclick="delete_floor();">Eliminar</button>
			                            <button type="btn btn-warning" 
			                                    class="btn btn-warning" 
			                                    onclick="update_floor();">Actualizar</button>
			                          </div>
			                        </div>
			                      </form>  
			                    </div>
			                  </div>
				            </div>';
            }
            $data['answer'] = $details;
        }

    } else {
        $data['answer'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
		                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                    	<span aria-hidden="true">×</span>
		                    </button>
		                    <strong>¡Operación fallida!</strong> No pudo insertarse la data...
		                  </div>';
    }

    echo json_encode($data);

    $conn->close();

