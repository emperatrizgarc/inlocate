<?php //update_building.php 20180306
    session_start();
    require 'xsql_connection.php';
    include 'xphp_functions.php';

    $data = array();
    $row  = "";
    $rows = "";   

    $building_id    = $_POST['building_id'];
    $building_name  = $_POST['building_name'];
    $description 	= $_POST['description'];
    $creation_date  = date('Y-m-d H:i:s');

    $sql = "UPDATE  buildings
               SET  building_name   = '$building_name'
                   ,description     = '$description'
                   ,updating_date   = '$creation_date'
             WHERE building_id = '$building_id'
           ";

    if ($conn->query($sql) === true) {

        $sql    = "SELECT  building_id
                          ,building_name
                          ,description 
                          ,creation_date
                          ,updating_date
                    FROM  buildings
                    WHERE building_id = '$building_id'
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
				                    <strong>¡Operación Exitosa!</strong> Data actualizada correctamente.
				                  </div>
			                    </p>
			                    <div>
			                      <br />
			                      <form id="building_fieldsx" 
			                            name="building_fieldsx" data-parsley-validate class="form-horizontal form-label-left">
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="building_id">ID Edificio <span class="required">*</span>
			                          </label>
			                          <div class="col-md-6 col-sm-6 col-xs-12">
			                            <input type="text" 
			                                   id="building_id"
			                                   value="'.$row["building_id"].'"
			                                   readonly 
			                                   required="required" class="form-control col-md-7 col-xs-12">
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="building_name">Nombre Edificio <span class="required">*</span>
			                          </label>
			                          <div class="col-md-6 col-sm-6 col-xs-12">
			                            <input type="text" 
			                                   id="building_name"
			                                   value="'.$row["building_name"].'" 
			                                   required="required" class="form-control col-md-7 col-xs-12">
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label class="control-label col-md-3 col-sm-3 col-xs-12" 
			                                 for="building_name">Descripción Edificio <span class="required"></span>
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
			                                    onclick="delete_building();">Eliminar</button>
			                            <button type="btn btn-warning" 
			                                    class="btn btn-warning" 
			                                    onclick="update_building();">Actualizar</button>
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
		                    <strong>¡Operación fallida!</strong> No pudo actualizarse la data...
		                  </div>';
    }

    echo json_encode($data);

    $conn->close();

