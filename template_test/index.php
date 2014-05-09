<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">

    <title>Check!It</title>

    <!-- Bootstrap core CSS -->
    <link href="../resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">

<style type="text/css">

/* make sidebar nav vertical */ 
@media (min-width: 768px) {
/*  .sidebar-nav .navbar .navbar-collapse {
    padding: 0;
    max-height: none;
    background-color: #222;
  }
*/  .sidebar-nav .navbar ul {
    float: none;
    display: block;
  }
  .sidebar-nav .navbar li {
    float: none;
    display: block;
    border-bottom: 1px solid #111;
    border-top: 1px solid #333;
  }
  .sidebar-nav .navbar li a {
    padding-top: 12px;
    padding-bottom: 12px;
  }
  .navbar-default {
    background-color: #222;
    border-color: #222;
  }
  .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus {
    color: #ccc;
    background-color: #222;
    border-left: 5px solid #d2322d;
  }
  .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {
    color: #aaa;
    background-color: transparent;
    border-left: 5px solid #d2322d;
  } 
  .navbar-default .navbar-nav>li>a {
    border-left: 5px solid #222;
  }   
  .navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus {
    color: #ccc;
    background-color: #222;
  } 
  .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus {
    color: #aaa;
  } 
  .bg-color
  {
    border-color: #222; 
    background-color: #222; 
  }
  .bg-colorlight
  {
    background-color: #ddd;  
  }  
  .badge-red
  {
    background-color: #d2322d;
  } 

}
</style>

  </head>

  <body style="padding-top: 50px;"> 

    <div class="navbar navbar-inverse navbar-fixed-top bg-color" role="navigation">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Check!It</a>
        </div>
        <div class="collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><i class="icon-dashboard icon-large icon-fixed-width"></i> Dashboard</a></li>
            <li><a href="#"><i class="icon-inbox icon-large icon-fixed-width"></i> <span class="badge badge-red">42</span> Procesos</a></li>
            <li><a href="#"><i class="icon-briefcase icon-large icon-fixed-width"></i> Gestión Estratégica</a></li>
          </ul>
        </div><!--/.nav-collapse -->

    </div>

      <div class="row bg-color" id="contenido">
        <div class="col-md-2">



    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><i class="icon-dashboard icon-large icon-fixed-width"></i> Dashboard</a></li>
            <li><a href="#"><i class="icon-inbox icon-large icon-fixed-width"></i> Procesos<span class="badge badge-red pull-right">42</span></a></li>
            <li><a href="#"><i class="icon-briefcase icon-large icon-fixed-width"></i> Gestión Estratégica</a></li>
            <li><a href="#"><i class="icon-cogs icon-large icon-fixed-width"></i> Administación</a></li>
            <li><a href="#">Reviews <span class="badge pull-right badge-red">30</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

        </div>
        <div class="col-md-10 bg-colorlight">
          <div>
            <h1>Aquí va el contenido</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>           
          </div>
        </div>
      </div> <!-- contenido -->

    <div class="row" id="footer"> 
      <div class="col-md-12 bg-color">
        <p class="text-muted credit text-center">Aquí va el footer.
        </p>
      </div>
    </div><!-- footer -->   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../resources/jquery/1.11.1/jquery.min.js"></script>
    <script src="../resources/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>