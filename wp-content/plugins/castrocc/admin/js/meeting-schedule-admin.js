(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 $(function(){
	 	var colorPickerInputs = $( '.meeting-schedule-color-picker' );

	 	// WordPress specific plugins - color picker and image upload
     	$( '.meeting-schedule-color-picker' ).wpColorPicker();
	 });

})( jQuery );


            function editFellowshipType(id){
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

            function deleteFellowshipType(id){
                resetForm();
                var idField = document.getElementById("<?php echo $this->plugin_name; ?>-id");
                var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
                var form = document.getElementById("fellowshipForm");
                idField.value=id;
                stateField.value='delete';
                form.submit();

            }

            function resetFellowshipForm(){


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

            function submitFellowshipForm(){
                document.getElementById('fellowshipForm').submit();
            }


                function editMeeting(id){



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

    function deleteMeeting(id){
        resetForm();
        var name = document.getElementById("name-"+id).innerHTML;

        var idField = document.getElementById("<?php echo $this->plugin_name; ?>-id");
        var stateField = document.getElementById("<?php echo $this->plugin_name; ?>-state");
        var form = document.getElementById("meetingScheduleForm");
        idField.value=id;
        stateField.value='delete';
        form.submit();

    }

    function resetMeetingForm(){


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

    function submitMeetingForm(){
        document.getElementById('meetingScheduleForm').submit();
    }