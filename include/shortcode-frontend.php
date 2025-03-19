<?php
function tim_display_cities_shortcode($atts) {
    $args = array(
        'taxonomy'   => 'tim_cities',
        'hide_empty' => false,
    );

    $terms = get_terms($args);

    if (empty($terms)) {
        return '<p>No cities found.</p>';
    }

    ob_start(); // Start output buffering
    ?>
    <style>
        .tim-cities-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0px; 
        }
        .tim-city-item {
            
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }
        .tim-city-item img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin-right: 11px;
        }
        .tim-city-item a {
            text-decoration: none;
            font-weight: bold;
            display: flex;
    align-items: center;
    border: 1px solid #2e695129;
    padding: 8px;
    border-radius: 10px;
        }
         @media only screen and (max-width: 600px) {
         .tim-cities-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 00px;
        }
        .tim-city-item a{
            display: block !important;
	 }
	 .tim-city-item{
		 text-align:center;
	 }
	 .ct-icon, .ct-icon-container svg{
        fill: #ffffff !important;
}
        }


    </style>

    <div class="tim-cities-grid">
        <?php foreach ($terms as $term) : 
            $image = get_term_meta($term->term_id, 'tim_cities_image', true);
            $image = $image ? esc_url($image) : 'https://via.placeholder.com/150'; // Default image if none is set
            $term_link = get_term_link($term);
        ?>
            <div class="tim-city-item">
                <a href="<?php echo esc_url($term_link); ?>">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($term->name); ?>">
                    <span><?php echo esc_html($term->name); ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php

    return ob_get_clean(); // Return the buffered content
}

add_shortcode('tim_cities_list', 'tim_display_cities_shortcode');
