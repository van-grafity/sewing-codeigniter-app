<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Dashboard</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="<?= base_url('bootstrap'); ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/dashboard.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <!-- Navbar content -->
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Dashboard Manager</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li><a via-link via-href="manager">Manager </a></li>
                    <li><a via-link via-href="factory">Factory </a></li>
                    <li><a via-link via-href="video">Video </a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.Nav-content -->
    </nav>

    <!-- Container for content-->
    <div class="container-fluid" id="content" via-views>should stay hidden</div>
    <!-- /.container for content-->

    <!-- Latest compiled and minified JavaScript -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('bootstrap'); ?>/js/bootstrap.min.js"></script>

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
                selector: "#content",
                templateUrl: 'dashboard-manager'
            }],
            factory: [{
                selector: "#content",
                templateUrl: 'dashboard-factory'
            }],
            video: [{
                selector: "#content",
                templateUrl: 'dashboard-video'
            }],
            defaultView: {
                view: 'manager'
            }
        };
        new Via(views);
    </script>
</body>

</html>