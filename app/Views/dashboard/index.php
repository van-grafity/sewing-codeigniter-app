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

<!-- <body onload="welcomeFunction()"> -->

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
                    <li><a id="link-manager" via-link via-href="manager">Manager </a></li>
                    <li><a id="link-factory" via-link via-href="factory">Factory </a></li>
                    <li><a id="link-video" via-link via-href="video">Video </a></li>
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

    <!-- Initialize view -->
    <script type="text/javascript">
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

    <!-- <script type="text/javascript">
        let message = document.getElementById("message");

        function welcomeFunction() {
            alert("welcome to the tutorialsPoint!");
            message.innerHTML = "Function executed successfully on page load."
        }
    </script> -->

    <script type="text/javascript">
        let int_manager = 60000; // satuan milidetik tuk 1 menit.
        let int_factory = 120000; // satuan milidetik tuk 2 menit.

        var i = 0;
        var loop = function() {
            while (i < 3) { //Your code here!
                i++;
                console.log("I am looping!");
            }
        };

        loop();
    </script>

    <!-- JavaScript for clicking button -->
    <script type="text/javascript">
        setTimeout(ClickTheLink, 60000);

        function ClickTheLink() {
            document.getElementById("link-factory").click();
        }
        setTimeout(ClickLinkVideo, 120000);

        function ClickLinkVideo() {
            document.getElementById("link-video").click();
        }
    </script>
</body>

</html>