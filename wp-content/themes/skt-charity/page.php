<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Charity
 */

if(is_front_page())
  $topContainerClass = "top-home-container";
else
  $topContainerClass = "top-container";

get_header(); ?>

	<div class="container <?php echo $topContainerClass?>">
      <div class="page_content">
    		 <section class="site-main">               
            		<?php if( have_posts() ) :
							while( have_posts() ) : the_post(); ?>
                            	<h1 class="entry-title"><?php the_title(); ?></h1>
                                <div class="entry-content">
                                			<?php the_content(); ?>
                                            <?php
												//If comments are open or we have at least one comment, load up the comment template
												if ( comments_open() || '0' != get_comments_number() )
													comments_template();
												?>
                                </div><!-- entry-content -->
                      		<?php endwhile; else : endif; ?>
                    
            </section><!-- section-->
  
<?php 
  if(is_front_page()){


      $postions = ccc_get_sections_position ();
      foreach ($postions as $postion) {

          switch ($postion){
            case 'slider_section':
            break;

            case 'ccc_5_column_1':
            error_log("recognized 5c1 output ");
            get_sidebar('five-column-widget-container-1');
            break;

            case 'ccc_5_column_2':
            error_log("recognized 5c2 output ");
            get_sidebar('five-column-widget-container-2');
            break;

            case 'ccc_3_column_1':
            error_log("recognized 3c1 output ");
            get_sidebar('three-column-widget-container-1');
            break;

            case 'ccc_3_column_2':
            error_log("recognized 3c2 output ");
            get_sidebar('three-column-widget-container-2');
            break;

            case 'ccc_1_column_1':
            error_log("recognized 1c1 output ");
            get_sidebar('one-column-widget-container-1');
            break;

            case 'ccc_1_column_2':
            error_log("recognized 1c2 output ");
            get_sidebar('one-column-widget-container-2');            
            break;

            case 'ccc_carousel_1':
            error_log("recognized carousel 1 output ");
            get_sidebar('carousel-1');
            break;

            case 'ccc_carousel_2':
            error_log("recognized carousel 2 output ");
            get_sidebar('carousel-2');
            break;            
          }
          
          
      }   

      
 
  }
?>
    <div class="clear"></div>
    </div><!-- .page_content --> 
    <script>


    </script>
 </div><!-- .container --> 
<?php get_footer(); ?>