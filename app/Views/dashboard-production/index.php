<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
            font-weight:500;
        }

        .value.big {
            font-size: 1.5em;
            font-weight:700;
        }

        .value.down {
            color: var(--bs-red);
        }

        .title.bold {
            font-weight:700;
        }

        .title-column {
            width:200px;
            font-weight: 500;
            font-size: 24px;
        }
        
        .value-column {
            width:100px;
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
        <h1 class="page-title text-center mb-5">Dashboard Production</h1>
        <div class="header-section mb-2">
            <div class="row">
                <div class="col-sm-3">
                    <div class="header-text">Line : <?= $data_panel['line'] ?></div>
                </div>
                <div class="col-sm-3">
                    <div class="header-text">Date : <?= $data_panel['date_show'] ?></div>
                </div>
                <div class="col-sm-3">
                    <div class="header-text">GL : <?= $data_panel['gl_number'] ?></div>
                </div>
            </div>
        </div>
        <div class="panel-section">
            <div class="row mb-5">
                <div class="col-sm-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <table>
                                <tr class="panel-data">
                                    <td class="title">Target</td>
                                    <td class="value"><?= $data_panel['target'] ?> pcs</td>
                                </tr>
                                <tr>
                                    <td class="title">Actual</td>
                                    <td class="value big <?= $data_panel['output_class'] ?>"><?= $data_panel['output'] ?> pcs</td>
                                </tr>
                                <tr>
                                    <td class="title">Forecast</td>
                                    <td class="value"><?= $data_panel['forecast'] ?> pcs</td>
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
                                    <td class="value big <?= $data_panel['output_class'] ?>"><?= $data_panel['variance_cumulative'] ?></td>
                                </tr>
                                <tr>
                                    <td class="title">Achievement</td>
                                    <td class="value"><?= $data_panel['achievement'] ?></td>
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
                                    <td class="title">Commited</td>
                                    <td class="value big" >100%</td>
                                </tr>
                                <tr>
                                    <td class="title">Actual</td>
                                    <td class="value"><?= $data_panel['achievement'] ?></td>
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
                                    <td class="title bold">Incentive Earned</td>
                                </tr>
                                <tr>
                                    <td class="title">Last Day</td>
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
                        <tr>
                            <td class="title-column first-row">Hours of</td>
                            <?php foreach ($data_output_records as $key => $output) { ?>
                                <td class="value-column first-row"><?= $output['time_hours_of'] ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="title-column">Target</td>
                            <?php foreach ($data_output_records as $key => $output) { ?>
                                <td class="value-column"><?= $output['target'] ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="title-column">Output</td>
                            <?php foreach ($data_output_records as $key => $output) { ?>
                                <td class="value-column <?= $output['element_class'] ?>"><?= $output['output'] ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="title-column">Endline FTT</td>
                            <?php foreach ($data_output_records as $key => $output) { ?>
                                <td class="value-column"><?= $output['endline_ftt'] ?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script src="<?= base_url('bootstrap'); ?>/js/bootstrap.min.js"></script>
</body>
</html>