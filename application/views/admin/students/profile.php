<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper" style="min-height: 1126px;">
    
<section class="content-header">
        <h1><?php echo "Profile"; ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/dashboard">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a> 
            </li>
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/courses">
                    <i class="fa fa-dashboard"></i> Student
                </a> 
            </li>
            <li class="active">Profile

            </li>
        </ol>
      
    </section>

    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile">
                <!-- Profile Picture -->
                <form id='updatePicture' method='post' enctype='multipart/form-data'>
                    <center>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                        <img id='pic' src="<?php 
                            foreach ($students as $student)
                            {
                                echo ($student['student_picture'] == '' ? base_url('upload/avatar/default_pic.png') : $student['student_picture']);
                            }
                            ?>"
                         width='170px' height='170px' alt='Profile picture'><br>
                            <span class="btn btn-sm btn-default btn-file" style='width:170px'>
                                <span class="fileinput-new" >Change Picture</span>
                                <input type="file" name="file" id="file">
                            </span>
                        </div>
                    </center>
                </form>
                <!-- /.Profile Picture -->
                <h3 id='user_name' class="profile-username text-center"></h3>
                <b><p id='user_id' class="text-muted text-center"></p></b>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
              <p class="text-muted">
                QUERY REQUIRED here!
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
              <p id="user_address" class="text-muted"></p>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> Contact No.</strong>
              <p id="user_contact" class="text-muted"></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class='active'><a href="#details" data-toggle="tab">Other Details</a></li>
              <li class=''><a href="#editProfile" data-toggle="tab">Edit Profile</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="details">
              <div class="box-body">
                <div class="col-sm-5">
                    <div class='row'>
                        <label for="user_gender">Gender</label>
                        <p id="user_gender"></p><hr>
                        <label for="user_bplace">Birth Place</label>
                        <p id="user_bplace"></p><hr>
                        <label for="user_bdate">Birth Date</label>
                        <p id="user_bdate"></p><hr>
                        <label for="user_religion">Religion</label>
                        <p id="user_religion"></p><hr>
                        <label for="user_status">Civil Status</label>
                        <p id="user_status"></p><hr>
                        <!-- tiwason pani kay mag mafa sa mi -->
                        <label for="user_last_school">Last school attended</label>
                        <p id="user_last_school"></p><hr>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class='row'>
                        <label for="user_spouse">Spouse name</label>
                        <p id="user_spouse"></p><hr>
                        <label for="user_father_name">Father's name</label>
                        <p id="user_father_name"></p><hr>
                        <label for="user_father_occupation">Father's occupation</label>
                        <p id="user_father_occupation"></p><hr>
                        <label for="user_mother_name">Mother's name</label>
                        <p id="user_mother_name"></p><hr>
                        <label for="user_mother_occupation">Mother's Occupation</label>
                        <p id="user_mother_occupation"></p><hr>
                        <label for="user_guardian">Guardian's name</label>
                        <p id="user_guardian"></p><hr>
                    </div>
                </div>
              </div>
              </div>
              <div class="tab-pane" id="editProfile">
              <?php echo form_open('', array("id" => "form_editStudent")); ?>
              <div class="box-body">
                  <div class='row'>
                    <div class='col-xs-3'>
                      <div class="form-group">
                        <label for="student_id">ID</label>
                        <input class='form-control' type='text' id='student_id' name='student_id' value='' ></input>
                      </div>
                    </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_fname">First name</label>
                              <input class='form-control' type='text' id='student_fname' name='student_fname' value='' ></input>
                          </div>
                      </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_mname">Middle name</label>
                              <input class='form-control' type='text' id='student_mname' name='student_mname' value='' ></input>
                          </div>
                      </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_lname">Last name</label>
                              <input class='form-control' type='text' id='student_lname' name='student_lname' value='' ></input>
                          </div>
                      </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_gender">Gender</label>
                              <select class='form-control' name='student_gender' id='student_gender' required>
                                  <option value='' disabled selected>-- Select gender --</option>
                                  <option>Male</option>
                                  <option>Female</option>
                              </select>
                          </div>
                      </div>
                      
                      <div class='col-xs-4'>
                          <div class="form-group">
                              <label for="student_bplace">Birth place</label>
                              <input type='text' name='student_bplace' id='student_bplace' class='form-control' placeholder="Birth place">
                          </div> 
                      </div>
                      
                      <div class='col-xs-2'>
                          <div class="form-group date">
                              <label for="student_bdate">Birth date</label>
                               <input type='text' name='student_bdate' class='form-control' id='student_bdate' placeholder="Birth date">
                          </div>
                      </div>
                      <div class='col-xs-1'>
                          <div class="form-group">
                              <label for="age">Age</label>
                              <input type='text' name='age' class='form-control' id='age' placeholder="Age" disabled>
                          </div>
                      </div>
                      <div class='col-xs-2'>
                          <div class="form-group">
                              <label for="student_religion">Religion</label>
                              <input type='text' name='student_religion' id='student_religion' class='form-control' placeholder="Religion">
                          </div> 
                      </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_address_street">Street #</label>
                              <input type='text' name='student_address_street' id='student_address_street' class='form-control' placeholder="Street # of student address">
                          </div>
                      </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_address_barangay">Barangay</label>
                              <input type='text' name='student_address_barangay' id='student_address_barangay' class='form-control' placeholder="Barangay of student address">
                          </div>
                      </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_address_municipality">Municipality</label>
                              <input type='text' name='student_address_municipality' id='student_address_municipality' class='form-control' placeholder="Municipality of student address">
                          </div>
                      </div>
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_address_province">Province</label>
                              <input type='text' name='student_address_province' id='student_address_province' class='form-control' placeholder="Province of student address">
                          </div>
                      </div>
                      
                      <div class='col-xs-3'>
                          <div class="form-group">
                              <label for="student_status">Civil status</label>
                              <select class='form-control' name='student_status' id='student_status' required>
                                  <option value='' disabled selected>-- Select status --</option>
                                  <option>Single</option>
                                  <option>Married</option>
                                  
                              </select>
                          </div>
                      </div>
                      <div class='col-xs-4'>
                          <div class="form-group">
                              <label for="student_spouse_name">Spouse name (Optional)</label>
                              <input type='text' name='student_spouse_name' id='student_spouse_name' class='form-control' placeholder="Name of spouse if applicable">
                          </div>
                      </div>
                      <div class='col-xs-5'>
                          <div class="form-group">
                              <label for="student_last_school_year_attended">Last school attended</label>
                              <input type='text' name='student_last_school_year_attended' id='student_last_school_year_attended' class='form-control' placeholder="Last school attended">
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class='row'>
                      <div class='col-xs-6'>
                          <div class="form-group">
                              <label for="student_fathers_name">Father's name</label>
                              <input type='text' name='student_fathers_name' id='student_fathers_name' class='form-control' placeholder="Father's full name">
                          </div>
                      </div>
                      <div class='col-xs-6'>
                          <div class="form-group">
                              <label for="student_fathers_occupation">Father's occupation</label>
                              <input type='text' name='student_fathers_occupation' id='student_fathers_occupation' class='form-control' placeholder="Father's occupation">
                          </div>
                      </div>
                      <div class='col-xs-6'>
                          <div class="form-group">
                              <label for="student_mothers_name">Mother's name</label>
                              <input type='text' name='student_mothers_name' id='student_mothers_name' class='form-control' placeholder="Mother's full name">
                          </div>
                      </div>
                      <div class='col-xs-6'>
                          <div class="form-group">
                              <label for="student_mothers_occupation">Mother's occupation</label>
                              <input type='text' name='student_mothers_occupation' id='student_mothers_occupation' class='form-control' placeholder="Mother's occupation">
                          </div>
                      </div>
                      <div class='col-xs-6'>
                          <div class="form-group">
                              <label for="student_contact_number">Contact number</label>
                              <input type='text' name='student_contact_number' id='student_contact_number' class='form-control' placeholder="Contact number">
                          </div>
                      </div>
                      <div class='col-xs-6'>
                          <div class="form-group">
                              <label for="student_guardian">Guardian's name</label>
                              <input type='text' name='student_guardian' id='student_guardian' class='form-control' placeholder="Guardian's full name">
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <div class='pull-right'>
                      <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save Changes</button> &nbsp;
                      <button type="button" onclick="populateDataToForm();" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</button>
                  </div>
              </div>
              <?php echo form_close(); ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <script>
  $('#student_bdate').datepicker({ autoclose: true });

  function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]){
        if(uploader.files[0].type == 'image/jpeg' || uploader.files[0].type == 'image/png' || uploader.files[0].type == 'image/bmp'){
            $('#pic').attr('src', window.URL.createObjectURL(uploader.files[0]));
        }else{
            $('#pic').attr('src', '<?php echo base_url('upload/avatar/invalid.jpg') ?>');
        }
    }
  }
  
  function readURL(input)
  {
      if (input.files && input.files[0])
      {
          var reader = new FileReader();
          reader.onload = function(e)
          {
            var _imgb64 = e.target.result;

            PutDataToUrl({id:<?php echo $id; ?>,file: _imgb64}, '<?=base_url('admin/students/updatePicture')?>').then(function(data){
                switch (data.content.status) {
                    case 'error':
                        toastr.error(data.content.message);
                        break;
                    case 'ok':
                        populateDataToForm();
                        toastr.success(data.content.message);
                        break;
                    default:
                        break;
                }
            });

          }
          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#file").change(function(){
        fasterPreview(this);
        readURL(this);
  });

  //POPULATE data to form_editStudent
  $(document).ready(function(){
    populateDataToForm();
  });

  function populateDataToForm()
  {
    var id = <?php echo $id ?>;
    $.ajax({
      url: '<?=base_url('admin/students/getStudent')?>',
      method: 'get',
      data: {id:id},
      success: function(data){
        var data = $.parseJSON(data);
        $('#user_name').html(data[0].student_fname+' '+data[0].student_mname+' '+data[0].student_lname);
        $('#user_id').html((data[0].student_id==''?'N/A':data[0].student_id));
        $('#user_address').html(data[0].student_address_street+', '+data[0].student_address_barangay+', '+data[0].student_address_municipality+', '+data[0].student_address_province);
        $('#user_contact').html((data[0].student_contact_number==''?'N/A':data[0].student_contact_number));
        $('#user_gender').html(data[0].student_gender);
        $('#user_bplace').html((data[0].student_bplace==''?'N/A':data[0].student_bplace));
        $('#user_bdate').html((data[0].student_bdate).split('-')[1]+'/'+(data[0].student_bdate).split('-')[2]+'/'+(data[0].student_bdate).split('-')[0]);
        $('#user_religion').html((data[0].student_religion==''?'N/A':data[0].student_religion));
        $('#user_status').html(data[0].student_status);
        $('#user_spouse').html((data[0].student_spouse_name==''?'N/A':data[0].student_spouse_name));
        $('#user_last_school').html(data[0].student_last_school_year_attended);
        $('#user_father_name').html(data[0].student_fathers_name);
        $('#user_father_occupation').html(data[0].student_fathers_occupation);
        $('#user_mother_name').html(data[0].student_mothers_name);
        $('#user_mother_occupation').html(data[0].student_mothers_occupation);
        $('#user_guardian').html(data[0].student_guardian);

        $('#student_id').val(data[0].student_id);
        $('#student_fname').val(data[0].student_fname);
        $('#student_mname').val(data[0].student_mname);
        $('#student_lname').val(data[0].student_lname);
        $('#student_gender').val(data[0].student_gender);
        $('#student_bplace').val(data[0].student_bplace);
        $('#student_bdate').val((data[0].student_bdate).split('-')[1]+'/'+(data[0].student_bdate).split('-')[2]+'/'+(data[0].student_bdate).split('-')[0]);
        $('#student_religion').val(data[0].student_religion);
        $('#student_address_street').val(data[0].student_address_street);
        $('#student_address_barangay').val(data[0].student_address_barangay);
        $('#student_address_municipality').val(data[0].student_address_municipality);
        $('#student_address_province').val(data[0].student_address_province);
        $('#student_status').val(data[0].student_status);
        $('#student_spouse_name').val(data[0].student_spouse_name);
        $('#student_last_school_year_attended').val(data[0].student_last_school_year_attended);
        $('#student_fathers_name').val(data[0].student_fathers_name);
        $('#student_fathers_occupation').val(data[0].student_fathers_occupation);
        $('#student_mothers_name').val(data[0].student_mothers_name);
        $('#student_mothers_occupation').val(data[0].student_mothers_occupation);
        $('#student_contact_number').val(data[0].student_contact_number);
        $('#student_guardian').val(data[0].student_guardian);
      }
    });
  }

  $('#form_editStudent').on('submit', function(e){
      e.preventDefault();
      PutDataToUrl($(this).serialize(), '../../students/edit/?id='+<?php echo $id; ?>).then(function(data){
        switch (data.content.status) {
            case 'error':
                toastr.error(data.content.message);
                break;
            case 'ok':
                populateDataToForm();
                toastr.success(data.content.message);
                break;
            default:
                break;
        }
      });
  });
  </script>