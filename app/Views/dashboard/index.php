<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard</title>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/dashboard.css">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Dashboard Manager</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a via-link via-href="manager">Manager</a></li>
                    <li><a via-link via-href="factory">Factory</a></li>
                    <li><a via-link via-href="video">Video</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <!-- <div class="container" id="title" via-views>should stay hidden</div> -->

    <div class="container" id="content" via-views>should stay hidden</div>
    <!-- /.container -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/js/app.js"></script>
    <!-- Init -->
    <script>
        $(function() {
            var navBar = $("#navbar");

            navBar.on("click", "a", null, function() {
                navBar.collapse('hide');
            });
        });

        var views = {
            manager: [{
                selector: "#title",
                // templateUrl: 'views/index-title.html'
            }, {
                selector: "#content",
                templateUrl: 'dashboard-manager'
            }, ],
            factory: [{
                selector: "#title",
                // templateUrl: 'views/about-title.html'
            }, {
                selector: "#content",
                templateUrl: 'dashboard-factory'
            }, ],
            video: [{
                selector: "#title",
                // templateUrl: 'views/contact-title.html'
            }, {
                selector: "#content",
                templateUrl: 'dashboard-video'
            }, ],
            defaultView: {
                view: 'manager'
            }
        };
        new Via(views);
    </script>
</body>

</html>