<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Lucas Silvestre">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Project for Cloud Computing class</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.autocomplete.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="assets/css/jumbotron-narrow.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox-1.3.4.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

    
  
    

  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="text-muted">Pic by Loc</h3>
      </div>

      <div class="jumbotron">
        <h1>Choose your venue</h1>
        <p class="lead">Enter the name of a place and let us look for photos taken on it.</p>
        <div class="input-group input-group-lg">
		      <input type="text" class="form-control" id="input_venue" name="input_venue" value="" />
		      <input type="hidden" class="form-control" id="venue_id" name="venue_id" value="" />
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button" id="venue_search">Go!</button>
		      </span>
		    </div><!-- /input-group -->
      </div>

      <div class="row marketing" id="pictures">
        
      </div>

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="assets/js/picloc.js"></script>
    <script type='text/javascript' src='assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery.fancybox-1.3.4.pack.js'></script>

  </body>
</html>
