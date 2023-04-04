<?php
include("functions.php");
include("header-ar.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Post a Feedback <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="section-title text-center mb-3">
            <h3>Product name</h3>
        </div>

        <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="feedback-wrapper">
                <div class="mb-2">
                    <label>Feedback Type*</label>
                    <select class="custom-select">
                        <option selected="">Positive</option>
                        <option>Negative</option>
                        <option>Neutral</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>Enter Feedback*</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>

                <div class="d-grid gap-2 d-md-block text-right">
                    <button class="btn btn-primary brand-btn">Back</button>
                    <button class="btn btn-primary brand-btn">Save</button>
                </div>
            </div>
        </div>

        <div class="col-md-3"></div>
    </div>
    </div>
    
</section>

<?php
include("footer-ar.php")
?>