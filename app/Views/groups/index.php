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
                            <h3 class="card-title">Manage Group</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="javascript:void(0);" class="btn btn-success mb-2" id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="group_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Name</th>
                                        <th width="20%">Description</th>
                                        <th width="60%">Lines</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($groups as $key => $group) : ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $group->name ?></td>
                                        <td><?= $group->description ?></td>
                                        <td>
                                            <?php foreach ($group->linelist as $key => $line) { ?>
                                                <button class="btn-pill bg-maroon"><?= $line->name ?></button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="edit_group(<?= $group->id ?>)">Edit</a>
                                            <!-- <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_group(<?= $group->id ?>)">Delete</a> -->
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
                <h5 class="modal-title" id="modal_formLabel">Add Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="custom-validation" enctype="multipart/form-data" id="group_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Group Number">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label>Line List</label>
                            <select name="linelist[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" id="linelist">
                                <?php foreach ($lines as $key => $line) { ?>
                                    <option value="<?= $line->id ?>"><?= $line->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- END .card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit">Add Group</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->Section('page_script'); ?>
<script type="text/javascript">
$(document).ready(function(){

    $('.select2').select2();
    
    // ## Show Flash Message
    let session = <?= json_encode(session()->getFlashdata()) ?>;
    show_flash_message(session);

    $('#btn_modal_create').click((e) => {
        create_group()
    })
})
</script>

<script type="text/javascript">

    // ## Datatable Initialize
    const dtable_url = "<?= url_to('dtable_group') ?>";
    $('#group_table').DataTable({
        // processing: true,
        // serverSide: true,
        // ajax: dtable_url,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description', orderable: false},
            {data: 'lines', name: 'lines', orderable: false},
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
    const store_url ='<?= url_to('group_store') ?>';
    const delete_url ='<?= url_to('group_destroy',':id') ?>';
    const edit_url ='<?= url_to('group_edit',':id') ?>';
    const update_url ='<?= url_to('group_update',':id') ?>';

    function create_group() {
        $('#modal_formLabel').text("Add Group")
        $('#btn_submit').text("Add Group")
        $('#group_form').attr('action', store_url);
        $('#group_form').find("input[type=text], textarea").val("");
        $('#group_form').find('#linelist').val('').trigger('change');
        $('#group_form').find('input[name="_method"]').remove();
        $('#modal_form').modal('show')
    }
    
    async function edit_group(group_id) {
        let url_edit = edit_url.replace(':id',group_id);
        
        result = await get_using_fetch(url_edit);
        data_group = result.data.group;
        data_linelist = result.data.linelist;
        array_linelist = data_linelist.map(data => data.id);
        
        form = $('#group_form')
        form.append('<input type="hidden" name="_method" value="PUT">');
        $('#modal_formLabel').text("Edit Group");
        $('#btn_submit').text("Save");

        let url_update = update_url.replace(':id',group_id);
        form.attr('action', url_update);
        form.find('input[name="name"]').val(data_group.name);
        form.find('input[name="description"]').val(data_group.description);
        
        $('#linelist').val(array_linelist);
        $('#linelist').trigger('change'); 

        $('#modal_form').modal('show')
    }

    async function delete_group(group_id) {
        data = { title: "Are you sure?" };
        let confirm_delete = await swal_delete_confirm(data);
        if(!confirm_delete) { return false; };

        let url_delete = delete_url.replace(':id',group_id);
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
