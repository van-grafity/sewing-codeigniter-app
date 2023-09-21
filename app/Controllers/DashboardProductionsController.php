<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OutputRecordModel;
use App\Models\GlModel;
use App\Models\LineModel;
use App\Models\LineGroupModel;
use App\Models\SlideshowModel;

use CodeIgniter\I18n\Time;


class DashboardProductionsController extends BaseController
{
    protected $OutputRecordModel;
    protected $GlModel;
    protected $LineModel;
    protected $LineGroupModel;
    protected $SlideshowModel;

    public function __construct()
    {
        helper('date');

        $this->OutputRecordModel = new OutputRecordModel();
        $this->GlModel = new GlModel();
        $this->LineModel = new LineModel();
        $this->LineGroupModel = new LineGroupModel();
        $this->SlideshowModel = new SlideshowModel();
    }

    public function index()
    {
        $slideshow = $this->SlideshowModel->where('flag_active',  '1')->first();
        if  ($slideshow) {
            $data_slideshow = $this->LineGroupModel->getLinesByGroupId($slideshow->group_id);


            $data = [
                'data_slideshow' => $data_slideshow,
                'time_date' => (new Time('now'))->toDateString(),
            ];
        } else {
            $data = [
                'data_slideshow' => [],
                'time_date' => "",
            ];
        }
        return view('dashboard-production/index', $data);
    }

    public function index_date($date)
    {
        // ## date sesuai settingan slide
        $slideshow = $this->SlideshowModel->where('flag_active', '1')->first();

        if ($slideshow) {
            $data_slideshow = $this->LineGroupModel->getLinesByGroupId($slideshow->group_id);

            $data = [
                'data_slideshow' => $data_slideshow,
                'time_date' => $slideshow->time_date,
            ];
        } else {
            $data = [
                'data_slideshow' => [],
                'time_date' => "",
            ];
        }

        return view('dashboard-production/index', $data);
    }

    public function dashboardManager()
    {
        $slideshow = $this->SlideshowModel->where('flag_active', '1')->first();
        if (!$slideshow) {
            $time_date = (new Time('now'))->toDateString();
        } else {
            $time_date = $slideshow->time_date;
        }

        $date_show = Time::createFromFormat('Y-m-d', $time_date, 'Asia/Jakarta')->toLocalizedString('d MMMM yyyy');
        $data = [
            'time_date' => $date_show,
        ];
        return view('dashboard-production/dashboard-manager', $data);
    }

    public function getDataDashboard()
    {
        $line_id = $this->request->getGet('line_id');
        $date_filter = $this->request->getGet('date_filter');

        $line = $this->LineModel->find($line_id);

        $date_today = Time::createFromFormat('Y-m-d', $date_filter, 'Asia/Jakarta');
        $date_filter = $date_today->toDateString();
        $date_show = $date_today->toLocalizedString('d MMMM yyyy');

        $params = (object)[
            'line_id' => $line->id,
            'time_date' => $date_filter,
        ];
        $get_gl_list = $this->OutputRecordModel->get_gl_list($params);

        $gl_list = array_map(function ($obj) {
            return $obj->gl_number;
        }, $get_gl_list);

        $data_panel_gl = implode(", ", $gl_list);

        $category_list = array_map(function ($obj) {
            return $obj->category_name;
        }, $get_gl_list);

        $data_panel_category = implode(", ", $category_list);


        $output_records = $this->OutputRecordModel
            ->where('line_id', $line->id)
            ->where('time_date', $date_filter)
            ->orderBy('time_hours_of', 'ASC')
            ->findAll();

        if (!$output_records) {
            $data_panel = [
                'line' => $line->name,
                'gl_number' => $data_panel_gl,
                'category' => $data_panel_category,
                'date_show' => $date_show,
            ];
            $data_return = [
                'status' => 'error',
                'data' => [
                    'data_panel' => $data_panel,
                ],
                'message' => 'Data output not found'
            ];
            return $this->response->setJSON($data_return);
        }

        $sum_target = 0;
        $sum_output = 0;
        $output_class = '';
        $variance_sign = '';

        foreach ($output_records as $key => $data_output) {
            $sum_target += $data_output->target;
            $sum_output += $data_output->output;
        }

        $variance_cumulative = $sum_output - $sum_target;
        if ($variance_cumulative > 0) {
            $variance_cumulative = '+' . $variance_cumulative;
        }

        if ($sum_output < $sum_target) {
            $output_class = 'down';
        }

        $work_hours = count($output_records) <= 8 ? 8 : count($output_records);
        $forecast = round(($sum_output / count($output_records)) * $work_hours);

        if($sum_target > 0) {
            $actual = round(($sum_output / $sum_target) * 100) . ' %';
            $achievement = round(($variance_cumulative / $sum_target) * 100) . '%';
        } else {
            $actual = '0%';
            $achievement = '0%';
        }

        $data_panel = [
            'line' => $line->name,
            'gl_number' => $data_panel_gl,
            'category' => $data_panel_category,
            'date_show' => $date_show,
            'target' => $sum_target,
            'output' => $sum_output,
            'forecast' => $forecast,
            'output_class' => $output_class,
            'variance_cumulative' => $variance_cumulative,
            'actual' => $actual,
            'achievement' => $achievement,
        ];

        for ($i = 0; $i < 10; $i++) {

            if (array_key_exists($i, $output_records)) {
                $element_class = '';
                if ($output_records[$i]->output < $output_records[$i]->target) {
                    $element_class = 'bg-danger text-white';
                }

                if ($output_records[$i]->output > 0) {
                    $defect_rate = round($output_records[$i]->defect_qty / ($output_records[$i]->defect_qty + $output_records[$i]->output), 2) . ' %';
                    $hourly_efficiency = round(($output_records[$i]->output / $output_records[$i]->target) * 100) . ' %';
                } else {
                    $defect_rate = "-";
                    $hourly_efficiency = '-';
                }

                $data_output_records[$i] = [
                    'time_hours_of' => $output_records[$i]->time_hours_of,
                    'target' => $output_records[$i]->target,
                    'output' => $output_records[$i]->output,
                    'hourly_efficiency' => $hourly_efficiency,
                    'defect_qty' => $output_records[$i]->defect_qty,
                    'defect_rate' => $defect_rate,
                    'element_class' => $element_class
                ];
            } else {
                $data_output_records[$i] = [
                    'time_hours_of' => $i + 1,
                    'target' => '-',
                    'output' => '-',
                    'hour_efficiency' => '-',
                    'hourly_efficiency' => '-',
                    'defect_qty' => '-',
                    'defect_rate' => '-',
                    'element_class' => ''
                ];
            }
        }

        $data_return = [
            'status' => 'success',
            'message' => 'successfully get data dashboard',
            'data' => [
                'data_panel' => $data_panel,
                'data_output_records' => $data_output_records
            ],
        ];

        return $this->response->setJSON($data_return);
    }

    public function getDataAllLine()
    {

        $slideshow = $this->SlideshowModel->where('flag_active', '1')->first();
        $line_list = $this->LineGroupModel->getLinesByGroupId($slideshow->group_id);
        $date_filter = $slideshow->time_date;


        $data_per_line = [];

        foreach ($line_list as $key => $line) {

            $output_records = $this->OutputRecordModel
                ->where('line_id', $line->id)
                ->where('time_date', $date_filter)
                ->orderBy('time_hours_of', 'ASC')
                ->findAll();

            $target = $this->OutputRecordModel
                ->where('line_id', $line->id)
                ->where('time_date', $date_filter)
                ->selectSum('target')->first()->target;

            $output = $this->OutputRecordModel
                ->where('line_id', $line->id)
                ->where('time_date', $date_filter)
                ->selectSum('output')->first()->output;

            if (!$target) {
                continue;
            }

            $variance = $output - $target;
            $forecast = round(($output / count($output_records)) * 8);
            $forecast_target = $target;
            $forecast_variance = $forecast - $forecast_target;
            $efficiency_target = '100%';
            $efficiency_actual = round(($output / $target) * 100) . '%';


            $element_class = '';
            if  ($variance < 0) {
                $element_class = 'bg-danger text-white';
            }

            $data_per_line[] = [
                'line' => $line->name,
                'target' => $target,
                'output' => $output,
                'variance' => $variance,
                'forecast' => $forecast,
                'forecast_target' => $forecast_target,
                'forecast_variance' => $forecast_variance,
                'efficiency_target' => $efficiency_target,
                'efficiency_actual' => $efficiency_actual,
                'element_class' => $element_class,
            ];
        }

        $data_return = [
            'status' => 'success',
            'message' => 'successfully get data dashboard',
            'data' => [
                'data_per_line' => $data_per_line
            ],
        ];

        return $this->response->setJSON($data_return);
    }
}
