
<?php
    // var_dump($prospectus);
    foreach ($prospectus as $key1 => $value1) {
        if($value1['prospectus_yearlevel'] == $level && $value1['prospectus_term'] == $term)
        {
            
            echo '
            <div class="row">
            <div class="col-md-1">
                <label>
                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="true" style="position: relative;" >
                        <input type="checkbox" class="flat-red form-control" style="position: absolute; opacity: 0;" id="subjectID" value="'.$value1['subj_id'].'_'.$ID.'">
                    </div>
                </label>
            </div>
            <div class="col-md-10">
                <input class="form-control" disabled style="width:100%; height:25px; border-radius:3px;"  value="'.$value1['subj_code'].'-'.$value1['subj_description'].'">
            </div></div>
                ';
        }
    }

?>
