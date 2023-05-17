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
                            <h3 class="card-title">Manage GL</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="javascript:void(0);" class="btn btn-success mb-2" id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="gl_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>GL Number</th>
                                        <th>Season</th>
                                        <th>Buyer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($gls as $key => $gl) : ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $gl->gl_number ?></td>
                                        <td><?= $gl->season ?></td>
                                        <td><?= $gl->buyer ? $gl->buyer->buyer_name : '' ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="edit_gl(<?= $gl->id ?>)">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_gl(<?= $gl->id ?>)">Delete</a>
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
                <h5 class="modal-title" id="modal_formLabel">Add GL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="custom-validation" enctype="multipart/form-data" id="gl_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="gl_number">GL Number</label>
                            <input type="text" class="form-control" id="gl_number" name="gl_number" placeholder="Enter GL Number" required>
                        </div>
                        <div class="form-group">
                            <label for="season">Season</label>
                            <input type="text" class="form-control" id="season" name="season" placeholder="Enter Season">
                        </div>
                        <div class="form-group">
                            <label for="Buyer" class="form-label">Buyer</label>
                            <select name="buyer" class="form-control select2" id="buyer" style="width: 100%;" data-placeholder="Choose Buyer" required>
                                <option value="">Choose Buyer</option>
                                <?php foreach ($buyers as $key => $buyer) { ?>
                                    <option value="<?= $buyer->id ?>"><?= $buyer->buyer_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- END .card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit">Add GL</button>
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
        create_gl()
    })
})
</script>

<script type="text/javascript">

    // ## Datatable Initialize
    const dtable_url = "<?= url_to('dtable_gl') ?>";
    $('#gl_table').DataTable({
        // processing: true,
        // serverSide: true,
        // ajax: dtable_url,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'gl_number', name: 'gl_number'},
            {data: 'season', name: 'season'},
            {data: 'buyer', name: 'buyer'},
            {data: 'action', name: 'action'},
        ],
        columnDefs: [
            { targets: [ 0 ,-1], orderable: false, searchable: false },
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
    const store_url ='<?= url_to('gl_store') ?>';
    const delete_url ='<?= url_to('gl_destroy',':id') ?>';
    const edit_url ='<?= url_to('gl_edit',':id') ?>';
    const update_url ='<?= url_to('gl_update',':id') ?>';

    function create_gl() {
        $('#modal_formLabel').text("Add GL")
        $('#btn_submit').text("Add GL")
        $('#gl_form').attr('action', store_url);
        $('#gl_form').find("input[type=text], textarea").val("");
        $('#gl_form').find('input[name="_method"]').remove();
        $('#gl_form').find("select").val("").change();
        $('#modal_form').modal('show')
    }
    
    async function edit_gl(gl_id) {
        let url_edit = edit_url.replace(':id',gl_id);
        
        result = await get_using_fetch(url_edit);
        form = $('#gl_form')
        form.append('<input type="hidden" name="_method" value="PUT">');
        $('#modal_formLabel').text("Edit GL");
        $('#btn_submit').text("Save");

        let url_update = update_url.replace(':id',gl_id);
        form.attr('action', url_update);
        form.find('input[name="gl_number"]').val(result.gl_number);
        form.find('input[name="season"]').val(result.season);
        form.find('select[name="buyer"]').val(result.buyer_id).change();

        $('#modal_form').modal('show')
    }

    async function delete_gl(gl_id) {
        data = { title: "Are you sure?" };
        let confirm_delete = await swal_delete_confirm(data);
        if(!confirm_delete) { return false; };

        let url_delete = delete_url.replace(':id',gl_id);
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
