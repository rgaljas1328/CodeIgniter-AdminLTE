<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
<!-- MODALS -->
<div class="modal fade" id="editStudent_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method='post' id='form_editStudent'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Edit Student</h4>
                </div>
                <div class="modal-body">
                    
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class='fa fa-close'></i> Close</button>
                    <button type="submit" class="btn btn-success"><i class='fa fa-check'></i> Save student</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- !MODALS -->
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            
            <!--RIGHT DIV  -->
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h3 class="box-title">List of Students</h3>

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
                    <div class="box-body table-responsive" >
                            <table id='studentTable' class="table table-bordered" role='grid'> 
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>


<script>
    $(function(){
        
        // AJAX DISPLAY
        displayStudent();

        function displayStudent()
        {
            LoadDataFromUrlToTable('students/getAll', 'studentTable');
        }

        //DELETE
        $(document).on('mouseover', 'a[id^="delete_"]', function(e){
            e.preventDefault();
            let id = ($(this)[0].id).split('_')[1];
            $('#'+$(this)[0].id+'').confirmation({
                onConfirm: function(){
                    DeleteDataFromUrl({id:id}, 'students/delete').then(function(data){
                        if(data.content.status == 'ok')
                            toastr.success(data.content.message);
                        else if(data.content.status == 'error')
                            toastr.error(data.content.message);
                        displayStudent();
                    })
                },
                onCancel: function(){}
            });
        });

        // SELECT STUDENT PROFILE
        $(document).on('mouseover', "a[id^='profile_']", function(e){
            e.preventDefault();
            var id = ($(this)[0].id).split('_')[1];
            $('#'+$(this)[0].id+'').confirmation({
                onConfirm: function(){},
                onCancel: function(){}
            }); 
        });

        // USAHON ANG PAG SEARCHING SA KADA TABLE
        // E MODIFY AND ALGORITHM
        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("studentTable");
            tr = table.getElementsByTagName("tr");
            console.log(tr);
            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[2];
                td4 = tr[i].getElementsByTagName("td")[3];
                
                if (td1) {
                    if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });
    });
</script>