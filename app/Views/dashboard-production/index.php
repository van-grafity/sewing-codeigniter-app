<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Dashboard</title>

    <link rel="stylesheet" href="<?= base_url('bootstrap'); ?>/css/bootstrap.css">
    <style>
        .page-title {
            font-weight: 700;
        }


        .header-text {
            font-weight: 700;
            font-size: 24px;
        }

        .panel-section {
            font-size: 20px;
        }

        .title {
            width: 140px;
        }

        .value {
            color: var(--bs-blue);
            font-weight: 500;
        }

        .value.big {
            font-size: 1.5em;
            font-weight: 700;
        }

        .value.down {
            color: var(--bs-red);
        }

        .title.bold {
            font-weight: 700;
        }

        .title-column {
            width: 200px;
            font-weight: 500;
            font-size: 24px;
        }

        .value-column {
            width: 100px;
            font-weight: 500;
            font-size: 24px;
            text-align: center;
        }

        .first-row {
            border-bottom: 1px solid black;
            border-bottom-width: 3px !important;
        }
    </style>
</head>


<body>
    <div class="container-fluid mt-5">
        <h1 class="page-title text-center mb-5">Production Dashboard</h1>
        <div class="header-section mb-2">
            <div class="row">
                <div class="col-sm-3">
                    <div class="header-text" id="header_line">Line : - </div>
                </div>
                <div class="col-sm-3">
                    <div class="header-text" id="header_date_show">Date : - </div>
                </div>
                <div class="col-sm-3">
                    <div class="header-text" id="header_gl_number">GL : - </div>
                </div>
                <div class="col-sm-3">
                    <div class="header-text" id="header_category">Product Type : - </div>
                </div>
            </div>
        </div>
        <div class="panel-section">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <table>
                                <tr class="panel-data">
                                    <td class="title">Target</td>
                                    <td class="value" id="panel_target"> - </td>
                                </tr>
                                <tr>
                                    <td class="title">Actual</td>
                                    <td class="value big" id="panel_output"> - </td>
                                </tr>
                                <tr>
                                    <td class="title">Forecast</td>
                                    <td class="value" id="panel_forecast"> - </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td class="title bold">Variance</td>
                                </tr>
                                <tr>
                                    <td class="title">Cumulative</td>
                                    <td class="value big" id="panel_variance_cumulative"> - </td>
                                </tr>
                                <tr class="">
                                    <td class="title">Achievement</td>
                                    <td class="value" id="panel_achievement"> - </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td class="title bold">Efficiency</td>
                                </tr>
                                <tr>
                                    <td class="title">Committed</td>
                                    <td class="value" id="panel_efficiency_target"> - </td>
                                </tr>
                                <tr>
                                    <td class="title">Actual</td>
                                    <td class="value big" id="panel_efficiency_actual"> - </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td class="title bold">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="title">Previous Day</td>
                                    <td class="value">0 pcs</td>
                                </tr>
                                <tr>
                                    <td class="title">Current Month</td>
                                    <td class="value">0 pcs</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table display-output">
                    <tbody>
                        <tr id="row_display_hours_of">
                            <td class="title-column first-row">Hours of</td>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <td class="value-column first-row"><?= $i ?></td>
                            <?php }  ?>
                        </tr>
                        <tr id="row_display_target">
                            <td class="title-column">Target</td>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <td class="value-column"> - </td>
                            <?php }  ?>
                        </tr>
                        <tr id="row_display_output">
                            <td class="title-column">Q Passed Qty</td>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <td class="value-column"> - </td>
                            <?php } ?>
                        </tr>
                        <!-- baris tuk menampilkan kolom Efficiency per jam -->
                        <tr id="row_display_efficiency">
                            <td class="title-column">Efficiency</td>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <td class="value-column"> - </td>
                            <?php }  ?>
                        </tr>
                        <!-- row to display defect qty -->
                        <tr id="row_display_defect_qty">
                            <td class="title-column">Defect Qty</td>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <td class="value-column"> - </td>
                            <?php } ?>
                        </tr>
                        <!-- row to display defect rate -->
                        <tr id="row_display_defect_rate">
                            <td class="title-column">Defect Rate</td>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <td class="value-column"> - </td>
                            <?php }  ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="<?= base_url('adminLTE'); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('bootstrap'); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url(''); ?>/js/utils.js"></script>

    <script type="text/javascript">
        const get_data_url = '<?= url_to('get_data_dashboard') ?>';

        const load_data_dashboard = async (data_params) => {

            result = await using_fetch(get_data_url, data_params, "GET");
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

        let data_slideshow = <?php echo json_encode($data_slideshow)  ?>;
        let time_date_filter = '<?= $time_date  ?>';
        // console.log(time_date_filter);
        // console.log(data_slideshow);

        function run_slide_show(set_slide_show) {
            let delay = 30000;
            set_slide_show.forEach((data_show, i) => {
                setTimeout(function() {
                    data_params = {
                        line_id: data_show.id,
                        date_filter: time_date_filter,
                        // date_filter: new Date().toJSON().slice(0, 10),
                    }

                    load_data_dashboard(data_params)
                }, i * delay)
            });

            setTimeout(function() {
                run_slide_show(set_slide_show)
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
    <script type="text/javascript">
        $(document).ready(function() {
            run_slide_show(data_slideshow);
        })
    </script>
</body>


</html>