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
                            <h3 class="card-title">Manage Remarks</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="javascript:void(0);" class="btn btn-success mb-2" id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="remark_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Remark</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($remarks as $key => $remark) : ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $remark->remark ?></td>
                                        <td><?= $remark->description ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="edit_remark(<?= $remark->id ?>)">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_remark(<?= $remark->id ?>)">Delete</a>
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
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_formLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_formLabel">Add Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="custom-validation" enctype="multipart/form-data" id="remark_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <input type="text" class="form-control" id="remark" name="remark" placeholder="Enter Remark">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <!-- END .card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit">Add Remark</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->Section('page_script'); ?>
<script type="text/javascript">
$(document).ready(function(){

    // ## Show Flash Message
    let session = <?= json_encode(session()->getFlashdata()) ?>;
    show_flash_message(session);

    $('#btn_modal_create').click((e) => {
        create_remark()
    })
})
</script>

<script type="text/javascript">

    // ## Datatable Initialize
    const dtable_url = "<?= url_to('dtable_remark') ?>";
    $('#remark_table').DataTable({
        // processing: true,
        // serverSide: true,
        // ajax: dtable_url,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'remark', name: 'remark'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
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
    const store_url ='<?= url_to('remark_store') ?>';
    const delete_url ='<?= url_to('remark_destroy',':id') ?>';
    const edit_url ='<?= url_to('remark_edit',':id') ?>';
    const update_url ='<?= url_to('remark_update',':id') ?>';

    function create_remark() {
        $('#modal_formLabel').text("Add Remark")
        $('#btn_submit').text("Add Remark")
        $('#remark_form').attr('action', store_url);
        $('#remark_form').find("input[type=text], textarea").val("");
        $('#remark_form').find('input[name="_method"]').remove();
        $('#modal_form').modal('show')
    }
    
    async function edit_remark(remark_id) {
        let url_edit = edit_url.replace(':id',remark_id);
        
        result = await get_using_fetch(url_edit);
        form = $('#remark_form')
        form.append('<input type="hidden" name="_method" value="PUT">');
        $('#modal_formLabel').text("Edit Remark");
        $('#btn_submit').text("Save");

        let url_update = update_url.replace(':id',remark_id);
        form.attr('action', url_update);
        form.find('input[name="remark"]').val(result.remark);
        form.find('textarea[name="description"]').text(result.description);

        $('#modal_form').modal('show')
    }

    async function delete_remark(remark_id) {
        data = { title: "Are you sure?" };
        let confirm_delete = await swal_delete_confirm(data);
        if(!confirm_delete) { return false; };

        let url_delete = delete_url.replace(':id',remark_id);
        let data_params = { token };
        result = await delete_using_fetch(url_delete, data_params)

        if(result.status == "success"){
            swal_info({
                title : result.message,
                reload_option: true, 
            });
        } else {
            swal_failed({ title: result.message });
        }
    }
</script>

<?= $this->endSection('page_script'); ?>
