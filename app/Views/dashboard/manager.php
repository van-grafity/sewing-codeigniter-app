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
            font-weight:700;
        }

        #dashboard_manager tbody {
            font-size:.8em;
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
                    <table id="dashboard_manager"class="table">
                        <thead class="">
                            <tr class="big-title">
                                <th></th>
                                <th colspan ="3">Actual vs Committed</th>
                                <th colspan ="3">Forecast (expected at the end of shift)</th>
                                <th colspan ="2">Efficiency</th>
                            </tr>
                            <tr>
                                <th>Line</th>
                                <th>Cum Committed Target</th>
                                <th>Cum Actual</th>
                                <th>Variance</th>
                                <th>Value</th>
                                <th>Committed</th>
                                <th>Variance</th>
                                <th>Efficiency Committed</th>
                                <th>Current Efficiency</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('adminLTE'); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('bootstrap'); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url(''); ?>/js/utils.js"></script>

    <script type="text/javascript">
        const get_data_url ='<?= url_to('get_data_all_line') ?>';
        
        const load_data_dashboard = async (data_params) => {
            result = await using_fetch(get_data_url, data_params, "GET");
            if(result.status == 'error') {
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
                        <td class="">${line.target}</td>
                        <td class="">${line.output}</td>
                        <td class="">${line.variance}</td>
                        <td class="">${line.forecast}</td>
                        <td class="">${line.forecast_target}</td>
                        <td class="">${line.forecast_variance}</td>
                        <td class="">${line.efficiency_target}</td>
                        <td class="">${line.efficiency_actual}</td>
                    <tr>
                `)
            })
        }

        function run_slide_show() {
            let delay = 20000;
            setTimeout(function(){
                data_params = {}
                load_data_dashboard(data_params)
                run_slide_show()
            },  delay)
        }

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            load_data_dashboard();
            run_slide_show();
        })
        
    </script>
</body>
</html>