<?php
include "db_connect.php";


$testimonial_query = "SELECT * FROM testimonial";
$testimonial_data = mysqli_query($conn, $testimonial_query);
$testimonial_result = mysqli_fetch_all($testimonial_data, MYSQLI_ASSOC);
?>


<!-- Tastimonial Start -->
 <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary">Our Testimonial</h4>
                    <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
                    <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                </div>
                <div class="owl-carousel testimonial-carousel">
                  
                  <?php foreach ($testimonial_result as $testimonial) { ?>
                    
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">

                        
                        <div class="position-relative">
                        
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0"><?php echo $testimonial['description'];   ?></p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="admin/images/testimonial/<?php echo $testimonial['image']; ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark"><?php echo $testimonial['name'];?></h4>
                                    <p class="m-0 pb-3"><?php echo $testimonial['designation'];?></p>
                                    <div class="d-flex pe-5">
                                        <?PHP for($i=0; $i< $testimonial['star']; $i++) {  ?>
                                        <i class="fas fa-star text-primary"></i>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Tastimonial End -->
        <script>
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll("#rating-stars i");
    const ratingValue = document.getElementById("rating-value");

    stars.forEach((star, index) => {
        star.addEventListener("click", function () {
            let selectedRating = index + 1;
            ratingValue.value = selectedRating;

            // Reset all stars to muted
            stars.forEach(s => s.classList.remove("text-warning"));
            stars.forEach(s => s.classList.add("text-muted"));

            // Highlight selected stars
            for (let i = 0; i < selectedRating; i++) {
                stars[i].classList.remove("text-muted");
                stars[i].classList.add("text-warning");
            }
        });
    });
});
</script>