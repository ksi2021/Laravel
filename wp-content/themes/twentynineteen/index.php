<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">
		
<?php
    $paged = (get_query_var('page')) ? get_query_var('page') : 1; //notice this 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 

 //query 5 posts
 	query_posts("posts_per_page=1&paged=$paged");
?>
<?php while (have_posts()) : the_post(); ?>
    <div class="entry">
        <div class="single_entry">
            <p>
                <?php get_template_part( 'template-parts/content/content' );  ?>
                <div class="clear"></div>
            </p>
           
            <div class="clear"></div>
        </div><!-- fin expert -->
    </div><!-- fin entry -->

<?php endwhile; wp_reset_query();	?>
<?php if(function_exists('wp_pagenavi')) { ?>
    <div id="pagination">
        <?php wp_pagenavi();  ?>
    </div>
<?php } ?>

		
		
<!-- 		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="change_page">
    <input name="target_page" type="hidden" value="1" id="target_page" />
</form>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>	
<script type="text/javascript">
    function go_to_page(target_page){
        var page = target_page;
        $("#target_page").val(page);
        $('#change_page').submit()
    }
	var page = 1;
    $(".wp-pagenavi").find("a").each(function(){
            
           
            // The if below, only apllies to the first link, since it doesn't use "/page/#" structure. 
           
			
            $(this).attr("href","/?page="+page);
			page +=1;
           
    });
</script> -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php
get_footer();
