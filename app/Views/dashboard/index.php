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
    <div class="container-fluid" id="content" via-views > should stay hidden</div>
    <!-- /.container for content-->

    <!-- Latest compiled and minified JavaScript -->
    <script src="<?= base_url('adminLTE'); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('bootstrap'); ?>/js/bootstrap.min.js"></script>
    
    <script src="<?= base_url(''); ?>/js/utils.js"></script>

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
                timer = setTimeout(myTimer, 20000);
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

    
    <!-- ## Script for Dashboard Manager -->
    <script type="text/javascript">
        const get_data_dashboard_manager_url = '<?= url_to('get_data_all_line') ?>';

        const load_data_dashboard_manager = async (data_params) => {
            result = await using_fetch(get_data_dashboard_manager_url, data_params, "GET");
            if (result.status == 'error') {
                console.log(result.message);
                return false;
            }

            // console.log(result.data);

            let data_per_line = result.data.data_per_line;
            $('#dashboard_manager tbody').html(``);

            data_per_line.forEach(line => {
                $('#dashboard_manager tbody').append(`
                    <tr>
                        <td class="${line.element_class}">${line.line}</td>
                        <td class="text-center">${line.target}</td>
                        <td class="text-center">${line.output}</td>
                        <td class="text-center">${line.variance}</td>
                        <td class="text-center">${line.forecast}</td>
                        <td class="text-center">${line.forecast_target}</td>
                        <td class="text-center">${line.forecast_variance}</td>
                        <td class="text-center">${line.efficiency_target}</td>
                        <td class="text-center">${line.efficiency_actual}</td>
                    <tr>
                `)
            })
        }

        function run_slide_show_manager() {
            let delay = 20000;
            setTimeout(function() {
                data_params = {}
                load_data_dashboard_manager(data_params)
                run_slide_show_manager()
            }, delay)
        }
    </script>

    <!-- ## Script for Dashboard Factory -->
    <script type="text/javascript">
        const get_data_dashboard_factory_url = '<?= url_to('get_data_dashboard') ?>';

        const load_data_dashboard_factory = async (data_params) => {

            result = await using_fetch(get_data_dashboard_factory_url, data_params, "GET");
            if (result.status == 'error') {
                empty_data_dashboard();
                $('#header_line').text(`Line : ${result.data.data_panel.line}`);
                $('#header_date_show').text(`Date : ${result.data.data_panel.date_show}`);
                $('#header_gl_number').text(`GL : ${result.data.data_panel.gl_number}`);
                $('#header_category').text(`Product Type : ${result.data.data_panel.category}`);
                return false;
            }

            // console.log(result);

            $('#header_line').text(`Line : ${result.data.data_panel.line}`);
            $('#header_date_show').text(`Date : ${result.data.data_panel.date_show}`);
            $('#header_gl_number').text(`GL : ${result.data.data_panel.gl_number}`);
            $('#header_category').text(`Product Type : ${result.data.data_panel.category}`);


            $('#panel_target').text(`${result.data.data_panel.target} pcs`);
            $('#panel_output').text(`${result.data.data_panel.output} pcs`);
            $('#panel_forecast').text(`${result.data.data_panel.forecast} pcs`);


            $('#panel_output').removeClass("down");
            $('#panel_output').addClass(result.data.data_panel.output_class);


            $('#panel_variance_cumulative').text(`${result.data.data_panel.variance_cumulative}`);
            $('#panel_achievement').text(`${result.data.data_panel.achievement}`);


            $('#panel_variance_cumulative').removeClass("down");
            $('#panel_variance_cumulative').addClass(result.data.data_panel.output_class);


            $('#panel_efficiency_target').text(`100%`);
            $('#panel_efficiency_actual').text(`${result.data.data_panel.actual}`);

            $("#row_display_hours_of").find("td:gt(0)").remove();
            $("#row_display_target").find("td:gt(0)").remove();
            $("#row_display_output").find("td:gt(0)").remove();
            $("#row_display_efficiency").find("td:gt(0)").remove();
            $("#row_display_defect_qty").find("td:gt(0)").remove();
            $("#row_display_defect_rate").find("td:gt(0)").remove();

            let output_records = result.data.data_output_records;


            output_records.forEach(record => {
                $("#row_display_hours_of").append(`<td class="value-column first-row">${record.time_hours_of}</td>`);
                $("#row_display_target").append(`<td class="value-column">${record.target}</td>`);
                $("#row_display_efficiency").append(`<td class="value-column">${record.hourly_efficiency}</td>`);
                $("#row_display_output").append(`<td class="value-column ${record.element_class}">${record.output}</td>`);
                $("#row_display_defect_qty").append(`<td class="value-column">${record.defect_qty}</td>`);
                $("#row_display_defect_rate").append(`<td class="value-column">${record.defect_rate}</td>`);
            });
        }

        let data_slideshow;
        let time_date_filter;
        let set_slide_show = [];

        function run_slide_show_factory(set_slide_show) {
            let delay = 30000;
            set_slide_show.forEach((data_show, i) => {
                setTimeout(function() {
                    data_params = {
                        line_id: data_show.id,
                        date_filter: time_date_filter,
                        // date_filter: new Date().toJSON().slice(0, 10),
                    }

                    load_data_dashboard_factory(data_params)
                }, i * delay)
            });

            setTimeout(function() {
                run_slide_show_factory(set_slide_show)
            }, set_slide_show.length * delay)
        }

        function empty_data_dashboard() {
            $('#header_line').text(`Line : -`);
            $('#header_date_show').text(`Date : -`);
            $('#header_gl_number').text(`GL : -`);
            $('#header_category').text(`Product Type : -`);

            $('#panel_target').text(`- pcs`);
            $('#panel_output').text(`- pcs`);
            $('#panel_forecast').text(`- pcs`);


            $('#panel_output').removeClass("down");


            $('#panel_variance_cumulative').text(`-`);
            $('#panel_achievement').text(`-`);


            $('#panel_variance_cumulative').removeClass("down");


            $('#panel_efficiency_target').text(`-`);
            $('#panel_efficiency_actual').text(`-`);

            $("#row_display_hours_of").find("td:gt(0)").remove();
            $("#row_display_target").find("td:gt(0)").remove();
            $("#row_display_output").find("td:gt(0)").remove();
            $("#row_display_efficiency").find("td:gt(0)").remove();
            $("#row_display_defect_qty").find("td:gt(0)").remove();
            $("#row_display_defect_rate").find("td:gt(0)").remove();


            for (let index = 1; index <= 10; index++) {
                $("#row_display_hours_of").append(`<td class="value-column first-row">${index}</td>`);
                $("#row_display_target").append(`<td class="value-column"> - </td>`);
                $("#row_display_output").append(`<td class="value-column"> - </td>`);
                $("#row_display_efficiency").append(`<td class="value-column"> - </td>`);
                $("#row_display_defect_qty").append(`<td class="value-column"> - </td>`);
                $("#row_display_defect_rate").append(`<td class="value-column"> - </td>`);
            }
        }
    </script>
</body>

</html>