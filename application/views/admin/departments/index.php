<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
<!-- // MODALS -->
<div class="modal fade" id="editDepartment_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method='post' id='form_editDepartment'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Edit Department</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code">Description</label>
                        <input type='text' class='form-control' id='description1' name='description1' placeholder='eg. DIT'>
                        <input type='hidden' class='form-control' id='ID' name='ID'>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class='fa fa-close'></i> Close</button>
                    <button type="submit" class="btn btn-success"><i class='fa fa-check'></i> Save department</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- // MODALS -->
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            <!--LEFT DIV  -->
            <div class="col-md-3">
                
                <div class="box box-success box-solid">
                    <div class="box-header ">
                    <h3 class="box-title">New Department</h3>
                    </div>
                    <?php echo form_open('', array("id" => "form_addDepartment")); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="code">Description</label>
                            <textarea class='form-control' id='description' name='description' placeholder='eg. DIT'></textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class='pull-right'>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Submit</button> &nbsp;
                            <button type="reset" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    
                </div>
                  
            </div>
            <!--RIGHT DIV  -->
            <div class="col-md-9" id='listDiv'>
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h3 class="box-title">List of Departments</h3>

                    <div class="box-tools">
                        
                        <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                        
                            <input type="text" id="table_search" class="form-control pull-right" placeholder="Search student">
                            
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-header -->
                        <div class="box-body table-responsive" id='departmentTable'>
                            
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>


<script>
    $(function(){
        // AJAX DISPLAY
        displayDepartments();

        function displayDepartments()
        {
            LoadDataFromUrlToTable('departments/getAll', 'departmentTable')
            
        }
        // POST DEPARTMENT
        $(document).on('submit', '#form_addDepartment', function(e){
            e.preventDefault();
            PostDataToUrl($(this).serialize(), 'departments/add').then(function(data){
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_addDepartment')[0].reset();
                        toastr.success(data.content.message);
                        displayDepartments();
                        
                        break;
                    default:
                        break;
                }
            });
        })

        // PUT DEPARTMENT
        $(document).on('submit', '#form_editDepartment', function(e){
            e.preventDefault();
            PutDataToUrl($(this).serialize(), 'departments/edit').then(function(data){
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_addDepartment')[0].reset();
                        toastr.success(data.content.message);
                        $('#editDepartment_modal').modal('hide');
                        displayDepartments();
                        break;
                    default:
                        break;
                }
            });
        })

        
        // SELECT DEPARTMENT TO BE EDIT
        $(document).on('click', "button[id^='edit']", function(e){
            e.preventDefault();
            var id = ($(this)[0].id).split('_')[1];
            $.ajax({
                url: '<?=base_url('admin/departments/getDepartment')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $('#ID').val(data.ID);
                    $('#description1').val(data.Department);
                    $('#editDepartment_modal').modal('show');
                }
            });
        });
        


        //DELETE DEPARTMENT
        $(document).on('mouseover', 'a[class^="btn"]', function(e){
            e.preventDefault();
            let id = ($(this)[0].id).split('_')[1];
            $('#'+$(this)[0].id+'').confirmation({
                onConfirm: function(){
                    DeleteDataFromUrl({id:id}, 'departments/delete').then(function(data){
                        toastr.success(data.content.message);
                        
                        displayDepartments();
                    })
                },
                onCancel: function(){}
            });  
        });
    });
</script>