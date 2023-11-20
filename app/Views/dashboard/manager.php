<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Manager Dashboard</title>

    <link rel="stylesheet" href="<?= base_url('bootstrap'); ?>/css/bootstrap.css">
    <style>
        .page-title {
            font-weight: 700;
        }

        #dashboard_manager,
        #dashboard_manager th {
            border: 1px solid black !important;
        }

        .big-title {
            font-size: 1.2em;
            font-weight: 700;
        }

        #dashboard_manager tbody {
            font-size: .8em;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <h2 class="page-title text-center mb-3">Production Manager Dashboard</h2>
            </div>
            <div class="col-sm-3">
                <h5 class="text-end"> <?= $time_date ?></h5>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="row">
                <div class="col-sm-12">
                    <table id="dashboard_manager" class="table">
                        <thead class="">
                            <tr class="big-title">
                                <th rowspan="2" class="text-center align-middle">Line</th>
                                <th colspan="3" class="text-center align-middle">Actual vs Committed</th>
                                <th colspan="3" class="text-center align-middle">Forecast (expected at the end of shift)</th>
                                <th colspan="2" class="text-center align-middle">Efficiency</th>
                            </tr>
                            <tr>
                                <th class="text-center align-middle">Cum Committed Target</th>
                                <th class="text-center align-middle">Cum Actual</th>
                                <th class="text-center align-middle">Variance</th>
                                <th class="text-center align-middle">Value</th>
                                <th class="text-center align-middle">Committed</th>
                                <th class="text-center align-middle">Variance</th>
                                <th class="text-center align-middle">Efficiency Committed</th>
                                <th class="text-center align-middle">Current Efficiency</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            load_data_dashboard_manager();
            run_slide_show_manager();
        })
    </script>
</body>

</html>