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
    left: 0;
    top: -165px;
}

.submit {
	visibility: hidden;
}
</style>

        <div class="success" id="success">
            Thank you for your intrest in volunteering for the Castro Country Club. Someone will be in touch with you shortly to follow up on your application.
        </div>
        
<form action="<?php echo admin_url('admin-ajax.php'); ?>" class="form" id="application" method="post">
    <?php wp_nonce_field('add_transfer','security-code-here'); ?>
    <input name="action" type="hidden" value="add_transfer"/>
    <div class="formElement">
        <div class="errors" id="errors">
            Please Fix the following errors:
            <ul class="errorsList" id="errorsList">
            </ul>
        </div>

        <div class="sectionHeader">
            CONTACT INFORMATION: Provide two personal and/or service references
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="cname">
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" maxlength="256" name="application[cname]" placeholder="Name" type="text" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container email-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="cemail">
                        Email
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[cemail]" placeholder="somewhere@gmail.com" type="email" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap ">
                <div class="field-label">
                    <label id="cphone1">
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[cphone1]" placeholder="(###)###-####" type="tel" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left ">
            <div class="field-wrap phone-wrap">
                <div class="field-label">
                    <label id="cphone2">
                        Alt Phone
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[cphone2]" placeholder="(###)###-####" type="tel" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="full-width-row field-container label-left row-start sectionEnd">
            <div class="field-label">
                <label id="caddress">
                    Address
                    <span class="requiredField">
                        *
                    </span>
                </label>
            </div>
            <div class="field-element">
                <input class="textInput" name="application[caddress]" type="text" value="">
                </input>
            </div>
        </div>
        <div class="sectionHeader" id="intrest">
            INTERESTS: What volunteer activities interest you? Select as many as you're interested in!
        </div>
        <div class="field-container row-start full-width-row sectionEnd">
            <ul>
                <li>
                    <input name="application[interest][]" type="checkbox" value="coffee">
                        <label>
                            Coffee Bar: Prepare coffee, food, and beverages for customers; requires sales and cashier responsibilities
                        </label>
                    </input>
                </li>
                <li>
                    <input name="application[interest][]" type="checkbox" value="fundraising">
                        <label>
                            Fundraising Events: Help with set-up and production; Mascara and other performances; may include sales
                        </label>
                    </input>
                </li>
                <li>
                    <input name="application[interest][]" type="checkbox" value="inventory">
                        <label>
                            Inventory: Assist in maintaining cafe stock and inventory records
                        </label>
                    </input>
                </li>
                <li>
                    <input name="application[interest][]" type="checkbox" value="facilities">
                        <label>
                            Facilities: light cleaning, gardening, help when repairs are made
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
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="1"/>
                8:00am-10:30pm
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="2"/>
                10:30pm-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[sunday][]" type="checkbox" value="4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="monday">
                MON
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[monday][]" type="checkbox" value="4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="tuesday">
                TUES
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[tuesday][]" type="checkbox" value="4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="wednesday">
                WED
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="2"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[wednesday][]" type="checkbox" value="4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="thursday">
                THURS
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="1"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="3"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[thursday][]" type="checkbox" value="4"/>
                7:30pm-10:15pm
            </div>
        </div>
        <div class="field-container row-start full-width-row ">
            <div class="field-label day-cell" id="friday">
                FRI
            </div>
            <div class="field-label hours-cell cell1">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1"/>
                6:30am-10:30am
            </div>
            <div class="field-label hours-cell cell2">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1"/>
                10:30am-3:00pm
            </div>
            <div class="field-label hours-cell cell3">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1"/>
                3:00pm-7:30pm
            </div>
            <div class="field-label hours-cell cell4">
                <input class="hours-checkbox" name="application[friday][]" type="checkbox" value="1"/>
                7:30pm-11:15pm
            </div>
        </div>
        <div 3px;"="" :="" class="field-container row-start full-width-row sectionEnd">
            <div class="field-label day-cell bottom-cell" id="saturday">
                SAT
            </div>
            <div class="field-label hours-cell bottom-cell cell1">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1" />
                8:30am-12:30pm
            </div>
            <div class="field-label hours-cell bottom-cell cell2">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1"/>
                12:30pm-4:00pm
            </div>
            <div class="field-label hours-cell bottom-cell cell3">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1"/>
                4:00pm-8:00pm
            </div>
            <div class="field-label hours-cell bottom-cell cell4">
                <input class="hours-checkbox" name="application[saturday][]" type="checkbox" value="1"/>
                8:00pm-11:15pm
            </div>
        </div>
        <div class="sectionHeader">
            REFERENCES: Provide two personal and/or service references
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="rname1">
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rname1]" type="text" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="rphone1">
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rphone1]" placeholder="(###)###-####" type="tel" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="rname2">
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rname2]" placeholder="Name" type="text" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left sectionEnd">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="rphone2">
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[rphone2]" placeholder="(###)###-####" type="tel" value="">
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
                    <label id="ename">
                        Name
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[ename]" placeholder="Name" type="text" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container email-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="eemail">
                        Email
                        <span class="requiredField">
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[eemail]" placeholder="somewhere@gmail.com" type="email" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left row-start ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="ephone1">
                        Phone
                        <span class="requiredField">
                            *
                        </span>
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[ephone1]" placeholder="(###)###-####" type="tel" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="field-container label-left ">
            <div class="field-wrap">
                <div class="field-label">
                    <label id="ephone2">
                        Alt Phone
                    </label>
                </div>
                <div class="field-element">
                    <input class="textInput" name="application[ephone2]" placeholder="(###)###-####" type="tel" value="">
                    </input>
                </div>
            </div>
        </div>
        <div class="full-width-row field-container label-left row-start sectionEnd">
            <div class="field-label">
                <label id="eaddress">
                    Address
                    <span class="requiredField">
                        *
                    </span>
                </label>
            </div>
            <div class="field-element">
                <input class="textInput" name="application[eaddress]" type="text" value="">
                </input>
            </div>
        </div>
        <div class="sectionHeader">
            CODE OF CONDUCT: Please read before submitting
        </div>
        <div class="field-container row-start full-width-row sectionEnd">
            <div class="field-wrap">
                <div style="text-decoration: underline; ">
                    The Castro Country Club has the right and duty to require anyone in violation of this Code of Conduct to leave the premises for the day or even indefinitely. Please be respectful of all Club patrons, volunteers, and staff at all times. The following actions and behaviors are unacceptable for staff, volunteers and patrons:
                </div>
                <ul style="list-style: disc; padding-left: 30px; padding-top: 10px;">
                    <li>
                        Alcohol, drugs, or paraphernalia on the premises
                    </li>
                    <li>
                        Being under the influence of drugs or alcohol
                    </li>
                    <li>
                        Creating an envrionment that is unwelcoming to others, including (but not limited to) poor hygine, strong odors, crass and/or vulgar lanauage or behavior, or excessive volume in common areas
                    </li>
                    <li>
                        Threats or acts of violence towards people or property
                    </li>
                    <li>
                        Carrying weapons of any kind
                    </li>
                    <li>
                        Malicious and hurful gossip or name-calling
                    </li>
                    <li>
                        Stealing or other illegal activities
                    </li>
                    <li>
                        Gambling or betting of any kind
                    </li>
                    <li>
                        Viewing pornography on phones, computers, or magazines
                    </li>
                    <li>
                        Nudity, sexual activity, sexual harassment, sexually aggressive behavior
                    </li>
                    <li>
                        Panhandling or begging on the premise
                    </li>
                    <li>
                        Sleeping, laying on, or placing feet on the furniture
                    </li>
                    <li>
                        Carrtying more than one bag at any time or leaving personal belongings unattended
                    </li>
                    <li>
                        Spreading contagious disease, having exposed cuts or sores and/or bleeding
                    </li>
                    <li>
                        Smoking/vaping within 15 feet of exits and windows (SF Health Code Article 19F)
                    </li>
                    <li>
                        Failure to properly control service animal's barking biting, lying on furniture, and/or urinating or defecating indoors. Dogs must be leashed or kept in a  crate. The law prohibits animals on the premises with the exception of legally registered guide dogs and service animals as defined by the American with Disabilities Act (ADA);
                    </li>
                </ul>
            </div>
        </div>
        <div class="sectionHeader">
            AGREEMENT
        </div>
        <div class="field-container row-start full-width-row sectionEnd">
            <ul>
                <li>
                    <input name="application[agreement]" type="checkbox" value="1">
                        <label id="agreement">
                            I affirm that the facts set forth are true and complete. I understand that any false statements, omissions, or other misrepresentations made by me on this application may result in my immediate dismissal. My signature indicates that I have read the Castro Country Club Code of Conduct and agree to abide by it as a volunteer and patron; in addition, I acknowledge that I am volunteering on my own accord and I do not hold the Castro Country Club liable for any personal injury while I am on or off duty.
                        </label>
                    </input>
                </li>
            </ul>
        </div>
        <div class="sectionHeader">
            ADDITONAL OPPORTUNITIES
        </div>
        <div class="field-container row-start full-width-row ">
            <ul>
                <li>
                    <input name="application[prc]" type="checkbox" value="1">
                        <label id="prc">
                            I would like to participate in the Castro Country Club's partner program with the Positive Resource Center which provides opportunites for job skills building and resources (not required).
                        </label>
                    </input>
                </li>
            </ul>
        </div>
        <div "="" class="field-container row-start full-width-row submit">
            <div class="field-wrap">
                <input type="submit" value="Submit">
                </input>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var frm = jQuery('#application');

    
    frm.submit(function (e) {

        e.preventDefault();

        resetErrors();

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
                	handleSuccess(new Map(Object.entries(result['success'])));
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
    });

    function handleError(error){
//    	var tmpError = new Map(Object.entries(error));

    	var errorString = "";
    	error.forEach(function( value, key, map ) {
  			jQuery('#' + key).css('color', 'red');
  			errorString += "<li>" +value +"</li>";
		});

    	jQuery("#errorsList").html(errorString);
    	jQuery("#errors").css("display", "inline");

    }

    function handleSuccess(success){
    	jQuery("#success").css("display", "inline");
    	jQuery("#application").css("display", "none");
    }

    function resetErrors() {
    	jQuery("#cname").css("color", "black");
    	jQuery("#cemail").css("color", "black");
    	jQuery("#cphone1").css("color", "black");
    	jQuery("#cphone2").css("color", "black");
    	jQuery("#caddress").css("color", "black");
    	jQuery("#interest").css("color", "black");
    	jQuery("#sunday").css("color", "black");
    	jQuery("#monday").css("color", "black");
    	jQuery("#tuesday").css("color", "black");
    	jQuery("#wednesday").css("color", "black");
    	jQuery("#thursday").css("color", "black");
    	jQuery("#friday").css("color", "black");
    	jQuery("#saturday").css("color", "black");
    	jQuery("#rname1").css("color", "black");
    	jQuery("#rphone1").css("color", "black");
    	jQuery("#rname2").css("color", "black");
    	jQuery("#rphone2").css("color", "black");
    	jQuery("#ename").css("color", "black");
    	jQuery("#eemail").css("color", "black");
    	jQuery("#eaddress").css("color", "black");
    	jQuery("#ephone1").css("color", "black");
    	jQuery("#ephone2").css("color", "black");
    	jQuery("#prc").css("color", "black");
    	jQuery("#agreement").css("color", "black");
    	jQuery("#errors").css("display", "none");


    }
</script>
