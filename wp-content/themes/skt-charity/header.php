<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Charity
 */

  $address = get_theme_mod('header_address',__('100 King St, Melbourne PIC 4000,<br /> Australia','skt-charity'));
  $mapLink = 'https://www.google.com/maps/place/' . urlencode($address);
  require_once plugin_dir_path(dirname(__FILE__)) . '../plugins/castrocc/includes/class-castrocc-data.php';
  $dataManager = new CastroCC_Data();

  $todaysMeetings = $dataManager->getTodaysMeetings();

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name='viewport' content='width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0' />
<link rel="profile" href="http://gmpg.org/xfn/11">

        <script src="/wp-includes/js/jquery/jquery.js?ver=1.12.4" type="text/javascript">
        </script>
        <script src="/wp-includes/js/jquery/jquery-migrate.js?ver=1.4.1" type="text/javascript">
        </script>
        <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Oswald|Roboto" rel="stylesheet">
        <script>

        </script>

        <?php wp_head(); ?>


</head>

<body <?php body_class(''); ?>>
        <div class="bodyContainer">
        <div style="background: grey">
            <div class="boxes">
                <div class="box1">
                    <a href="/">
                        <img height="92" src="http://54.67.106.12/wp-content/uploads/2017/08/logo_v2.png">
                        </img>
                    </a>
                </div>
                <div class="box box2">
                    <?php echo get_theme_mod('header_message'); ?>
                </div>
                <div class="box box3">
                    <a style="color: white;" href=" <?php echo get_theme_mod('donate_link','#'); ?>">Donate</a>
                </div>
                <div class="box box4" onclick="toggleMeetings()">
                    Meetings
                </div>
                <div class="box box5 icon-menu2" onclick="toggleMenu()" style="border-left: 1px solid white; ">
                </div>
            </div>
        </div>

        <div class="menu-slider" id="menu-slider" >
          <div class="closer icon-circle-right" onclick="toggleMenu()"></div>
<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </div>
        <div class="menu-slider" id="menu-slider2" >
            <div class="title">Today's Meetings</div>
            <div class="closer icon-circle-right" onclick="toggleMeetings()"></div>
            <br/>
            <ul class="menu" id="menu-tester-menu" style="font-size: 1em;">
<?php


            foreach ($todaysMeetings as $meeting) {
              $temp = strtotime($meeting->start_time);
              $time = date("g:i", $temp);
              echo "<li class='menu-item' style='display: table;'  >";
              
              echo "<div style='display: table-cell;' class='slider-time'>$time</div>";
              echo "<div style='display: table-cell;' class='slider-type'>$meeting->meeting_type </div>";
              echo "<div style='border-left: 5px solid $meeting->color; display:table-cell;'>&nbsp;</div>";
              echo "<div style='display: table-cell;' class='slider-name'>$meeting->name </div></li>";



            }   
            echo "</ul>";
            echo "<br/><div style='padding-left: 1em; '><a href='/meetings'>See All Meetings</a></div></div></div>";
            
      $hideslide = get_theme_mod('hide_slider', '1');
      error_log("hide_slider value is $hideslide");
  ?>  
