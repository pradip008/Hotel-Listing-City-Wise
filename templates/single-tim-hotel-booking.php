<?php get_header(); ?>

<?php
// Get the gallery images from ACF (_hotel_gallery stores image IDs)
$gallery_images = get_post_meta(get_the_ID(), '_hotel_gallery', true);
?>

<?php
// Get post data
$hotel_title = get_the_title(); // Get hotel title
$hotel_description = get_the_content(); // Get hotel description
$gallery_images = get_post_meta(get_the_ID(), '_hotel_gallery', true); // Get gallery images
?>



<?php if (!empty($gallery_images)) : ?>
    <!-- Swiper Full-Screen Slider -->
    <div class="swiper-container main-slider hotel-gal">
        <div class="swiper-wrapper">
            <?php foreach ($gallery_images as $image_id) : 
                $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($image_url); ?>" alt="Hotel Image">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Navigation Arrows (Centered) -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- Progress Bar -->
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
    </div>

<?php endif; ?>

<section>
    <div class="row close-bot">
        <button class="open-btn" onclick="openPopup()">View All Images</button>
    </div>
</section>

<!-- Hotel Title & Description -->
<section class="details-hotel">
    <div class="ct-container">
        <div class="row">
            <div class="hotel-info">
                <h1 class="hotel-title"><?php echo esc_html($hotel_title); ?></h1>
                 <p class="hotel-description"><?php echo wp_kses_post($hotel_description); ?></p>
                 
                
                
               
            </div>
        </div>
    </div>
     
</section>


    
     <section class="amenities">
        <div class="ct-container">
             <div class="row">
                 <h1 class="amenities-title">Amenities</h1>
             </div> 
             <?php    // Check rows exists.
                if( have_rows('amenities') ):
             ?>
                  <div class="row">  
                        <?php // Loop through rows.
                        while( have_rows('amenities') ) : the_row();
                        // Load sub field value.
                         $amenities_image = get_sub_field('amenities_image');
                         $amenities_name = get_sub_field('amenities_name');
                        // Do something, but make sure you escape the value if outputting directly...?>
                         <div class="col-md-2">
                             <div class="box-nameicon">
                             <img src="<?php echo $amenities_image; ?>" width="80%">
                             <p class="amenities-name"><?php echo $amenities_name; ?></p>
                             </div>
                         </div>
                        <?php
                    
                    // End loop.
                    endwhile;?>
                    </div>
                    <?php
                
                // No value.
                else :
                    // Do something...
                endif;
                ?>
            
              <div class="row">
                 <h1 class="amenities-title pt-2">location</h1>
                 
             </div> 
             <div class="row">
                  <p style="padding-top:10px"><?php echo get_field('location_address');?></p>
                 </div> 
             <div class="row">
                
                  <div class="col-md-4">
                     <div class="box-nameicon left">
                     <img src="https://timstayz.com/wp-content/uploads/2025/03/bus-1.png" width="30%">
                     <p class="amenities-name"><?php echo get_field('location_bus_address');?></p>
                     <p style="padding-top:18px"><?php echo get_field('location_bus_time');?></p>
                     </div>
                 </div>
                  <div class="col-md-4">
                     <div class="box-nameicon left">
                     <img src="https://timstayz.com/wp-content/uploads/2025/03/train-1.png" width="30%">
                     <p class="amenities-name"><?php echo get_field('location_train_address');?></p>
                      <p style="padding-top:18px"><?php echo get_field('location_train_time');?></p>
                     </div>
                 </div>
                  <div class="col-md-4">
                     <div class="box-nameicon left">
                     <img src="https://timstayz.com/wp-content/uploads/2025/03/transport.png" width="30%">
                     <p class="amenities-name"><?php echo get_field('location_plain_address');?></p>
                      <p style="padding-top:0px"><?php echo get_field('location_plain_time');?></p>
                     </div>
                 </div>
                  
                
             </div>
             
             
              <div class="row pt-2">
                   <div class="col-md-6">
                        <h1 class="amenities-title ">Hotel Places Near by</h1>
                     <div class="near-place">
                     <?php echo get_field('place_near'); ?>
                     </div>
                 </div>
                  <div class="col-md-6">
                      
                     <div class="map">
                     
                    
                     <iframe src="<?php echo get_field('location'); ?>" width="600" height="280" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                 </div>
              </div>
               <div class="row" style="padding-bottom:40px">
                 <h1 class="amenities-title pt-2">Client Reviews</h1>
             </div> 
            <div class="row" style="padding-bottom:10px">
              <!-- Swiper Slider -->
        <div class="swiper mySwipertesti">
            <div class="swiper-wrapper">
                <div class="swiper-slide testimonialsa">
                    <p>"This product is amazing! It changed my life for the better!"</p>
                    <h4>- John Doe</h4>
                </div>
                <div class="swiper-slide testimonialsa">
                    <p>"Fantastic service, highly recommend to anyone!"</p>
                    <h4>- Jane Smith</h4>
                </div>
                <div class="swiper-slide testimonialsa">
                    <p>"Best experience I've ever had. Will definitely come back!"</p>
                    <h4>- Alex Johnson</h4>
                </div>
                <div class="swiper-slide testimonialsa">
                    <p>"Great quality and outstanding support team!"</p>
                    <h4>- Michael Brown</h4>
                </div>
                <div class="swiper-slide testimonialsa">
                    <p>"Affordable and effective, highly recommended!"</p>
                    <h4>- Sarah Wilson</h4>
                </div>
                <div class="swiper-slide testimonialsa">
                    <p>"Exceptional customer service and fast delivery!"</p>
                    <h4>- Emily Clark</h4>
                </div>
            </div>

            <!-- Pagination dots -->
            <div class="swiper-pagination"></div>
        </div>    
            </div> 
            
              <div class="row" style="padding-bottom:10px">
                 <h1 class="amenities-title pt-2">Why Choose Us</h1>
                 
             </div> 
              <div class="row" >
                  <?php echo get_field('why_choose_us'); ?>
                
                
             </div> 
              <div class="row" style="padding-bottom:30px">
                 <h1 class="amenities-title pt-2">Frequently Asked Questions</h1>
                 
             </div> 
              <div class="row" >
                  <div class="col-md-6">
                       <div class="accordion">
        <div class="faq-item">
            <button class="faq-question">What are the documents required for Check-in?</button>
            <div class="faq-answer">
                Indian nationals are needed to produce valid government-approved photo ID proofs like Masked Aadhar Card, Passport, Driving License, Voter ID Card etc. bearing their respective address. Foreign nationals are required to present their Passport & valid Visa
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">What is the smoking policy at Hotels?</button>
            <div class="faq-answer">
                For the health of our guests and the staff, the property is a no-smoking zone.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Is this service free to use?</button>
            <div class="faq-answer">
                Yes! Our basic services are free, but we also offer premium plans.
            </div>
        </div>
    </div>
                  </div>
                   <div class="col-md-6">
                       <div class="accordion">
        <div class="faq-item">
            <button class="faq-question">What is this website about?</button>
            <div class="faq-answer">
                This website provides useful information about various topics.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">How can I contact support?</button>
            <div class="faq-answer">
                You can contact support through our contact page or email us at support@example.com.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Is this service free to use?</button>
            <div class="faq-answer">
                Yes! Our basic services are free, but we also offer premium plans.
            </div>
        </div>
    </div>
                  </div>
                
                
             </div> 
        </div>
     </section>
     
     <section class="book-hotel-sec">
         
         <div class="ct-container">
             <h3>Booking Through Form</h3>
               <div class="elementor-element elementor-element-9f623c8 popmake-2372 elementor-widget elementor-widget-button pum-trigger" data-id="9f623c8" data-element_type="widget" data-widget_type="button.default" style="cursor: pointer;">
				<div class="elementor-widget-container">
					 <div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm book-btn" href="#">
						<span class="elementor-button-content-wrapper">
									<span class="elementor-button-text ">Book Now</span>
					</span>
					</a>
				</div>
								</div>
				</div>
         </div>
     </section>         
     
   
    

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var mainSlider = new Swiper('.main-slider', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            on: {
                slideChangeTransitionStart: function () {
                    let progressFill = document.querySelector('.progress-fill');
                    progressFill.style.transition = 'none';
                    progressFill.style.width = '0%';
                },
                slideChangeTransitionEnd: function () {
                    let progressFill = document.querySelector('.progress-fill');
                    progressFill.style.transition = 'width 4s linear';
                    progressFill.style.width = '100%';
                }
            }
        });
    });
</script>
 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <script>
        var swiper = new Swiper(".mySwipertesti", {
            slidesPerView: 1, // Default: Show 1 slide
            spaceBetween: 10,
            loop: true, // Looping is enabled for smooth auto-slide
            autoplay: {
                delay: 3000, // Auto-slide every 3 seconds
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                1024: { slidesPerView: 4, spaceBetween: 30 }, // Desktop: 3 slides
                768: { slidesPerView: 2, spaceBetween: 20 },  // Tablets: 2 slides
                480: { slidesPerView: 1, spaceBetween: 10 }   // Mobile: 1 slide
            }
        });
    </script>
<script>
        const questions = document.querySelectorAll(".faq-question");

        questions.forEach(question => {
            question.addEventListener("click", function () {
                const answer = this.nextElementSibling;

                // Toggle active class and show/hide answer
                this.classList.toggle("active");
                if (answer.style.display === "block") {
                    answer.style.display = "none";
                } else {
                    answer.style.display = "block";
                }
            });
        });
    </script>
<div class="popup" id="popup">
        <div class="popup-content">
            <button class="close-btn" onclick="closePopup()">Back</button>
            <div class="row" style="padding-top: 80px;">
                 <?php foreach ($gallery_images as $image_ids) : 
                $image_urls = wp_get_attachment_image_url($image_ids, 'full'); ?>
                 <div class="col-md-4 p-1">
                    <img src="<?php echo esc_url($image_urls); ?>" width="100%" class="gallery-imge" />
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>

   <script>
        function openPopup() {
            document.getElementById("popup").style.display = "flex";
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.body.style.overflow = 'auto';
        }
    </script>
<style>


    /* Full-Screen Swiper Slider */
    .main-slider {
        width: 100vw;
        height: 100vh;
        position: relative;
    }
    section.amenities {
    padding-bottom: 40px;
}
.box-nameicon img {
    filter: brightness(0) saturate(100%) invert(45%) sepia(94%) saturate(600%) hue-rotate(345deg) brightness(105%) contrast(100%) !important;
}
img.gallery-imge {
    height: 300px;
    object-fit: cover;
}
.box-nameicon.left {
    text-align: left;
    background: #ededed;
    padding: 11px 36px 0px;
    
}
.book-btn {
    background: #fa7436;
}
    h1.amenities-title.pt-2 {
    margin-top: 25px;
}
    span.location svg {
    margin-bottom: -5px;
}
p.amenities-name {
   font-size: 16px;
    font-weight: 500;
    font-family: 'Outfit';
    margin-bottom: 0px;
    line-height: 20px;
}

.col-md-4 {
    width: 33.33%;
}
u.l-icon {
    background: white;
    padding: 4px;
    border-radius: 15px;
}
    span.location {
    color: white;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.3px;
}
    .hotel-title {
        font-size: 36px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 3px;
    }
    section.details-hotel {
    padding-top: 45px;
    padding-bottom: 45px;
}
section.details-hotel .ct-container {
    background: #fa7436;
    padding: 20px 25px;
    border-radius: 15px;
}
    .hotel-description {
        font-size: 18px;
        color: #ffffff;
        margin: 5px auto;
    }
    .hotel-gal{
        margin-top: -120px;
    }
    .main-slider .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main-slider .swiper-slide img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
    }

    /* Navigation Arrows - Centered */
    .swiper-button-next,
    .swiper-button-prev {
        position: absolute;
        top: 60%;
        transform: translateY(-50%);
        color: white;
        background: rgb(250 116 54);
        padding: 20px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    
    .swiper-button-next:after, .swiper-button-prev:after{
        font-size: 23px;
    }
    .swiper-button-prev {
        left: 70px;
    }

    .swiper-button-next {
        right: 70px;
    }

    /* Progress Bar */
    .progress-bar {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        height: 4px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-fill {
        width: 0%;
        height: 100%;
        background: white;
        transition: width 4s linear;
    }
    .row {
    display: inline-flex;
    width: 100%;
    flex-wrap: wrap;
}
    .col-md-2 {
    width: 20%;
}
.box-nameicon {
    text-align: center;
   
    margin: 17px;
    height: 176px;
    border-radius: 10px;
    
    padding: 10px 36px 10px;
}
section.book-hotel-sec .ct-container {
    background: #e8e8e8;
    padding: 18px;
    margin-bottom: 67px;
    /* margin-left: 10px; */
    border-radius: 10px;
}
.col-md-6 {
    width: 50%;
}
.row.pt-2 {
    padding-top: 40px;
}
.map {
    padding-top: 16px;
}

.map iframe {
    border-radius: 20px;
}

/*acrodina*/
.accordion {
            max-width: 600px;
            margin: auto;
        }

        .faq-item {
            background: white;
            margin-bottom: 10px;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        .faq-question {
            width: 100%;
    background: #5a5a5a1a;
    color: #000000;
    padding: 8px 15px;
    text-align: left;
    font-size: 16px;
    border: none;
    cursor: pointer;
    display: flex
;
    justify-content: space-between;
    align-items: center;
    transition: background 0.3s;
        }

        .faq-question:hover {
            background: #d0d0d059;
        }

        .faq-answer {
            display: none;
            padding: 15px;
            background: white;
            font-size: 16px;
            color: #333;
        }

        /* Arrow icon */
        .faq-question::after {
            content: "▼";
            font-size: 11px;
            transition: transform 0.3s;
        }

        .faq-question.active::after {
            transform: rotate(180deg);
        }
        
        /*end accordion*/
        
        /*popup css*/
        
         /* Popup styles */
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            display: none;
            z-index: 9999;
        }

        .popup-content {
            background: #ffffff;
            padding: 20px;
           
            text-align: center;
            position: relative;
            width: 100%;
            min-width: 300px;
            height: 100vh;
            overflow-y: scroll;
        }

        /* Close button at the top-left */
        .close-btn {
            position: absolute;
    top: 20px;
    left: 0px;
    background: #ff8600;
    color: white;
    border: none;
    padding: 17px 17px;
    cursor: pointer;
    font-size: 22px;
    font-weight: 700;
    border-radius: 1px;
    display: flex
;
    width: 100%;
    align-items: center;
    margin-top: -21px;
        }
.col-md-4.p-1 {
    padding: 15px;
}
        .close-btn:hover {
            background: #4fc701;
        }

        /* Right arrow icon */
        .close-btn::before {
            content: " ←";
            font-size: 18px;
            margin-left: 5px;
        }

        /* Open button */
        .open-btn {
            padding: 3px 24px;
    font-size: 16px;
    cursor: pointer;
    background: #ff8600;
    color: white;
    border: none;
    border-radius: 5px;
    margin-right: 64px;
    margin-top: -52px;
    margin-bottom: 10px;
    z-index: 999;
        }

        .open-btn:hover {
            background: #4fc701;
        }
        
        .row.close-bot {
    display: flex;
    justify-content: right;
  
}
        /*popup css close*/
        
        
        /*testimonial slider css*/
        
        .swiper {
            width: 100%;
            padding-bottom: 40px;
        }
        .testimonialsa{
             padding: 20px;
        }
       
    
        .swiper-slide {
            background: #fff;
            
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            box-sizing: border-box;
        }

        .swiper-slide p {
            font-size: 16px;
            color: #333;
        }

        .swiper-slide h4 {
            margin-top: 10px;
            color: #fa7436;
            font-size:15px;
        }

        /* Swiper Pagination */
        .swiper-pagination-bullet-active {
            background: #fa7436;
        }
        
        /*testimonial slider css close */

@media only screen and (max-width: 600px) {
  .col-md-2 {
    width: 50%;
}
.col-md-6 {
    width: 100%;
}
.col-md-4 {
    width: 100%;
}
h1.amenities-title {
    font-size: 30px;
}

.close-btn{
    margin-top:0px;
}
.open-btn {
    padding: 0px 19px;
    font-size: 11px;
    cursor: pointer;
    background: #ff8600;
    color: white;
    border: none;
    border-radius: 5px;
    margin-right: 15px;
    margin-top: -43px;
    margin-bottom: 10px;
    z-index: 999;
    height: 32px;
}
.main-slider .swiper-slide img{
    height: 300px;
}
.main-slider {
        width: 100vw;
        height:300px;
        position: relative;
    }
}

</style>

<?php get_footer(); ?>
