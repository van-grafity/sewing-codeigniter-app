<?= $this->extend('layouts/template'); ?>

<?= $this->Section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $page_title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Output Records</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="javascript:void(0);" class="btn btn-success mb-2"
                                    id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="output_records_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Line</th>
                                        <th>Hours of</th>
                                        <th>GL Number</th>
                                        <th>Target</th>
                                        <th>Output</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($output_records as $key => $output_record) : ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $output_record->time_date ?></td>
                                        <td><?= $output_record->lines->name ?></td>
                                        <td><?= $output_record->time_hours_of ?></td>
                                        <td><?= $output_record->gls->gl_number ?></td>
                                        <td><?= $output_record->target ?></td>
                                        <td><?= $output_record->output ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                                onclick="edit_output_record(<?= $output_record->id ?>)">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                                onclick="delete_output_record(<?= $output_record->id ?>)">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>


<!-- Modal Section -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_formLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_formLabel">Add Output Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="custom-validation" enctype="multipart/form-data" id="output_record_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="time_date">Date</label>
                                    <input type="date" class="form-control" id="time_date" name="time_date" placeholder="Enter Date" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="gl_number" class="form-label">GL Number</label>
                                    <select name="gl_number" class="form-control select2" id="gl_number"
                                        style="width: 100%;" data-placeholder="Choose GL Number" required>
                                        <option value="">Choose GL Number</option>
                                        <?php foreach ($gls as $key => $gl) { ?>
                                            <option value="<?= $gl->id ?>"><?= $gl->gl_number ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="line" class="form-label">Line</label>
                                    <select name="line" class="form-control select2" id="line" style="width: 100%;" data-placeholder="Choose Line" required>
                                        <option value="">Choose Line</option>
                                        <?php foreach ($lines as $key => $line) { ?>
                                            <option value="<?= $line->id ?>"><?= $line->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="line" class="form-label">Hours of</label>
                                    <select name="time_hours_of" class="form-control select2" id="time_hours_of" style="width: 100%;" data-placeholder="Choose Hours of" required>
                                        <option value="">Choose Hours of</option>
                                        <?php for ($i=1; $i <= 10; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <input type="number" class="form-control" id="target" name="target" placeholder="Enter Target" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="output">Output</label>
                                    <input type="number" class="form-control" id="output" name="output" placeholder="Enter Output">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="defact_qty">Defact Qty</label>
                                    <input type="number" class="form-control" id="defact_qty" name="defact_qty" placeholder="Enter Defact Qty">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="endline_ftt">Endline FTT</label>
                                    <input type="number" class="form-control" id="endline_ftt" name="endline_ftt" placeholder="Enter Endline FTT">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END .card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit">Add Output Records</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->Section('page_script'); ?>
<script type="text/javascript">
$(document).ready(function() {

    // ## Show Flash Message
    let session = <?= json_encode(session()->getFlashdata()) ?>;
    show_flash_message(session);

    $('#btn_modal_create').click((e) => {
        create_output_record()
    })
})
</script>

<script type="text/javascript">
// ## Datatable Initialize
const dtable_url = "<?= url_to('dtable_output_record') ?>";
$('#output_records_table').DataTable({
    // processing: true,
    // serverSide: true,
    // ajax: dtable_url,
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'time_date',
            name: 'time_date'
        },
        {
            data: 'line',
            name: 'line'
        },
        {
            data: 'time_hours_of',
            name: 'time_hours_of'
        },
        {
            data: 'gl_number',
            name: 'gl_number'
        },
        {
            data: 'target',
            name: 'target'
        },
        {
            data: 'output',
            name: 'output'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    paging: true,
    responsive: true,
    lengthChange: true,
    searching: true,
    autoWidth: false,
});
</script>

<script type="text/javascript">
const token = document.querySelector('meta[name="X-CSRF-TOKEN"]').getAttribute('content');
const store_url = '<?= url_to('output_record_store') ?>';
const delete_url = '<?= url_to('output_record_destroy',':id') ?>';
const edit_url = '<?= url_to('output_record_edit',':id') ?>';
const update_url = '<?= url_to('output_record_update',':id') ?>';

function create_output_record() {
    $('#modal_formLabel').text("Add Output Records")
    $('#btn_submit').text("Add Output Records")
    $('#output_record_form').attr('action', store_url);
    $('#output_record_form').find("input[type=text], textarea").val("");
    $('#output_record_form').find("input[type=number], input[type=date]").val("");
    $('#output_record_form').find("select").val("").change();
    $('#output_record_form').find('input[name="_method"]').remove();
    $('#modal_form').modal('show')
}

async function edit_output_record(output_record_id) {
    let url_edit = edit_url.replace(':id', output_record_id);

    result = await get_using_fetch(url_edit);
    form = $('#output_record_form')
    form.append('<input type="hidden" name="_method" value="PUT">');
    $('#modal_formLabel').text("Edit Output Records");
    $('#btn_submit').text("Save");

    let url_update = update_url.replace(':id', output_record_id);
    form.attr('action', url_update);

    form.find('input[name="time_date"]').val(result.time_date);
    form.find('select[name="gl_number"]').val(result.gl_id).change();
    form.find('select[name="line"]').val(result.line_id).change();
    form.find('select[name="time_hours_of"]').val(result.time_hours_of).change();
    form.find('input[name="target"]').val(result.target);
    form.find('input[name="output"]').val(result.output);
    form.find('input[name="defact_qty"]').val(result.defact_qty);
    form.find('input[name="endline_ftt"]').val(result.endline_ftt);

    $('#modal_form').modal('show')
}

async function delete_output_record(output_record_id) {
    data = {
        title: "Are you sure?"
    };
    let confirm_delete = await swal_delete_confirm(data);
    if (!confirm_delete) {
        return false;
    };

    let url_delete = delete_url.replace(':id', output_record_id);
    let data_params = {
        token
    };
    result = await delete_using_fetch(url_delete, data_params)

    if (result.status == "success") {
        swal_info({
            title: result.message,
            reload_option: true,
        });
    } else {
        swal_failed({
            title: result.message
        });
    }
}
</script>

<?= $this->endSection('page_script'); ?>