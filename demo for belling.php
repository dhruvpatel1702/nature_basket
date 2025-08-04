<div class="container-fluid" >
        <div class="container" style="margin-top:200px;">
            <div class="confirmation-container">
               <div class="feedback-container">
                <h3 class="text-center" style="color: #81c408;">Share Your Feedback</h3>
                <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
                <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" 
                        value="<?php echo $_SESSION['user_email'] ?? ''; ?>"required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="designation" placeholder="Your designation" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="description" placeholder="description" required>
                    </div>

                    <div class="mb-3">
                        <label for="url">Image</label>
                        <input type="file" id="image" name="image" class="form-control" value="">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Feedback</button></form></div>
                 </div>
              </div>
           </div>
        </div>
