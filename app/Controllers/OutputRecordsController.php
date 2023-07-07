<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OutputRecordModel;
use App\Models\GlModel;
use App\Models\LineModel;
use App\Models\RemarkModel;

use CodeIgniter\I18n\Time;

use \Hermawan\DataTables\DataTable;

helper('form');

class OutputRecordsController extends BaseController
{
    protected $OutputRecordModel;
    protected $GlModel;
    protected $LineModel;
    protected $RemarkModel;

    public function __construct()
    {
        $this->OutputRecordModel = new OutputRecordModel();
        $this->GlModel = new GlModel();
        $this->LineModel = new LineModel();
        $this->RemarkModel = new RemarkModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Output Records',
            'page_title' => 'Output Records',
            // 'output_records' => $this->OutputRecordModel->getData(),
            'gls' => $this->GlModel->getData(),
            'lines' => $this->LineModel->getData(),
            'remarks' => $this->RemarkModel->getData(),
        ];
        // dd($data);
        return view('output-records/index', $data);
    }

    public function dtableOutputRecord()
    {
        $output_records = $this->OutputRecordModel->getDatatable();
        return DataTable::of($output_records)
            ->addNumbering('DT_RowIndex')
            ->add('action', function($row){
                $action_button = '
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="edit_output_record('. $row->id .')">Edit</a>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_output_record('. $row->id .')">Delete</a>
                ';
                return $action_button;
            })
            ->postQuery(function($builder){
                $builder->orderBy('time_date','desc');
                $builder->orderBy('line_id');
                $builder->orderBy('time_hours_of','desc');

            })->toJson(true);
    }

    public function show($id) {
        dd("masuk",$id);
    }

    public function create() {
        $data = [
            'title' => 'Create Output Records',
            'page_title' => 'Create Output Records',
            'gls' => $this->GlModel->getData(),
            'lines' => $this->LineModel->getData(),
            'remarks' => $this->RemarkModel->getData(),
        ];
        return view('output-records/create', $data);
    }
    public function store(){
        // dd($this->request->getPost());
        $rules = [
            'time_date' => 'required',
            'gl_number' => 'required',
            'line' => 'required',
            'time_hours_of' => 'required',
            'target' => 'required',
            'output' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('output-records')->with('error', 'Something is wrong!');
        }

        $time_date = $this->request->getPost('time_date');
        $line = $this->request->getPost('line');
        $time_hours_of = $this->request->getPost('time_hours_of');

        $check_double_record = $this->OutputRecordModel
                                ->where('time_date', $time_date)
                                ->where('line_id', $line)
                                ->where('time_hours_of', $time_hours_of)
                                ->find();
        
        if($check_double_record) {
            
            $date_show = Time::createFromFormat('Y-m-d', $time_date, 'Asia/Jakarta');
            $date_show = $date_show->toLocalizedString('d MMMM yyyy');
            $line_show = $this->LineModel->find($line);

            return redirect()->to('output-record-create')->with('error', 'Data output pada tanggal '. $date_show .', untuk Line '. $line_show->name .' pada jam ke '. $time_hours_of . ' sudah ada!');
        }

        $this->OutputRecordModel->insert([
            'time_date' => $this->request->getPost('time_date'),
            'gl_id' => $this->request->getPost('gl_number'),
            'line_id' => $this->request->getPost('line'),
            'time_hours_of' => $this->request->getPost('time_hours_of'),
            'target' => $this->request->getPost('target'),
            'output' => $this->request->getPost('output'),
            'defect_qty' => $this->request->getPost('defect_qty'),
            'remark_id' => $this->request->getPost('remark') ? $this->request->getPost('remark') : null,
        ]);
        return redirect()->to('output-record-create')->with('success', 'Successfully added Output Record');
    }

    public function update($id){
        $rules = [
            'time_date' => 'required',
            'gl_number' => 'required',
            'line' => 'required',
            'time_hours_of' => 'required',
            'target' => 'required',
            'output' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('output-records')->with('error', 'Something is wrong!');
        }

        $time_date = $this->request->getPost('time_date');
        $line = $this->request->getPost('line');
        $time_hours_of = $this->request->getPost('time_hours_of');
        
        $check_double_record = $this->OutputRecordModel
                                ->where('time_date', $time_date)
                                ->where('line_id', $line)
                                ->where('time_hours_of', $time_hours_of)
                                ->where('id !=', $id)
                                ->first();
        
        if($check_double_record) {

            $date_show = Time::createFromFormat('Y-m-d', $time_date, 'Asia/Jakarta');
            $date_show = $date_show->toLocalizedString('d MMMM yyyy');
            $line_show = $this->LineModel->find($line);
            
            return redirect()->to('output-records')->with('error', 'Data output pada tanggal '. $date_show .', untuk Line '. $line_show->name .' pada jam ke '. $time_hours_of . ' sudah ada!');
        }
        
        $data = [
            'time_date' => $this->request->getPost('time_date'),
            'gl_id' => $this->request->getPost('gl_number'),
            'line_id' => $this->request->getPost('line'),
            'time_hours_of' => $this->request->getPost('time_hours_of'),
            'target' => $this->request->getPost('target'),
            'output' => $this->request->getPost('output'),
            'defect_qty' => $this->request->getPost('defect_qty'),
            'remark_id' => $this->request->getPost('remark') ? $this->request->getPost('remark') : null,

        ];
        $this->OutputRecordModel->update($id,$data);

        return redirect()->to('output-records')->with('success', 'Successfully updated Output Record');
    }

    public function edit($id){
        try {
            $data = $this->OutputRecordModel->find($id);
            if(!$data) {
                throw new \Exception('Data Output Record not Found');
            }
            return $this->response->setJSON($data, 200);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $output_records = $this->OutputRecordModel->find($id);
            if($output_records) {
                $this->OutputRecordModel->delete($id);
            } else {
                throw new \Exception('Data Output Record not Found');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $output_records,
                'message'=> 'Data Output Record Deleted Successfully',
            ];
            return $this->response->setJSON($date_return, 200);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
