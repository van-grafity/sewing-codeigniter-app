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
                            <h3 class="card-title">Manage Buyers</h3>
                            <div class="d-flex justify-content-end mb-1">
                                <a href="javascript:void(0);" class="btn btn-success mb-2" id="btn_modal_create">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="buyer_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Buyer Name</th>
                                        <th>Office Address</th>
                                        <th>Ship Address</th>
                                        <th>Country</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($buyers as $key => $buyer) : ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $buyer->buyer_name ?></td>
                                        <td><?= $buyer->offadd ?></td>
                                        <td><?= $buyer->shipadd ?></td>
                                        <td><?= $buyer->country ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="edit_buyer(<?= $buyer->id ?>)">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_buyer(<?= $buyer->id ?>)">Delete</a>
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
                <h5 class="modal-title" id="modal_formLabel">Add Buyer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="custom-validation" enctype="multipart/form-data" id="buyer_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="buyer_name">Buyer Name</label>
                            <input type="text" class="form-control" id="buyer_name" name="buyer_name" placeholder="Enter Buyer Name" required>
                        </div>
                        <div class="form-group">
                            <label for="offadd">Office Address</label>
                            <textarea class="form-control" id="offadd" name="offadd" placeholder="Enter Office Address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="shipadd">Ship Address</label>
                            <textarea class="form-control" id="shipadd" name="shipadd" placeholder="Enter Ship Address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
                        </div>
                    </div>
                    <!-- END .card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit">Add Buyer</button>
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
        create_buyer()
    })
})
</script>

<script type="text/javascript">

    // ## Datatable Initialize
    const dtable_url = "<?= url_to('dtable_buyer') ?>";
    $('#buyer_table').DataTable({
        // processing: true,
        // serverSide: true,
        // ajax: dtable_url,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'buyer_name', name: 'buyer_name'},
            {data: 'offadd', name: 'offadd'},
            {data: 'shipadd', name: 'shipadd'},
            {data: 'country', name: 'country'},
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
    const store_url ='<?= url_to('buyer_store') ?>';
    const delete_url ='<?= url_to('buyer_destroy',':id') ?>';
    const edit_url ='<?= url_to('buyer_edit',':id') ?>';
    const update_url ='<?= url_to('buyer_update',':id') ?>';

    function create_buyer() {
        $('#modal_formLabel').text("Add Buyer")
        $('#btn_submit').text("Add Buyer")
        $('#buyer_form').attr('action', store_url);
        $('#buyer_form').find("input[type=text], textarea").val("");
        $('#buyer_form').find('input[name="_method"]').remove();
        $('#modal_form').modal('show')
    }
    
    async function edit_buyer(buyer_id) {
        let url_edit = edit_url.replace(':id',buyer_id);
        
        result = await get_using_fetch(url_edit);
        form = $('#buyer_form')
        form.append('<input type="hidden" name="_method" value="PUT">');
        $('#modal_formLabel').text("Edit Buyer");
        $('#btn_submit').text("Save");

        let url_update = update_url.replace(':id',buyer_id);
        form.attr('action', url_update);
        form.find('input[name="buyer_name"]').val(result.buyer_name);
        form.find('textarea[name="offadd"]').text(result.offadd);
        form.find('textarea[name="shipadd"]').text(result.shipadd);
        form.find('input[name="country"]').val(result.country);

        $('#modal_form').modal('show')
    }

    async function delete_buyer(buyer_id) {
        data = { title: "Are you sure?" };
        let confirm_delete = await swal_delete_confirm(data);
        if(!confirm_delete) { return false; };

        let url_delete = delete_url.replace(':id',buyer_id);
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
