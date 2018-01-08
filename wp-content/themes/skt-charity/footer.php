
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Charity
 */

if(is_front_page())
  $containerClass = "'footer-wrapper home'";
else
  $containerClass = "'footer-wrapper'";


  $address = get_theme_mod('contact_add',__('100 King St, Melbourne PIC 4000,<br /> Australia','skt-charity'));
  $mapLink = 'https://www.google.com/maps/place/' . urlencode($address);

  /*require_once plugin_dir_path(dirname(__FILE__)) . '../plugins/castrocc/includes/class-castrocc-data.php';
  $dataManager = new CastroCC_Data();

  $todaysMeetings = $dataManager->getTodaysMeetings(); 
                  <h5><?php echo get_theme_mod('social_title',__('Latest Posts','skt-charity')); ?></h5>  
                 <?php $args = array( 'posts_per_page' => 2, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
                    query_posts( $args ); ?>
                  <?php while ( have_posts() ) :  the_post(); ?>
                    <div class="recent-post">
                    
                    <a href="<?php the_permalink(); ?>">

                    */

?>
<div class=<?php echo $containerClass;?> id="footer-wrapper">
      <div class="container">
             <div class="cols-3 widget-column-1">
                <div class="columnfix"> 
                <h3><?php echo get_theme_mod('contact_title',__('Contact Info','skt-charity')); ?></h3>                   
                   <p><a href='<?php echo $mapLink?>' target='_blank'><?php echo $address ?> </a></p>
                <div class="phone-no"><?php echo get_theme_mod('contact_no',__('<strong>Phone:</strong> +123 456 7890','skt-charity')); ?> <br  />
                <strong> <?php esc_attr_e('Email:','skt-charity');?></strong>
           

                <a href="mailto:<?php echo sanitize_email(get_theme_mod('contact_mail','contact@company.com')); ?>"><?php echo esc_attr(get_theme_mod('contact_mail','contact@company.com')); ?></a></div>
           
                <div class="clear"></div>                
                  <div class="social-icons">
                     <?php if ( get_theme_mod('fb_link') != "") { ?>
                    <a title="facebook" class="fb" target="_blank" href="<?php echo esc_url(get_theme_mod('fb_link','#facebook')); ?>"></a> 
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="fb" title="facebook"></a>'; } ?>
                    
                    <?php if ( get_theme_mod('twitt_link') != "") { ?>
                    <a title="twitter" class="tw" target="_blank" href="<?php echo esc_url(get_theme_mod('twitt_link','#twitter')); ?>"></a>
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="tw" title="twitter"></a>'; } ?> 
                    

                  </div> 
                   </div> 
             </div><!--end .widget-column-1-->   
              
                      
               <div class="cols-3 widget-column-2">
                <div class="columnfix"> 
                  <h3><?php echo get_theme_mod('about_title',__('About Us','skt-charity')); ?></h3>             
                  <p><?php echo get_theme_mod('about_description',__('filler')); ?></p>             
                </div>
               </div><!--end .widget-column-3-->

               <div class="cols-3 widget-column-3">

                <div class="columnfix" style="padding-right: 0px;">   
                    <h3 >Hours</h3>    
                    <ul style="display: table">
                      <li style="display: table-row;"><div class="footer-hours-label">Sunday</div>
                        <div class="footer-hours"><?php echo get_theme_mod('sunday_hours',__('8:00am - 10:00pm','skt-charity')); ?></div></li>
                      <li style="display: table-row;"><div class="footer-hours-label">Monday</div>
                        <div class="footer-hours"><?php echo get_theme_mod('monday_hours',__('8:00am - 10:00pm','skt-charity')); ?></div></li>
                      <li style="display: table-row;"><div class="footer-hours-label">Tuesday</div>
                        <div class="footer-hours"><?php echo get_theme_mod('tuesday_hours',__(' 8:00am - 10:00pm','skt-charity')); ?></div></li>
                      <li style="display: table-row;"><div class="footer-hours-label">Wednesday</div>
                        <div class="footer-hours"><?php echo get_theme_mod('wednesday_hours',__(' 8:00am - 10:00pm','skt-charity')); ?></div></li>
                      <li style="display: table-row;"><div class="footer-hours-label">Thursday</div>
                        <div class="footer-hours"><?php echo get_theme_mod('thursday_hours',__(' 8:00am - 10:00pm','skt-charity')); ?></div></li>
                      <li style="display: table-row;"><div class="footer-hours-label">Friday</div>
                        <div class="footer-hours"><?php echo get_theme_mod('friday_hours',__(' 8:00am - 10:00pm','skt-charity')); ?></div></li>
                      <li style="display: table-row;"><div class="footer-hours-label">Saturday</div>
                        <div class="footer-hours"><?php echo get_theme_mod('saturday_hours',__(' 8:00am - 10:00pm','skt-charity')); ?></div></li></ul>          
                </div>
               </div><!--end .widget-column-3-->
                
              <div class="clear"></div>

        </div><!--end .container-->
        <div class="copyright-wrapper">
        <div class="container">
              <div class="copyright-txt"><?php esc_attr_e('&copy; 2016','skt-charity');?> <?php bloginfo('name'); ?>. <?php esc_attr_e('All Rights Reserved', 'skt-charity');?></div>
                <div class="design-by"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php wp_footer(); ?>

</body>
</html>