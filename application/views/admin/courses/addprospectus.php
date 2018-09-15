
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $pagetitle; ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/dashboard">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a> 
            </li>
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/courses">
                    <i class="fa fa-dashboard"></i> Course
                </a> 
            </li>
            <li>
                <a href="http://127.0.0.1/ICEnrollment/admin/courses/prospectus/?id=<?php echo $id ?>">
                    <i class="fa fa-dashboard"></i> Prospectus
                </a> 
            </li>
            <li class="active">Add

            </li>
        </ol>
      
    </section>
    <section class="content">
        <div class="row">
            <!--LEFT DIV  -->
            
            <div class="col-xs-12">
                <div class="box box-solid">
                    
                        <div class="box-header with-border">
                        <?php foreach ($courses as $key => $value) {?>
                            <center>
                                <h2><b><?php echo $value['course_code']; ?> (<?php echo $value['course_year']; ?>)</b></h2>
                                <h3><?php echo $value['course_description']; ?></h3>
                            
                            </center>
                        <?php } ?>    
                            <div class="box-tools pull-right">
                                <a class="btn btn-app appView" href="<?php echo site_url('admin/courses/prospectus/?id='.$id); ?>">
                                    <i class="fa fa-info"></i> Prospectus
                                </a>
                                <a class="btn btn-app appEdit" href="<?php echo site_url('admin/courses/editprospectus/?id='.$id); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a class="btn btn-app appDelete" href="<?php echo site_url('admin/courses/deleteprospectus/?id='.$id); ?>">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                        
                    
                </div>
            </div>
            
            <?php 
            $semester = array('First Semester','Second Semester','Summer');
            $level = array('First Year','Second Year','Third Year','Forth Year');
            $y = 0;
            ?> 
            <?php foreach ($semester as $key => $value) 
            {
                echo "<div class='well'>
                <div class='row'>";
                $iToSend = 1;
                foreach($level as $key1 => $value1)
                {
                    

             ?>
            <div class="col-xs-3">
                <div class="box box-success box-solid" >
                    
                    <div class="box-header">
                        <h3 class="box-title pull-left"><?php echo $value1 ?></h3>
                        <h3 class="box-title pull-right"><?php echo $value ?></h3>
                    </div>
                    <div class="box-body">
                        <div id="inputContainer<?php echo $iToSend."_".$y;?>">
                            <?php  
                                $termRow = $level;  
                                $data = array('level' => $value1, 'term' => $value, 'ID' =>$id,$prospectus,$subjects); 
                                $this->load->view('admin/courses/loadsubject.php', $data); 
                            ?>
                        </div><br>
                    </div>
                    
                    <div class="box-footer" id="btn1" a="<?php echo $y; ?>" style=" cursor:cell;" onclick="AddColF(<?php echo $iToSend; ?>,this)">
                        <center><span class="glyphicon glyphicon-plus"></span> Add column</center>
                    </div>
                    
                </div>
            </div>
            <?php
                $iToSend++;
                }
                $y++;
                echo "</div>
                </div>";
            }
            
            ?>
            <div class="col-xs-12">
                <center><button id='submitAll' type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span> Submit All</button></center>
            </div>
        </div>
    </section>

</div>

<script>
    
        let d1=0;
        let d2=0;
        let d3=0;
        let d4=0;
    function AddColF(q,iThis){
        let rowNum=0;
        switch (q) {
            case 1:
                d1++;
                rowNum = d1;
                break;
            case 2:
                d2++;
                rowNum = d2;
                break;
            case 3:
                d3++;
                rowNum = d3;
                break;
            case 4:
                d4++;
                rowNum = d4;
                break;
        
            default:
                break;
        }
        var a = $(iThis).attr("a"); 
        name = "#inputContainer"+q+"_"+a;
        console.log(name);
        
        $.ajax({
            url: '<?=base_url('admin/courses/addselection')?>',
            data: { className:q ,GETrowNum: rowNum,AA:a },
            dataType: 'html',
            method: 'get',
            success:function (data) {
                $(name).append(data);
            }
        });

    }
  
    
</script>

<script>

    $(document).ready(function(){
        $('.sidebar-mini').toggleClass("skin-blue fixed sidebar-mini skin-blue fixed sidebar-mini sidebar-collapse");
        $(document).on('change','select[id^=edit]', function(e){
            e.preventDefault();
            let subjID = $(this).children(":selected").attr("id");
            let courseID = $(this).attr('id').split('_')[1];
            let level = $(this).attr('id').split('_')[2];
            let term = $(this).attr('id').split('_')[3];
            let old_subjID = $(this).attr('id').split('_')[4];
            let data =  {
                            subjID : subjID,
                            courseID : courseID,
                            level : level,
                            term : term,
                            old : old_subjID
                        };
            PutDataToUrl(data, '../../prospectus/edit').then(function(data){
                if(data.content.status == 'ok')
                {
                    toastr.success(data.content.message);
                }
                else
                {
                    toastr.error(data.content.message);
                }
                
            });

        });
        

        $(document).on('click', '#submitAll', function(e){
            e.preventDefault();
            $('#submitAll').html("<span id='rot' class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span>");
            let sems = ["First Semester", "Second Semester", "Summer"];
            for(let c=0; c < 3;c++){

                postx(c,sems[c]);		  
            }
            setTimeout(function(){
                location.reload();
            }, 2000);
            function postx(ii,sem){				
				// console.log(ii);
                name1 = "SelectedOnRow1_"+ii;
                name2 = "SelectedOnRow2_"+ii;
                name3 = "SelectedOnRow3_"+ii;
                name4 = "SelectedOnRow4_"+ii;
                
                let r1 = document.getElementsByClassName(name1);
                let r2 = document.getElementsByClassName(name2);
                let r3 = document.getElementsByClassName(name3);
                let r4 = document.getElementsByClassName(name4);
                
                let r1subjects =""; 
                let r2subjects =""; 
                let r3subjects =""; 
                let r4subjects =""; 
                
                    
                for(i =0 ; i < r1.length; i++){
                    selectedInFor = r1[i].value;
                    if(selectedInFor !=""){
                            r1subjects +=selectedInFor+",";
                    }
                } 
                for(i =0 ; i < r2.length; i++){
                    selectedInFor = r2[i].value;
                    if(selectedInFor !=""){
                            r2subjects +=selectedInFor+",";
                    }
                } 
                for(i =0 ; i < r3.length; i++){
                    selectedInFor = r3[i].value;
                    if(selectedInFor !=""){
                            r3subjects +=selectedInFor+",";
                    }
                } 
                for(i =0 ; i < r4.length; i++){
                    selectedInFor = r4[i].value;
                    if(selectedInFor !=""){
                            r4subjects +=selectedInFor+",";
                    }
                    
                }   
                   
                let c_id = <?php echo $id; ?>;
                
                let d = {
                    r1 : r1subjects,
                    r2 : r2subjects,
                    r3 : r3subjects,
                    r4 : r4subjects,
                    c_id : c_id,
                    term: sem

                };
                PostDataToUrl(d,'../../prospectus/add').then(function(data){
                    toastr.success(data.content.message);
                }) ;
            }
        })
    });
</script>