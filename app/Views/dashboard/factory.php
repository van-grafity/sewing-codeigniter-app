<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Dashboard</title>

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

    <script>
        data_slideshow = <?php echo json_encode($data_slideshow)  ?>;
        time_date_filter = '<?= $time_date  ?>';
        console.log("dipanggil ini");
        
        $(document).ready(function() {
            run_slide_show_factory(data_slideshow);
        })
    </script>
    
</body>


</html>