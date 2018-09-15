
<?php
    // var_dump($subjects);
    foreach ($prospectus as $key1 => $value1) {
        if($value1['prospectus_yearlevel'] == $level && $value1['prospectus_term'] == $term)
        {
            
            echo '<select id="edit_'.$value1['course_id'].'_'.$level.'_'.$term.'_'.$value1['subj_id'].'" style="margin-top:5px; width:100%; height:30px; border-radius:2px;">
                                    <option hidden></option>';
            foreach ($subjects as $key2 => $value2) {
                if($value1['subj_id'] == $value2['ID'])
                {
                    echo '<option id="'; echo $value1['subj_id']; echo '" selected >'; echo $value2['subj_code'].'-'.$value2['subj_description']; echo '</option>';
                }
                else {
                    echo '<option id="'; echo $value2['ID']; echo '">'; echo $value2['subj_code'].'-'.$value2['subj_description']; echo '</option>';
                }
            }
            echo "</select>";
        }
    }

?>
