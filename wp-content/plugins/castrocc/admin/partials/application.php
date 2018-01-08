<?php

?>
<style media="print" type="text/css">
    body {
    visibility: hidden;
}

.field-container {
    visibility: visible;
}
.sectionHeader {
    visibility: visible;
    -webkit-print-color-adjust: exact;
}

.formElement {
    position: absolute;
    left: -170px;
    top: -20px;
}
div#adminmenuwrap {
    visibility: hidden ;
}
.submit {
    visibility: hidden;
}
</style>
<style>
    .searchForm{
        flex-direction: row;
        flex-wrap: wrap;
        display: flex;
        margin: 0px;
    }
    .interests{
        width: 20%;
        margin-right: 2%;
    }
    .availability{
        width: 75%;
    }
    #formContainer{
        display: none;
    }
.search-row {
  width: 98.75%;
display: table-row;
margin: 0px;

}

.search-cell{
  width: 7%;
  padding-top: 2px; 
  padding-bottom: 2px;
  padding-left: 5px; 
  border-right: 1px solid black;
  border-top: 1px solid black;
  border-left: 1px solid black;
  display: table-cell; 
}
.day {
      background-color: #a6c4f4;
}

.search-cell hours{
  width: 22.4%;
  padding-top: 2px; 
  padding-bottom: 2px; 
  padding-left: 2px;
  border-right: 1px solid black;
  border-top: 1px solid black;

}

.bottom-cell{
  border-bottom: 1px solid black;
}

h4{
    width: 100%; 
    background-color: #8bb1ed; 
    padding-left: 1%;
}

@media screen and (max-width: 782px)
{

    input[type="radio"],
    input[type="checkbox"] {
        height: auto;
        width: auto;
    }
}

.applicationScroller {
    display: block;
    width: 98%;
    height: 150px;
    overflow-y: scroll;
    overflow-x: hidden;
        margin-top:3em ;
}

.applicationRow{
    display: table-row;
    background: none;
}

.applicationRow:hover{
    background: lightblue;
    cursor: pointer;
}

.applicationTable {
    display: table;
    width: 100%;


}

.applicationCell.tableHeader {
    font-size: 1.2em;
    background: lightgrey;
}

.applicationCell{
    display:table-cell;
    word-wrap: break-word;
}


.applicationScroller::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
    border-radius: 10px;
}

.applicationScroller::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

.applicationScroller::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-image: -webkit-gradient(linear,
                                       left bottom,
                                       left top,
                                       color-stop(0.44, rgb(122,153,217)),
                                       color-stop(0.72, rgb(73,125,189)),
                                       color-stop(0.86, rgb(28,58,148)));
}

#status {
    height: 1.3em;
    padding: 0;
    margin: 0;
    float: right;
    font-size: .8em;
}
</style>
<div class="success" id="success">
    Thank you for your intrest in volunteering for the Castro Country Club. Someone will be in touch with you shortly to follow up on your application.
</div>
<div class="errors" id="errors">
    Please Fix the following errors:
    <ul class="errorsList" id="errorsList">
    </ul>
</div>
<form action="<?php echo admin_url('admin-ajax.php'); ?>" class="form" id="filters" method="post">
    <?php wp_nonce_field('search_applications','security-code-here'); ?>
    <input name="action" type="hidden" value="filter_applications"/>
    <div class="searchForm">
        <div class="interests">
 
            <h4>
                Application Status
            </h4>
            <select name="filters[status]" style="width: 100%;">
                <option value="0">New</option>
                <option value="1">Processed</option>
            </select>            

                <div style="padding-top: 1em;">
                    <input type="button" onclick="filterApps();" value="Filter" style="width: 100%;">
                    </input>
                </div>


        </div>
    </div>
</form>

<form action="<?php echo admin_url('admin-ajax.php'); ?>" class="form" id="fetchApplication" method="post">
    <?php wp_nonce_field('search_applications','security-code-here'); ?>
    <input name="action" type="hidden" value="get_application"/>
    <input name="id" type="hidden" value="" id="fetchApplicationInput"/>
</form>
<div class="applicationScroller">
<div class="applicationTable">

    <div class="applicationRow header">
        <div class="applicationCell tableHeader" >
            Name
        </div>
        <div class="applicationCell tableHeader" >
            Phone Number
        </div>
        <div class="applicationCell tableHeader" >
            Email
        </div>
    </div>

<?php


    // check errors and display
    foreach ($applications as $application ) {

    echo("<div class='applicationRow appRowData' onclick='loadApplication($application->id)' id='app'>");
    echo("   <div class='applicationCell name'>$application->cname</div>");
    echo("    <div class='applicationCell phone'>$application->cphone1</div>");
    echo("    <div class='applicationCell email'>$application->cemail</div>");
    echo("</div>");

    }
?> 


</div></div>


    <div class="formElement" id="formContainer">
        <form id="application">
        <div class="sectionHeader">
            CONTACT INFORMATION: Provide two personal and/or service references
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" maxlength="256" name="application[cname]" placeholder="Name" type="text" value="" id="cname">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container email-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Email
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[cemail]" placeholder="somewhere@gmail.com" type="email" value="" id="cemail">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap ">
                <div class="field-label">
                    <label >
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[cphone1]" placeholder="(###)###-####" type="tel" value="" id="cphone1">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left ">
            <div class="field-wrap phone-wrap">
                <div class="field-label">
                    <label >
                        Alt Phone
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[cphone2]" placeholder="(###)###-####" type="tel" value="" id="cphone2">
                    </input>
                </div>
            </div>
        </div>
        <div class="full-width-row field-container label-left row-start sectionEnd">
            <div class="field-label">
                <label >
                    Address
                    <span class="requiredField">
                        *
                    </span>
                </label>
            </div>
            <div class="field-element">
                <input class="textInput" name="application[caddress]" type="text" value="" id="caddress">
                </input>
            </div>
        </div>
        <div class="sectionHeader" id="intrest">
            INTERESTS: What volunteer activities interest you? Select as many as you're interested in!
        </div>
        <div class="field-container row-start full-width-row sectionEnd" style="text-align: center;">
            <ul style="display: block; width: 100%">
                <li style="display: inline; width: 22%;">
                    <input name="application[interest][]" type="checkbox" value="coffee" id="coffee">
                        <label>
                            Coffee Bar 
                        </label>
                    </input>
                </li>
                <li style="display: inline; width: 22%;">
                    <input name="application[interest][]" type="checkbox" value="fundraising" id="fundrasing">
                        <label>
                            Fundraising
                        </label>
                    </input>
                </li>
                <li style="display: inline; width: 22%;">
                    <input name="application[interest][]" type="checkbox" value="inventory" id="inventory">
                        <label>
                            Inventory
                        </label>
                    </input>
                </li>
                <li style="display: inline; width: 22%;">
                    <input name="application[interest][]" type="checkbox" value="facilities" id="facilities">
                        <label>
                            Facilities
                        </label>
                    </input>
                </li>
            </ul>
        </div>
        <div class="sectionHeader">
            AVAILABILITY: Let us know what hours you're available for on which days
        </div>
        <div class="field-container row-start full-width-row">
            <div class="field-label day-cell" id="sunday">
                SUN
            </div>
            <div class="field-label hours-cell cell1 ">
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="1" id="s1"/>
                8:00am-10:30pm
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="2" id="s2"/>
                10:30pm-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="3" id="s3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="4" id="s4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="monday">
                MON
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="1" id="m1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="2" id="m2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="3" id="m3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="4" id="m4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="tuesday">
                TUES
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="1" id="t1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="2" id="t2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="3" id="t3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="4" id="t4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="wednesday">
                WED
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="1" id="w1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="2" id="w2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="3" id="w3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="4" id="w4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="thursday">
                THURS
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="1" id="r1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="1" id="r2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="3" id="r3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="4" id="r4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="friday">
                FRI
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1" id="f1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1" id="f2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1" id="f3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1" id="f4"/>
                7:30pm-11:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row sectionEnd">
            <div class="field-label day-cell bottom-cell" id="saturday">
                SAT
            </div>
            <div class="field-label hours-cell bottom-cell cell1">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1" id="a1"/>
                8:30am-12:30pm
            </div>
            <div class="field-label hours-cell bottom-cell cell2">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1" id="a2"/>
                12:30pm-4:00pm
            </div>
            <div class="field-label hours-cell bottom-cell cell3">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1" id="a3"/>
                4:00pm-8:00pm
            </div>
            <div class="field-label hours-cell bottom-cell cell4">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1" id="a4"/>
                8:00pm-11:15pm
            </div>
        </div>
        <div class="sectionHeader">
            REFERENCES: Provide two personal and/or service references
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rname1]" type="text" value="" id="rname1">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rphone1]" placeholder="(###)###-####" type="tel" value="" id="rphone1">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rname2]" placeholder="Name" type="text" value="" id="rname2">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left sectionEnd">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rphone2]" placeholder="(###)###-####" type="tel" value="" id="rphone2">
                    </input>
                </div>
            </div>
        </div>
        <div class="sectionHeader">
            EMERGENCY CONTACT: Who should we contact in case of emergency?
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[ename]" placeholder="Name" type="text" value="" id="ename">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container email-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Email
                        <span class="requiredField">
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[eemail]" placeholder="somewhere@gmail.com" type="email" value="" id="eemail">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[ephone1]" placeholder="(###)###-####" type="tel" value="" id="ephone1">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label >
                        Alt Phone
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[ephone2]" placeholder="(###)###-####" type="tel" value="" id="ephone2">
                    </input>
                </div>
            </div>
        </div>
        <div class="full-width-row field-container label-left row-start sectionEnd">
            <div class="field-label">
                <label >
                    Address
                    <span class="requiredField">
                        *
                    </span>
                </label>
            </div>
            <div class="field-element">
                <input class="textInput" name="application[eaddress]" type="text" value="" id="eaddress">
                </input>
            </div>
        </div>

        <div class="sectionHeader">
            Additional
        </div>
        <div class="field-container row-start sectionEnd">
            <ul>
                <li>
                    <input name="application[agreement]" type="checkbox" value="1" id="agreement1">
                        <label id="agreement">
                            Code of Conduct Agreement
                        </label>
                    </input>
                </li>
            </ul>
        </div>

        <div class="field-container  ">
            <ul>
                <li>
                    <input name="application[prc]" type="checkbox" value="1" id="prc1">
                        <label id="prc">
                            Addtional Opportunities
                        </label>
                    </input>
                </li>
            </ul>
        </div>
    </form>
        <div class="field-container row-start full-width-row submit">
            <div class="field-wrap">
                <button value="Save" onclick="processApplication();">Process</button>
                <button value="Delete" onclick="deleteApplication();">Delete</button>
            </div>
        </div>
    </div>


<form action="<?php echo admin_url('admin-ajax.php'); ?>" class="form" id="processApplication" method="post">
    <?php wp_nonce_field('add_transfer','security-code-here'); ?>
    <input name="action" type="hidden" value="process_application"/>
    <input name="id" type="hidden" value="" id="processId"/>
</form>

<form action="<?php echo admin_url('admin-ajax.php'); ?>" class="form" id="deleteApplication" method="post">
    <?php wp_nonce_field('add_transfer','security-code-here'); ?>
    <input name="action" type="hidden" value="delete_application"/>
    <input name="id" type="hidden" value="" id="deleteId"/>
</form>

<script type="text/javascript">
    

    
    
    function filterApps(){

        

        var frm = jQuery('#filters');


        jQuery.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
               
                var result = JSON.parse(data);

                if(result['error'] != null){
                    handleError(new Map(Object.entries(result['error'])));
                }
                else{
                    handleFilterSuccess(new Map(Object.entries(result)));
                }
                
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
                var tmp = new Map();
                tmp.set('general','Could not submit form due to technical difficulties. If this continues please contact the Castro Country Club for assistance.');
                handleError(tmp);

            }
        });
    };

    function loadApplication(id){
        var frm = jQuery('#fetchApplication');
        // set the process and delete form id's to the incoming id 
        jQuery("#processId").val(id);
        jQuery("#deleteId").val(id);
        jQuery('#fetchApplicationInput').val(id);

         jQuery.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
               
                var result = JSON.parse(data);

                if(result['error'] != null){
                    handleError(new Map(Object.entries(result['error'])));
                }
                else{
                    handleFetchSuccess(new Map(Object.entries(result)));
                }
                
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
                var tmp = new Map();
                tmp.set('general','Could not submit form due to technical difficulties. If this continues please contact the Castro Country Club for assistance.');
                handleFilterError(tmp);

            }
        });       
    }

    function processApplication(){
        var frm = jQuery('#processApplication');

         jQuery.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
               
                var result = JSON.parse(data);

                if(result['error'] != null){
                    handleError(new Map(Object.entries(result['error'])));
                }
                else{
                    filterApps();
                    jQuery("#application").trigger("reset");
                    jQuery("#formContainer").css("display", "none");
                }
                
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
                var tmp = new Map();
                tmp.set('general','Could not submit form due to technical difficulties. If this continues please contact the Castro Country Club for assistance.');
                handleFilterError(tmp);

            }
        });       
    }

    function deleteApplication(){
        var frm = jQuery('#deleteApplication');

         jQuery.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
               
                var result = JSON.parse(data);

                if(result['error'] != null){
                    handleError(new Map(Object.entries(result['error'])));
                }
                else{
                    filterApps();
                    jQuery("#application").trigger("reset");
                    jQuery("#formContainer").css("display", "none");
                }
                
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
                var tmp = new Map();
                tmp.set('general','Could not submit form due to technical difficulties. If this continues please contact the Castro Country Club for assistance.');
                handleFilterError(tmp);

            }
        });       
    }

    function handleError(error){
//      var tmpError = new Map(Object.entries(error));

        var errorString = "";
        error.forEach(function( value, key, map ) {
            jQuery('#' + key).css('color', 'red');
            errorString += "<li>" +value +"</li>";
        });

        jQuery("#errorsList").html(errorString);
        jQuery("#errors").css("display", "inline");

    }


    function handleFetchSuccess(success){


       success.forEach(function( data, key, map ){

        console.log(data);
        jQuery("#cname").val(data['cname']);
        console.log("cname is " + data['cname']);
        jQuery("#cemail").val(data['cemail']);
        jQuery("#cphone1").val(data['cphone1']);
        jQuery("#cphone2").val(data['cphone2']);
        jQuery("#caddress").val(data['caddress']);
        
        jQuery("#sunday").val(data['sunday']);
        jQuery("#monday").val(data['monday']);
        jQuery("#tuesday").val(data['tuesday']);
        jQuery("#wednesday").val(data['wednesday']);
        jQuery("#thursday").val(data['thursday']);
        jQuery("#friday").val(data['friday']);
        jQuery("#saturday").val(data['saturday']);
        jQuery("#rname1").val(data['rname1']);
        jQuery("#rphone1").val(data['rphone1']);
        jQuery("#rname2").val(data['rname2']);
        jQuery("#rphone2").val(data['rphone2']);
        jQuery("#ename").val(data['ename']);
        jQuery("#eemail").val(data['eemail']);
        jQuery("#eaddress").val(data['eaddress']);
        jQuery("#ephone1").val(data['ephone1']);
        jQuery("#ephone2").val(data['ephone2']);
        jQuery("#prc").val(data['prc']);
        jQuery("#status").val(data['status']);

        processCheckbox("",data['interest']);
        processCheckbox("s", data['sunday']);
        processCheckbox("m", data['monday']);
        processCheckbox("t", data['tuesday']);
        processCheckbox("w", data['wednesday']);
        processCheckbox("r", data['thursday']);
        processCheckbox("f", data['friday']);
        processCheckbox("a", data['saturday']);
        processCheckbox("prc", data['prc']);
        processCheckbox("agreement", data['agreement']);
        jQuery("#formContainer").css("display", "inline");

    });

    }

    function processCheckbox(prepend , str){
        var partsOfStr = str.split(',');
        partsOfStr.forEach(function(value){
            jQuery("#"+prepend+value).prop('checked', true);
        });
    }



    function handleFilterSuccess(success){

        var innerRows = "";

        success.forEach(function(value, key, map){
            innerRows += "<div class='applicationRow appRowData' onclick='loadApplication(" + value['id'] + ")' id='app " + value['id'] + "'>";
            innerRows += "    <div class='applicationCell name'>" + value['cname'] + "</div>";
            innerRows += "    <div class='applicationCell phone'>" + value['cphone1'] + "</div>";
            innerRows += "    <div class='applicationCell email'>" + value['cemail'] + "</div>";
            innerRows += "</div>"; 
        });

        jQuery(".appRowData").remove();
        jQuery(".applicationTable").append(innerRows);

    }

    function resetErrors() {



    }
</script>
