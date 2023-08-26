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
                            <h3 class="card-title">Manage Slideshow</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="javascript:void(0);" class="btn btn-success mb-2" id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="slideshow_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Group</th>
                                        <th width="40%">Line List</th>
                                        <th width="10%">Date</th>
                                        <th width="15%">Action</th>
                                        <th width="10%">Toggle Active</th>
                                        <th width="10%">Show Dashboard</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($slideshows as $key => $slideshow) : ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $slideshow->groups->name ?></td>
                                        <td>
                                            <?php foreach ($slideshow->linelist as $key => $line) { ?>
                                                <button class="btn-pill bg-maroon"><?= $line->name ?></button>
                                            <?php } ?>
                                        </td>
                                        <td><?= $slideshow->time_date ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="edit_slideshow(<?= $slideshow->id ?>)">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_slideshow(<?= $slideshow->id ?>)">Delete</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn <?= $slideshow->status_class ?> btn-sm" onclick="toggle_status(<?= $slideshow->id ?>)" data-flag-active="<?= $slideshow->flag_active ?>"><?= $slideshow->status_text ?></a>
                                        </td>
                                        <td>
                                            <?php if($slideshow->flag_active) : ?>
                                                <a href="<?= url_to('dashboard-production-date',$slideshow->time_date)?>" target="_blank" class="btn btn-info btn-sm">Show Dashboard</a>
                                            <?php else : ?>
                                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm disabled" data-toggle="tooltip" data-placement="top" title="Tooltip on top" >Show Dashboard</a>
                                            <?php endif ?>
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
                <h5 class="modal-title" id="modal_formLabel">Add Slideshow</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="custom-validation" enctype="multipart/form-data" id="slideshow_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="group" class="form-label">Group</label>
                            <select name="group" class="form-control select2" id="group" style="width: 100%;" data-placeholder="Choose Group" required>
                                <option value="">Choose Group</option>
                                <?php foreach ($groups as $key => $group) { ?>
                                    <option value="<?= $group->id ?>"><?= $group->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time_date">Date</label>
                            <input type="date" class="form-control" id="time_date" name="time_date" placeholder="Enter Date" required>
                        </div>
                    </div>
                    <!-- END .card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit">Add</button>
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
        create_slideshow()
    })
})
</script>

<script type="text/javascript">

    // ## Datatable Initialize
    const dtable_url = "<?= url_to('dtable_slideshow') ?>";
    $('#slideshow_table').DataTable({
        // processing: true,
        // serverSide: true,
        // ajax: dtable_url,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'group', name: 'group'},
            {data: 'linelist', name: 'linelist', orderable: false },
            {data: 'time_date', name: 'time_date',},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'toggle_active', name: 'toggle_active', orderable: false, searchable: false},
            {data: 'show_dashboard', name: 'show_dashboard', orderable: false, searchable: false},
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
    const store_url ='<?= url_to('slideshow_store') ?>';
    const delete_url ='<?= url_to('slideshow_destroy',':id') ?>';
    const edit_url ='<?= url_to('slideshow_edit',':id') ?>';
    const update_url ='<?= url_to('slideshow_update',':id') ?>';
    const toggle_active_url ='<?= url_to('slideshow_toggle_status') ?>';

    function create_slideshow() {
        $('#modal_formLabel').text("Add")
        $('#btn_submit').text("Add")
        $('#slideshow_form').attr('action', store_url);
        $('#slideshow_form').find("input[type=text], textarea").val("");
        $('#slideshow_form').find('input[name="_method"]').remove();
        
        $('#slideshow_form').find("input[type=number], input[type=date]").val(new Date().toJSON().slice(0, 10));
        $('#slideshow_form').find("select").val("").change();
        
        $('#modal_form').modal('show')
    }
    
    async function edit_slideshow(slideshow_id) {
        let url_edit = edit_url.replace(':id',slideshow_id);
        
        result = await get_using_fetch(url_edit);
        form = $('#slideshow_form')
        form.append('<input type="hidden" name="_method" value="PUT">');
        $('#modal_formLabel').text("Edit Group");
        $('#btn_submit').text("Save");

        let url_update = update_url.replace(':id',slideshow_id);
        form.attr('action', url_update);

        form.find('input[name="time_date"]').val(result.time_date);
        form.find('select[name="group"]').val(result.group_id).change();

        $('#modal_form').modal('show')
    }

    async function delete_slideshow(slideshow_id) {
        data = { title: "Are you sure?" };
        let confirm_delete = await swal_delete_confirm(data);
        if(!confirm_delete) { return false; };

        let url_delete = delete_url.replace(':id',slideshow_id);
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

    async function toggle_status(slideshow_id) {
        let flag_active = $(event.srcElement).data('flag-active');
        
        if(flag_active == 0) {
            data = { title: "Are you sure to Activate this Group?", confirm_button: "Activate", text: "Only this Group will be Active" };
        } else if(flag_active == 1) {
            data = { title: "Are you sure to Deactivate this Group?", confirm_button: "Deactivate" };
        } else {
            data = { title: "Something Wrong, Please Contact Administrator!" };
        }

        let confirm_action = await swal_confirm(data);
        if(!confirm_action) { return false; };

        let data_params = { token, id: slideshow_id };
        result = await using_fetch(toggle_active_url, data_params , 'GET')

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
