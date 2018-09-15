
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">

<!-- // MODALS -->


<div class="modal fade" id="editmodal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method='post' id='form_editRoom'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span></button>
                    <h4 class="modal-title">Edit Room</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Building Name</label>
                        <input type='text' name='room_building_name1' id='room_building_name1' class='form-control' required>
                    </div>
                    <div class="form-group">
                        
                        <div class='row'>
                            <div class='col-xs-6'>
                                <label>Number</label>
                                <input type='text' name='room_number1' id='room_number1' class='form-control' required>
                            </div>
                            <div class='col-xs-6'>
                                <label>Capacity</label>
                                <input type='number' name='room_capacity1' id='room_capacity1' class='form-control' required>
                            </div>
                            <input type='hidden' name='ID' id='ID'>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class='fa fa-close'></i> Close</button>
                    <button type="submit" class="btn btn-success"><i class='fa fa-check'></i> Save course</button>
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
                    <div class="box-header with-border">
                    <h3 class="box-title">New Rooms</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" id="form_addRoom">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="code">Building name</label>
                                <?php echo form_input($room_building_name);?>
                            </div>
                            <div class="form-group">
                                <div class='row'>
                                    <div class='col-xs-6'>
                                        <label for="code">Room number</label>
                                        <?php echo form_input($room_number);?>
                                    </div>
                                    <div class='col-xs-6'>
                                        <label for="code">Room capacity</label>
                                        <?php echo form_input($room_capacity);?>
                                    </div>
                                </div>
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
                        <h3 class="box-title">List of Rooms</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 200px;height: 27px;">
                                <input type="text" id="table_search" class="form-control pull-right" placeholder="Search room">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive" id='roomTable'>
                            
                    </div>
                    <div class="overlay" id='overlay'>
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                    
               
            </div>
        </div>
    </section>
</div>
 

<script>
    function confirm_delete(id){
            alert(id);
        }
    $(function(){
        // GET ROOMS
        displayRooms();
        function displayRooms()
        {
            LoadDataFromUrlToTable('rooms/getAll', 'roomTable');
        }
        //POST ROOM
        $('#form_addRoom').on('submit', function(e){
            e.preventDefault();
            PostDataToUrl($(this).serialize(), 'rooms/add').then(function(data){
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_addRoom')[0].reset();
                        toastr.success(data.content.message);
                        displayRooms();
                        break;
                    default:
                        break;
                }
            }); 
        })        
        //PUT ROOMS
        $('#form_editRoom').on('submit', function(e){
            e.preventDefault();
            PutDataToUrl($(this).serialize(), 'rooms/edit').then(function(data){
                switch (data.content.status) {
                    case 'duplicate':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        $('#form_editRoom')[0].reset();
                        $('#editmodal').modal('hide');
                        toastr.success(data.content.message);
                        displayRooms();
                        break;
                    default:
                        break;
                }
            });
        });


        // SELECT ROOM TO BE EDIT
        $(document).on('click', "button[id^='edit']", function(e){
            e.preventDefault();
            var id = ($(this)[0].id).split('_')[1];
            $.ajax({
                url: '<?=base_url('admin/rooms/getRoom')?>',
                data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $('#room_building_name1').val(data.room_building_name);
                    $('#room_number1').val(data.room_number);
                    $('#room_capacity1').val(data.room_capacity);
                    $('#ID').val(data.ID);
                    $('#editmodal').modal('show');
                }
            });
        });

        //DELETE ROOM
        $(document).on('mouseover', 'a[id^="delete"]', function(e){
            e.preventDefault();
            $('a[id^="delete"]').confirmation({
                onConfirm: function(){
                    var id = ($(this)[0].id).split('_')[1];
                    DeleteDataFromUrl({id:id}, 'rooms/delete').then(function(data){
                        toastr.success(data.content.message);
                        displayRooms();
                    })
                },
                onCancel: function(){}
            });
        });

        // USAHON ANG PAG SEARCHING SA KADA TABLE
        // E MODIFY AND ALGORITHM
        $('#table_search').keyup(function(){
            var txt = $('#table_search').val();
            var filter, table, tr, td, i;
            filter = txt.toUpperCase();
            table = document.getElementById("academicyearTable");
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