<?php
include("functions.php");
include("header-ar.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4>Post a feedback</h4>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="feedback-wrapper text-right">
                    <div class="text-center mb-3 wrapper-title">
                        <h5>Product Name</h5>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-2">Feeback Type <span class="required-mark">*</span></label>
                        <select class="custom-select">
                            <option selected="">Positive</option>
                            <option>Negative</option>
                            <option>Neutral</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-2">Enter Feedback <span class="required-mark">*</span></label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                    <div class="text-center">
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