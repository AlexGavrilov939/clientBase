
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ClientBase v1.0b</title>
    <meta name="description" content="description">
    <meta name="author" content="DevOOPS">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="../assets/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="../assets/css/jquery-ui.min.css"/>
    <link type="text/css" rel="stylesheet" href="../assets/css/style.css"/>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="screensaver">
        <canvas id="canvas"></canvas>
        <i class="fa fa-lock" id="screen_unlock"></i>
    </div>
    <header class="navbar">
        <div class="container-fluid expanded-panel">
            <div class="row">
                <div id="logo" class="col-xs-12 col-sm-2">
                    <a href="#">ClientBase v1.0b</a>
                </div>
                <div id="top-panel" class="col-xs-12 col-sm-10">
                    <div class="row">
                        <div class="col-xs-8 col-sm-4">
                            <a href="#" class="show-sidebar">
                                <i class="fa fa-bars"></i>
                            </a>
                            <div id="search">
                                <input type="text" placeholder="Поиск.."/>
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-8 top-panel-right">
                            <ul class="nav navbar-nav pull-right panel-menu">
                                <li class="hidden-xs">
                                    <a href="index.html" class="modal-link">
                                        <i class="fa fa-bell"></i>
                                        <span class="badge">7</span>
                                    </a>
                                </li>
                                <li class="hidden-xs">
                                    <a class="ajax-link" href="ajax/calendar.html">
                                        <i class="fa fa-calendar"></i>
                                        <span class="badge">7</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                        <div class="avatar">
                                            <img src="img/avatar.jpg" class="img-rounded" alt="avatar" />
                                        </div>
                                        <i class="fa fa-angle-down pull-right"></i>
                                        <div class="user-mini pull-right">
                                            <span class="welcome"><?=$data['welcome']?></span>
                                            <span>Jane Devoops</span>
                                        </div>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
    <div class="row">
        <div id="sidebar-left" class="col-xs-2 col-sm-2">
            <ul class="nav main-menu">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-table"></i>
                        <span class="hidden-xs">Tables</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="ajax-link" href="ajax/tables_simple.html">Simple Tables</a></li>
                        <li><a class="ajax-link" href="ajax/tables_datatables.html">Data Tables</a></li>
                        <li><a class="ajax-link" href="ajax/tables_beauty.html">Beauty Tables</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!--Start Content-->
        <div id="content" class="col-xs-12 col-sm-10">
            
            <div id="ajax-content"></div>
        </div>
        <!--End Content-->
    </div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery-2.1.0.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-48336868-1', 'devoops.me');
    ga('send', 'pageview');

</script>
</body>
</html>
