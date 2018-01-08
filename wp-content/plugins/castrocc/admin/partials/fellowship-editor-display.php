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

    $dayMap = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>


    <form method="post" name="fellowshipType" action="admin.php?page=meeting-schedule_fellowship_editor" action="edit" id="fellowshipForm">


 <?php
    
    // check errors and display
    foreach ($validationResult as $key => $value) {
        
        echo('<div class="notice notice-error">'. $value .'</div>');

    }
?>       
        <div>
            <span id="stateLabel" style="font: 2em; font-weight: bold;">New</span>
            
            <input type="hidden" id="<?php echo $this->plugin_name; ?>-state" name="fellowshipType[state]" value="new"/>
            <input type="hidden" id="<?php echo $this->plugin_name; ?>-id" name="fellowshipType[id]" value="-1"/>
        </div>


        <fieldset>
            <legend class="screen-reader-text"><span>Fellowship</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-full_name">
                <span>Fellowship Name</span>
                <input type="text"  id="<?php echo $this->plugin_name; ?>-full_name" name="fellowshipType[full_name]" size="60" maxlength="60"/>
                
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span>Fellowship Abbreviation</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-short_name">
                <span>Fellowship Abbreviation</span>
                <input type="text"  id="<?php echo $this->plugin_name; ?>-short_name" name="fellowshipType[short_name]" size="6" maxlength="6"/>
                
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span>Fellowship URL. </span></legend>
            <label for="<?php echo $this->plugin_name; ?>-url">
                <span>Fellowship URL</span>
                <input type="text"  id="<?php echo $this->plugin_name; ?>-url" name="fellowshipType[url]" size="60" maxlength="256"/>
                
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span>Legend Color</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-color">
                <span>Fellowship Color Legend</span>
                <input type="text" class="<?php echo $this->plugin_name;?>-color-picker"  id="<?php echo $this->plugin_name; ?>-color" name="fellowshipType[color]" maxlength="7" size="7"/>
                
            </label>
        </fieldset>

        <fieldset>
            <legend class="screen-reader-text"><span>Fellowship Details </span></legend>
            <label for="<?php echo $this->plugin_name; ?>-url">
                <span>Details</span>
                <textarea  id="<?php echo $this->plugin_name; ?>-details" name="fellowshipType[details]" rows="4" cols="50">

                </textarea>
                
            </label>
        </fieldset>


        <button onclick="resetForm();" class="button button-primary"  value="Reset" style="clear: none">Reset</button> 
        <button onclick="submitForm();" class="button button-primary"  value="Submit" style="clear: none">Save</button>  
        

        <script>
            function editType(id){
                var fullName = document.getElementById(id +"_full_name").innerHTML;
                var shortName = document.getElementById(id +"_short_name").innerHTML;
                var url = document.getElementById(id +"_url").innerHTML;
                var color = document.getElementById(id +"_color").innerHTML;
                var details = document.getElementById(id +"_details").innerHTML;


                var fullNameField = document.getElementById("<?php echo $this->plugin_name; ?>-full_name");
                var shortNameField = document.getElementById("<?php echo $this->plugin_name; ?>-short_name");
                var urlField = document.getElementById("<?php echo $this->plugin_name; ?>-url");
                var colorField = document.getElementById("<?php echo $this->plugin_name; ?>-color");
                var detailsField = document.getElementById("<?php echo $this->plugin_name; ?>-details");
                var idField = document.getElementById("<?php echo $this->plugin_name; ?>-id");
                var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
                var stateLabel = document.getElementById("stateLabel");

                fullNameField.value = fullName;
                shortNameField.value = shortName;
                urlField.value = url;
                colorField.value = color;
                detailsField.value = details;
                idField.value = id;
                stateField.value = "edit";
                stateLabel.innerHTML="Edit";


                (function( $ ) {
                    'use strict';

                     $(function(){
                        var colorPickerInputs = $( '.<?php echo $this->plugin_name; ?>-color-picker' );
                        colorPickerInputs.wpColorPicker('color', color);
                     });

                })( jQuery );
            }

            function deleteType(id){
                resetForm();
                var idField = document.getElementById("<?php echo $this->plugin_name; ?>-id");
                var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
                var form = document.getElementById("fellowshipForm");
                idField.value=id;
                stateField.value='delete';
                form.submit();

            }

            function resetForm(){


                var fullNameField = document.getElementById("<?php echo $this->plugin_name; ?>-full_name");
                var shortNameField = document.getElementById("<?php echo $this->plugin_name; ?>-short_name");
                var urlField = document.getElementById("<?php echo $this->plugin_name; ?>-url");
                var colorField = document.getElementById("<?php echo $this->plugin_name; ?>-color");
                var detailsField = document.getElementById("<?php echo $this->plugin_name; ?>-details");
                var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
                var stateLabel = document.getElementById("stateLabel");



                fullNameField.value = "";
                shortNameField.value = "";
                urlField.value = "";
                detailsField.value = "";
                colorField.value = "#FFFFFF";

                stateField.value="new";
                stateLabel.innerHTML="New";


                (function( $ ) {
                    'use strict';

                     $(function(){
                        var colorPickerInputs = $( '.<?php echo $this->plugin_name; ?>-color-picker' );
                        colorPickerInputs.wpColorPicker('color', "#FFFFFF");
                     });

                })( jQuery );
            }

            function submitForm(){
                document.getElementById('fellowshipForm').submit();
            }
        </script>

        <table title="Fellowships" style="text-align: left;">
            <tr>
                <th>&nbsp;</th>
                <th>Color</th>
                <th>Name</th>
                <th>Abbr</th>
                <th>Link</th>
            </tr>


        <?php
            // output all the fellowship types
            foreach ($this->meetingTypes as $type) {
                echo("<tr>");
                echo("<td rowspan='2'><a onclick='editType($type->id)'>Edit</a> <a onclick='deleteType($type->id)'>Delete</a></td>");
                echo("<td rowspan='2' id='" .$type->id ."_color'style='background-color: $type->color'>$type->color</td>\n");
                echo("<td id='" .$type->id ."_full_name'>$type->full_name </td>");
                echo("<td id='" .$type->id ."_short_name'>$type->short_name</td>");
                echo("<td id='" .$type->id ."_url'>$type->url</td></tr>");

                echo("<tr><td colspan='3' id='" .$type->id ."_details' style='background-color: $type->details'>$type->details</td>\n");
                echo("</tr>");
            }
        ?>
        </table>

    </form>


</div>
