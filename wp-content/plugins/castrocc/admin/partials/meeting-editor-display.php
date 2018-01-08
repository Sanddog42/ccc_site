<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.castrocountryclub.org
 * @since      1.0.0
 *
 * @package    Meeting_Schedule
 * @subpackage Meeting_Schedule/admin/partials
 */

    $dayArray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<script>
    function editType(id){



        var name = document.getElementById("name-"+id).innerHTML;
        var day = document.getElementById("day-"+id).innerHTML;
        var startTime = document.getElementById("start_time-"+id).innerHTML;
        var endTime = document.getElementById("end_time-"+id).innerHTML;
        var details = document.getElementById("details-"+id).innerHTML;
        var typeId = document.getElementById("typeId-"+id).innerHTML;

        var nameField = document.getElementById("<?php echo $this->plugin_name; ?>-name");
        var idField = document.getElementById("<?php echo $this->plugin_name; ?>-id");
        var dayField = document.getElementById("<?php echo $this->plugin_name; ?>-day");
        var typeField = document.getElementById("<?php echo $this->plugin_name; ?>-meetingTypeId");
        var startTimeField = document.getElementById("<?php echo $this->plugin_name; ?>-startTime");
        var endTimeField = document.getElementById("<?php echo $this->plugin_name; ?>-endTime");
        var detailsField = document.getElementById("<?php echo $this->plugin_name; ?>-details");
        var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
        var stateLabel = document.getElementById("stateLabel");

        nameField.value = name;
        idField.value = id;  // have to use a second id field incase user changes the name ... for sql where matches
        dayField.value = day;
        typeField.value = typeId;
        startTimeField.value = startTime;
        endTimeField.value = endTime;
        detailsField.value = details;
        stateField.value = "edit";
        stateLabel.innerHTML="Edit";


    }

    function deleteType(id){
        resetForm();
        var name = document.getElementById("name-"+id).innerHTML;

        var idField = document.getElementById("<?php echo $this->plugin_name; ?>-id");
        var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
        var form = document.getElementById("meetingScheduleForm");
        idField.value=id;
        stateField.value='delete';
        form.submit();

    }

    function resetForm(){


        var nameField = document.getElementById("<?php echo $this->plugin_name; ?>-name");
        var idField = document.getElementById("<?php echo $this->plugin_name; ?>-id");
        var dayField = document.getElementById("<?php echo $this->plugin_name; ?>-day");
        var startTimeField = document.getElementById("<?php echo $this->plugin_name; ?>-startTime");
        var endTimeField = document.getElementById("<?php echo $this->plugin_name; ?>-endTime");
        var detailsField = document.getElementById("<?php echo $this->plugin_name; ?>-details");
        var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
        var typeField = document.getElementById("<?php echo $this->plugin_name; ?>-meetingTypeId");
        var stateLabel = document.getElementById("stateLabel");

        nameField.value = "";
        idField = "new";
        dayField.value = "0";
        typeField.value = "";
        startTimeField.value = "";
        endTimeField.value = "";
        detailsField.value = "";
        stateField.value = "new";
        stateLabel.innerHTML="New";

    }

    function submitForm(){
        document.getElementById('meetingScheduleForm').submit();
    }
</script>
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
<?php
    
    // check errors and display
    foreach ($validationResult as $key => $value) {
        
        echo('<div class="notice notice-error">'. $value .'</div>');

    }
?> 

    <form method="post" name="meetingSchedule" id="meetingScheduleForm" action="admin.php?page=meeting-schedule_meeting_editor">
        <!-- remove some meta and generators from the <head> -->
        <div>
            <span id="stateLabel" style="font: 2em; font-weight: bold;">New</span>
            
            <input type="hidden" id="<?php echo $this->plugin_name; ?>-state" name="meetingEntry[state]" value="new"/>
            <input type="hidden" id="<?php echo $this->plugin_name; ?>-id" name="meetingEntry[id]" value="new"/>
        </div>


        <fieldset>
            <legend class="screen-reader-text"><span>Name</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-name"/>
                <span>Name</span>
                <input type="text" id="<?php echo $this->plugin_name; ?>-name" name="meetingEntry[name]" size="60"  maxlength="60" />
                
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span>Fellowship</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-meetingTypeId"/>
                <span>Fellowship</span>
                <select  id="<?php echo $this->plugin_name; ?>-meetingTypeId" name="meetingEntry[meetingTypeId]" >
                <?php
                    foreach ($this->meetingTypes as $value) {
                        echo('<option value="'.$value->id.'">'.$value->short_name.'</option>');
                    }
                ?>
                </select>
                
            </label>
        </fieldset>
            
        <fieldset>
            <legend class="screen-reader-text"><span>Day of Week</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-day">
                <span>Day of Week</span>
                <select  id="<?php echo $this->plugin_name; ?>-day" name="meetingEntry[day]" >
                <?php
                    foreach ($dayArray as $key=> $value) {
                        echo('<option value="'.$key.'">'.$value.'</option>');
                    }
                ?>
                </select>
                
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span>Start Time</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-startTime">
                <span>Start Time</span>
                <input type="time"  id="<?php echo $this->plugin_name; ?>-startTime" name="meetingEntry[startTime]" />
                
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span>End Time</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-endTime">
                <span>End Time</span>
                <input type="time"  id="<?php echo $this->plugin_name; ?>-endTime" name="meetingEntry[endTime]" />
                
            </label>
        </fieldset>


        <fieldset>
            <legend class="screen-reader-text"><span>Details</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-details">
                <span>Details</span>
                <input type="text"id="<?php echo $this->plugin_name; ?>-details" name="meetingEntry[details]" maxlength="256" size="60"  />
                
            </label>
        </fieldset>
    </form>

 
    <button onclick="submitForm();" class="button button-primary"  value="Submit" style="clear: none">Save</button>  
    <button onclick="resetForm();" class="button button-primary"  value="Reset" style="clear: none">Reset</button>


    <h4>Meetings</h4>
    <table>
        <tr>
            <th>&nbsp;</th>
            <th>Meeting Type</th>
            <th>Name</th>
            <th>Day of Week</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Details</th>

        </tr>

        <?php

            $counter =0;
            foreach ($this->meetings as $meeting) {
                $day = $dayArray[$meeting->day_of_week];
                echo("<tr>");
                echo("<td><a onclick='editType($meeting->id)'>Edit</a> <a onclick='deleteType($meeting->id)'>Delete</a></td>");
                echo("<td style='background-color: $meeting->color'> $meeting->meeting_type <span style='visibility: hidden;' id='typeId-$meeting->id'>$meeting->mt_id</span></td>\n");
                echo("<td id='name-$meeting->id'>$meeting->name </td>");
                echo("<td>$day<span style='visibility: hidden' id='day-$meeting->id'>$meeting->day_of_week</span></td>");
                echo("<td id='start_time-$meeting->id'>$meeting->start_time</td>");
                echo("<td id='end_time-$meeting->id'>$meeting->end_time</td>");
                echo("<td id='details-$meeting->id'>$meeting->details</td></tr>");
                $counter++;
            }
        ?>
    </table>

</div>
