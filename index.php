<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include "_head.php"; ?>
  </head>

  <body class="nav-md">
    <div class="container body">

      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <div class="navbar nav_title" style="border: 0;">
              <?php include "_nav_title.php"; ?>
            </div>

            <div class="clearfix">
            </div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <!--div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div-->
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <?php include "_sidebar_menu.php"; ?>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <?php include "_footer.php"; ?>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <?php include "_nav_menu.php"; ?>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row tile_count">

            <div class="page-title">

              <div class="title_left">
                <h3>Historial Ubicaciones <small> de usuarios.</small></h3>
              </div>

              <!--div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div-->
            </div>

            <div class="clearfix"></div>


            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total de Visitantes </span>
                <div class="count">0</div>
                <span class="count_bottom"><i class="green">4% </i> De Hoy</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Tiempo Promedio</span>
                <div class="count">123.50</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> Por Usuario</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total de Mujeres</span>
                <div class="count green">2,500</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Hoy </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total de Hombres </span>
                <div class="count">4,567</div>
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> Hoy </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total de Usuarios</span>
                <div class="count" id="nusers_id">0</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Hasta la fecha</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                <div class="count">7,325</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>

          <div class="clearfix"></div>      
            
          <div class="x_panel">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="dashboard_graph">

                    <div class="row x_title">
                      <div class="col-md-6">
                        <h3>Visitas de los Clietes <small>Por Semana</small></h3>
                      </div>
                      <div class="col-md-6">
                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                          <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div id="chart_plot_01" class="demo-placeholder"></div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                      <div class="x_title">
                        <h2>Top Locales Más Visitados </h2>
                        <div class="clearfix"></div>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-6">
                        <div>
                          <p>Facebook Campaign</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <p>Twitter Campaign</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-6">
                        <div>
                          <p>Conventional Media</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <p>Bill boards</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="clearfix">
                    </div>

                  </div>
                </div>
              </div>
          </div>
          <!-- Barra Animada de desnsidad de usuarios por pasillos-->
          <div class="x_panel">
              <div class="col-md-6 col-sm-6 col-xs-12">  
                  <div class="x_title">
                      <h2><i class="fa fa-align-left"></i> Densidad de Usuarios<small>Pasillos</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                        <p>Cantidad de Usuarios por pasillos</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="progress right">
                            <div class="progress-bar progress-bar-danger" data-transitiongoal="25"></div>
                          </div>
                          <div class="progress right">
                            <div class="progress-bar progress-bar-warning" data-transitiongoal="45"></div>
                          </div>
                          <div class="progress right">
                            <div class="progress-bar progress-bar-info" data-transitiongoal="65"></div>
                          </div>
                          <div class="progress right">
                            <div class="progress-bar progress-bar-success" data-transitiongoal="95"></div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="progress">
                            <div class="progress-bar progress-bar-danger" data-transitiongoal="25"></div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar progress-bar-warning" data-transitiongoal="45"></div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar progress-bar-info" data-transitiongoal="65"></div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar progress-bar-success" data-transitiongoal="95"></div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_title">
                      <h2>Usuarios Mensuales por Sexo </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div id="mainb" style="height:350px;"></div>
                  </div>
              </div>
          </div>

          <div class="x_panel">
              <!-- Grafica de Lineal de los Horarios más concurridos-->
              <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <div class="col-md-6">
                        <h3>Horarios más Concurridos <small>De la Edificación</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
              </div>
              <!-- Grafica de pastel de los locales más visitados-->
              <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <div class="x_title">
                      <h2>Locales más Visitados <small>Cubículo</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <canvas id="canvasDoughnut"></canvas>
                  </div>
               </div>
          </div>

          <!-- Grafica visitantes por provincia-->
          <div class="x_panel">
              <div class="x_title">
                  <h2>Visitantes por Provincia<small>geo-presentation</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="dashboard-widget-content">
                      <div class="col-md-4 hidden-small">
                          <h2 class="line_30">125.7k Views from 60 countries</h2>
                          <table class="countries_list">
                            <tbody>
                              <tr>
                                <td>United States</td>
                                <td class="fs15 fw700 text-right">33%</td>
                              </tr>
                              <tr>
                                <td>France</td>
                                <td class="fs15 fw700 text-right">27%</td>
                              </tr>
                              <tr>
                                <td>Germany</td>
                                <td class="fs15 fw700 text-right">16%</td>
                              </tr>
                              <tr>
                                <td>Spain</td>
                                <td class="fs15 fw700 text-right">11%</td>
                              </tr>
                              <tr>
                                <td>Britain</td>
                                <td class="fs15 fw700 text-right">10%</td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                      <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;">
                      </div>
                  </div>
              </div>
          </div>
        </div>

        <!-- /footer content -->
        <footer>        
            <div class="pull-right">
                Proyecto InLocate <a href="#">PUCMM</a>
            </div>
            <div class="clearfix"></div>
        </footer>
      </div>
    </div>


    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>

    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
     <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
     <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>

    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>

     <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

        <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="xjs.js"></script>

    <script src="xtimer_dashboard.js"></script>

  </body>
</html>
