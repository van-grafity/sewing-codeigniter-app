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

<body onload="showDashboard()">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <!-- Navbar content -->
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="dashboard">Dashboard Manager</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li><a id="link-1" via-link via-href="manager">Manager </a></li>
                    <li><a id="link-2" via-link via-href="factory">Factory </a></li>
                    <li><a id="link-3" via-link via-href="video">Video </a></li>
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

    <script type="text/javascript">
        function showDashboard() {
            // showDashboard code will be inside here
            let i = 0;
            let durasi = 1000;

            function increment() {
                i++;
                if (i == 4) {
                    i = 1
                }
                // console.log('Link aktif : ' + 'link-' + i);
                document.getElementById('link-' + i).click();
            }

            let timer = setTimeout(function myTimer() {
                increment();
                if (i == 1) {
                    durasi = 5000;
                } else if (i == 2) {
                    durasi = 10000;
                } else if (i == 3) {
                    durasi = 15000;
                }
                // console.log('Link aktif : ' + 'link-' + i);
                timer = setTimeout(myTimer, durasi);
            }, 1000);
        }

        // var link = ['link-manager', 'link-factory', 'link-video'];
        // // console.log(link);
        // setTimeout(changeDashboard(link), 5000);

        // function changeDashboard(link) {
        //     let delay = 10000;

        //     // 
        //     link.forEach(function(e, i) {
        //         setTimeout(console.log('Link aktif : ' + (i + 1) + ' adalah : ' + e), i * delay);
        //     });

        //     setTimeout(function() {
        //         changeDashboard(link)
        //     }, link.length * delay);
        // }

        // JavaScript for clicking button
        //     setTimeout(ClickTheLink, 60000);

        //     function ClickTheLink() {
        //         document.getElementById("link-factory").click();
        //     }
        //     setTimeout(ClickLinkVideo, 120000);

        //     function ClickLinkVideo() {
        //         document.getElementById("link-video").click();
        //     }
    </script>
</body>

</html>