<?php
get_header();

$term = get_queried_object(); // Get current city (taxonomy term)
$city_name = $term->name;
$city_image = get_term_meta($term->term_id, 'tim_cities_image', true);
?>

<div class="container">
    

   <div class="city-banner">
    <img src="https://timstayz.com/wp-content/uploads/2024/12/DSC01762-scaled.jpg" alt="<?php echo esc_attr($city_name); ?>">
    <div class="city-overlay">
        <h1>Hotels in <?php echo esc_html($city_name); ?></h1>
    </div>
</div>
</div>
    <section class="hotel-data">
        <div class="ct-container">
             <?php
             $args = array(
            'post_type'      => 'tim_hotel_booking',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'tim_cities',
                    'field'    => 'slug',
                    'terms'    => $term->slug,
                ),
            ),
            'posts_per_page' => 10,
        );

        $hotels = new WP_Query($args);

        if ($hotels->have_posts()) :
            while ($hotels->have_posts()) : $hotels->the_post();
                $hotel_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: 'https://via.placeholder.com/300';
        ?>
        <div class="hotel-item">
        <div class="row">
            
               <div class="col-md-6">
                 <a href="<?php the_permalink(); ?>"> <img src="<?php echo esc_url($hotel_image); ?>" alt="<?php the_title(); ?>"> </a>
               </div>
               <div class="col-md-4">
                 <div class="hotel-content">
                       <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3> </a>
                  <p><?php echo wp_trim_words(get_the_content(), 30); ?></p>
                  <p>City : <?php echo esc_html($city_name); ?> </p>
                  <div class="ct-header-cta" data-id="button">
	<a href="<?php the_permalink(); ?>" class="ct-button" data-size="medium" aria-label="Tim Stays">
	View Details	</a>
</div>
                 </div>
            
               </div>
           
        </div>
         </div>
              <?php
              endwhile;
              wp_reset_postdata();
              else :
              echo '<p>No hotels found in this city.</p>';
              endif;
              ?>
        
        </div>
        </div>
    </section>

   


<style>
    section.hotel-data {
        padding: 60px 0px;
    }
    
    .hotel-item {
       
        border: 1px solid #ddd;
       
        border-radius: 8px;
        background: #f9f9f9;
        margin-bottom: 30px;
    }
    .hotel-item img {
       width: 100%;
    height: 380px;
    border-radius: 6px 0px 0px 6px;
    object-fit: cover;
    }
    .hotel-item a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        background: #e77918;
    }
     .city-banner {
        position: relative;
        width: 100%;
        max-height: 300px;
        overflow: hidden;
            margin-top: -148px;
    }
    .hotel-content {
    padding: 15px 15px 20px;;
}

    .city-banner img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
    }

    .city-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgb(100 100 100 / 71%); /* Dark overlay */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .city-overlay h1 {
        color: #fff;
        font-size: 32px;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        text-align: center;
        padding-top: 75px;
    }
    .row {
    display: flex;
    width: 100%;
}
.col-md-6 {
    width: 60%;
}
.col-md-4 {
    width: 40%;
}

@media only screen and (max-width: 600px) {
 .row{
     display: block;
 }
 .col-md-6 {
    width: 100%;
}
.col-md-4 {
    width: 100%;
}
.hotel-item img{
    height: 230px;
}
.hotel-content h3 {
    font-size: 26px;
}
.hotel-item img{
    border-radius: 6px 6px 0px 0px;
}
.ct-icon, .ct-icon-container svg{
        fill: #ffffff !important;
}
}


</style>

<?php get_footer(); ?>
