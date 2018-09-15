<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="modal fade" id="editInstructor_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method='post' id='form_editInstructor'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Edit Instructor</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type='hidden' name='ID' id='ID'>
                                <label for="Name">Name</label>
                                <input type="text" name="Name" id="Name" placeholder="Instructor name" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" name="Address" id="Address" placeholder="Instructor address" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Position">Position</label>
                                <input type="text" name="Position" id="Position" placeholder="Instructor position" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Gender">Gender</label>
                                <select class='form-control' name='Gender' id='Gender' required>
                                    <option value=''>-- Select gender --</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="civil_status">Civil Status</label>
                                <select class='form-control' name='civil_status' id='civil_status' required>
                                    <option value=''>-- Select civil status --</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="text" name="Email" id="Email" placeholder="Instructor email" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Specialization">Specialization</label>
                                <input type="text" name="Specialization" id="Specialization" placeholder="Instructor specialization" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="employment_status">Employment Status</label>
                                <select class='form-control' name='employment_status' id='employment_status' required>
                                    <option value=''>-- Select employment status --</option>
                                    <option>Active</option>
                                    <option>Resigned</option>
                                    <option>Retired</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class='fa fa-close'></i> Close</button>
                    <button type="submit" class="btn btn-success"><i class='fa fa-check'></i> Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            <!--LEFT DIV  -->
            <div class="col-md-3">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Instructor</h3>
                    </div>
                    <form method='post' id='form_addInstructor'>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="instructor_name">Name</label>
                                <input type='text' name='instructor_name' placeholder='Name' class='form-control' >
                                <input type='hidden' name='ID' id='ID'>
                            </div>
                            <div class="form-group">
                                <label for="instructor_address">Address</label>
                                <input type='text' name='instructor_address' placeholder='Address' class='form-control' >
                            </div>
                            <div class="form-group">
                                <label for="instructor_position">Position</label>
                                <input type='text' name='instructor_position' placeholder='Position' class='form-control' >
                            </div>
                            <div class="form-group">
                                <label for="instructor_gender">Gender</label>
                                <select class='form-control' name='instructor_gender' required>
                                    <option value=''>-- Select gender --</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="instructor_civil_status">Civil Status</label>
                                <select class='form-control' name='instructor_civil_status' required>
                                    <option value=''>-- Select civil status --</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="instructor_email_address">Email</label>
                                <input type='text' name='instructor_email_address' placeholder='Email' class='form-control' >
                            </div>
                            <div class="form-group">
                                <label for="instructor_specialization">Specialization</label>
                                <input type='text' name='instructor_specialization' placeholder='Specialization' class='form-control' >
                            </div>
                            <div class="form-group">
                                <label for="instructor_employment_status">Employment Status</label>
                                <select class='form-control' name='instructor_employment_status' required>
                                    <option value=''>-- Select employment status --</option>
                                    <option>Active</option>
                                    <option>Resigned</option>
                                    <option>Retired</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class='pull-right'>
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button> &nbsp;
                                <button type="reset" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--RIGHT DIV  -->
            <div class="col-md-9">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h3 class="box-title">List of Instructor</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                        <input type="text" id="table_search" class="form-control pull-right" placeholder="Search instructor">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive" id="instructorTable"></div>
                </div>
            </div>
        </div>
    </section>
</div>
 
 <script src="<?php echo base_url($plugins_dir . '/bootstrap-confirmation/bootstrap-confirmation.min.js'); ?>"></script>
 <script src="<?php echo base_url($plugins_dir . '/bootstrap-confirmation/bootstrap-confirmation.js'); ?>"></script>
<script>
    $(function(){
        $('#overlay').html('<i class="fa fa-refresh fa-spin"></i>');
        
        // AJAX DISPLAY
        displayInstructor();

        function displayInstructor()
        {
            LoadDataFromUrlToTable('instructors/getAll', 'instructorTable');
        }

        $('#form_addInstructor').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: '<?=base_url('admin/instructors/add')?>',
                data: $(this).serialize(),
                type: 'post',
                success: function(data)
                {
                    toastr.success('Instructor successfully added!');
                    displayInstructor();
                }
            });
        });

        $(document).on('click', 'button[id^="edit"]', function(){
            var id = ($(this)[0].id).split('_')[1];
            $.ajax({
                url: '<?=base_url('admin/instructors/getInstructor')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index,element){
                        $('#ID').val(element.ID);
                        $('#Name').val(element.instructor_name);
                        $('#Address').val(element.instructor_address);
                        $('#Position').val(element.instructor_position);
                        $('#Gender').val(element.instructor_gender);
                        $('#civil_status').val(element.instructor_civil_status);
                        $('#Email').val(element.instructor_email_address);
                        $('#Specialization').val(element.instructor_specialization);
                        $('#employment_status').val(element.instructor_employment_status);
                    });
                    $('#editInstructor_modal').modal('show');
                }
            });
        });

        $(document).on('submit', '#form_editInstructor', function(e){
            e.preventDefault();
            PutDataToUrl($(this).serialize(), 'instructors/edit').then(function(data){
                switch (data.content.status) {
                    case 'error':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_editInstructor')[0].reset();
                        $('#editInstructor_modal').modal('hide');
                        toastr.success(data.content.message);
                        displayInstructor();
                        break;
                    default:
                        break;
                }
            });
        });

        $(document).on('mouseover', 'a[id^="delete"]', function(e){
            e.preventDefault();
            let id = ($(this)[0].id).split('_')[1];
            $('#'+$(this)[0].id+'').confirmation({
                onConfirm: function(){
                    DeleteDataFromUrl({id:id}, 'instructors/delete').then(function(data){
                        toastr.success(data.content.message);
                        displayInstructor();
                    })
                },
                onCancel: function(){}
            });  
        });

        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("instructorTable");
            tr = table.getElementsByTagName("tr");
            console.log(tr);
            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[2];
                td4 = tr[i].getElementsByTagName("td")[3];
                td5 = tr[i].getElementsByTagName("td")[4];
                td6 = tr[i].getElementsByTagName("td")[5];
                td7 = tr[i].getElementsByTagName("td")[6];
                td8 = tr[i].getElementsByTagName("td")[7];
                td9 = tr[i].getElementsByTagName("td")[8];
                
                
                if (td1) {
                    if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 ||
                     td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1 || td5.innerHTML.toUpperCase().indexOf(filter) > -1
                      || td6.innerHTML.toUpperCase().indexOf(filter) > -1 || td7.innerHTML.toUpperCase().indexOf(filter) > -1 || td8.innerHTML.toUpperCase().indexOf(filter) > -1
                       || td9.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }   
                
            }
            
        });
    });
</script>