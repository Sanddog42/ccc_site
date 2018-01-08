<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.castrocountryclub.org
 * @since      1.0.0
 *
 * @package    Meeting_Schedule
 * @subpackage Meeting_Schedule/public/partials
 */

$dayArray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
?>

<style>



</style>
<div style="background: #c8e8a9; ">
        <?php

            $lastDay = "";
            $loadedDiv = "";
            foreach ($this->meetings as $meeting) {
                $day = $dayArray[$meeting->day_of_week];

                $temp = strtotime($meeting->start_time);
              	$startTime = date("g:ia", $temp);
              	$temp = strtotime($meeting->end_time);
              	$endTime = date("g:ia", $temp);

                if($lastDay != $day){ // if the last day isn't the current day then need to start a day label
					echo($loadedDiv . '<div class="scheduleDay" >' . $day . ".</div>");

					//$loadedDiv = '</div>';
				}
                echo('  <div class="scheduleEvent" style="background: white; border-left-color:' . stripslashes($meeting->color ) . ';">');
				echo('    <div class="cell typeCell">' . stripslashes($meeting->meeting_type) . '</div>');
				echo('    <div class="cell nameCell">' . stripslashes( $meeting->name ) );
				if( $meeting->details ){
					echo('    <div class="cell detailsCell">' . stripslashes( $meeting->details ) . '</div>') ;

				}

				echo ('</div>');
				echo('    <div class="cell timeCell">' . stripslashes( $startTime ) . '-' . stripslashes( $endTime) . '</div>');

				echo('  </div>');

				$lastDay = $day;

            }
           // echo('</div>');
        ?>

</div>

