<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OutputRecordModel;
use App\Models\GlModel;
use App\Models\LineModel;

use CodeIgniter\I18n\Time;


class DashboardProductionsController extends BaseController
{
    protected $OutputRecordModel;
    protected $GlModel;
    protected $LineModel;

    public function __construct()
    {
        helper('date');

        $this->OutputRecordModel = new OutputRecordModel();
        $this->GlModel = new GlModel();
        $this->LineModel = new LineModel();
    }

    public function index()
    {
        return view('dashboard-production/index');
    }

    public function getDataDashboard()
    {
        // dd($this->request->getGet());
        $line_id = $this->request->getGet('line_id');
        $gl_id = $this->request->getGet('gl_id');

        $line = $this->LineModel->find($line_id);
        $gl = $this->GlModel->find($gl_id);

        // $date_today = new Time('now', 'Asia/Jakarta','id_ID');
        $date_today = Time::createFromFormat('Y-m-d', '2023-04-27', 'Asia/Jakarta');
        $date_filter = $date_today->toDateString();
        $date_show = $date_today->toLocalizedString('d MMMM yyyy');

        
        $output_records = $this->OutputRecordModel
                                ->where('line_id', $line->id)
                                ->where('gl_id', $gl->id)
                                ->where('time_date', $date_filter)
                                ->orderBy('time_hours_of', 'ASC')
                                ->findAll();

        if(!$output_records) {
            $data_return = [
                'status' => 'error',
                'message' => 'Data not found'
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
        if($variance_cumulative > 0) {
            $variance_cumulative = '+' . $variance_cumulative;
        }
        
        if($sum_output < $sum_target) {
            $output_class = 'down';
        }

        $forecast = round(($sum_output / count($output_records)) * 10);
        $achievement = round(($sum_output / $sum_target) * 100) . ' %';

        $data_panel = [
            'line' => $line->name,
            'gl_number' => $gl->gl_number,
            'date_show' => $date_show,
            'target' => $sum_target,
            'output' => $sum_output,
            'forecast' => $forecast,
            'output_class' => $output_class,
            'variance_cumulative' => $variance_cumulative,
            'achievement' => $achievement,
        ];

        for ($i=0; $i < 10; $i++) {
            
            if (array_key_exists($i, $output_records)) {
                $element_class = '';
                if($output_records[$i]->output < $output_records[$i]->target) {
                    $element_class = 'bg-danger text-white';
                }

                $data_output_records[$i] = [
                    'time_hours_of' => $output_records[$i]->time_hours_of,
                    'target' => $output_records[$i]->target,
                    'output' => $output_records[$i]->output,
                    'endline_ftt' => $output_records[$i]->endline_ftt,
                    'element_class' => $element_class
                ];

            } else {
                $data_output_records[$i] = [
                    'time_hours_of' => $i + 1,
                    'target' => '-',
                    'output' => '-',
                    'endline_ftt' => '-',
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

}
