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


?>
<style>

td {
	border-bottom: none;
}
</style>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
	<br/>


        <?php
            // output all the fellowship types
            foreach ($this->meetingTypes as $type) {	

            	echo("<div style='font: 2em black;'>$type->full_name ($type->short_name)</div>");
                echo("<a href='$type->url'>$type->url</a><br/>");
                echo("<div>$type->details </div><br/>");
            }
        ?>
        </table>
