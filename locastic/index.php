<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      
    <title>ToDo App</title>
     
    <link href="libs/css/bootstrap.min.css" rel="stylesheet" media="screen" />

    <link href="css/style.css" rel="stylesheet" media="screen" />

</head>
<body>
 
    <div class="container">
     
        <div class='page-header'>
            <h1 id='page-title'>Todo App</h1>
            <div class="row">
                <div class="col-xs-2 margin-bottom-1em overflow-hidden">
                    <div id='loader-image' class="display-none"><img src='images/ajax-loader.gif' /></div>
                </div>                
                <div class="col-xs-3"></div>
                <div class="col-xs-3 margin-bottom-1em overflow-hidden">
                    <p id='current-user' ></p>
                </div>
                <div class="col-xs-2 margin-bottom-1em overflow-hidden">
                    <div id='zadaci-btn' class="btn btn-primary ">Zadaci</div>
                </div>
                <div class="col-xs-2 margin-bottom-1em overflow-hidden">
                    <div id='logout-btn' class="btn btn-primary ">Log out</div>
                </div>
            </div>
        </div>         
        <div id='page-content'></div>        
    </div>
        
      
<script src="libs/js/jquery-3.0.0.min.js"></script>
 
<script src="libs/js/bootstrap.min.js"></script>

<script src="js/script.js"></script>
</body>
</html>