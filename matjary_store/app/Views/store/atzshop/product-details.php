<?php
include("functions.php");
include("header.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="prod-detail-image">
                    <img src="assets/images/prod-1.jpg">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="prod-main-detail">
                    <div class="prod-detail-title">
                        <h3>Product Name</h3>
                    </div>
                    <div class="prod-detail-price">
                        <p>SAR 400.00</p>
                    </div>
                    <div class="prod-detail-icon">
                        <i class="icofont-star"></i>
                        <i class="icofont-star"></i>
                        <i class="icofont-star"></i>
                        <i class="icofont-star"></i>
                        <i class="icofont-star"></i>
                        <div class="prod-detail-rating">
                            <h6>(Customer Review)</h6>
                        </div>
                    </div>
                    <div class="prod-stock-count">
                        <h4>Stock: (991 Items)</h4>
                    </div>

                    <div class="prod-detail-desc">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>

                    <div class="col-md-6 mb-2 pl-0">
                        <div class="product-variation">
                            <select class="custom-select">
                                <option selected="">Colour</option>
                                <option>Red</option>
                                <option>Green</option>
                                <option>White</option>
                                <option>Black</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary brand-btn">Add to cart</button>
                        <button class="btn btn-primary brand-btn">Wishlist</button>
                    </div>

                    <div class="feedback-links mt-4">
                        <a href="post-feedback.php">
                            <h4><i class="icofont-ui-edit"></i> Post a feedback</h4>
                        </a>
                        <a href="view-feedback.php">
                            <h4><i class="icofont-eye-alt"></i> View all feebacks</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="prod-main-tab">
                <ul class="nav nav-pills prod-main-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item prod-main-item" role="presentation">
                        <a class="nav-link prod-main-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item prod-main-item" role="presentation">
                        <a class="nav-link prod-main-link" id="pills-summary-tab" data-toggle="pill" href="#pills-summary" role="tab" aria-controls="pills-summary" aria-selected="false">Summary</a>
                    </li>
                    <li class="nav-item prod-main-item" role="presentation">
                        <a class="nav-link prod-main-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews (100)</a>
                    </li>
                </ul>
                <div class="tab-content prod-main-content" id="pills-tabContent">
                    <div class="tab-pane prod-main-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                        <h4 class="prod-main-content-title">Description</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                    <div class="tab-pane prod-main-pane fade" id="pills-summary" role="tabpanel" aria-labelledby="pills-summary-tab">
                        <h4 class="prod-main-content-title">Summary</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                    <div class="tab-pane prod-main-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                        <h4 class="prod-main-content-title">Customer Reviews</h4>
                        <p>No Reviews Available</p>

                        <h6 class="prod-main-content-title">Review by Guest25 on 23-March-2022</h6>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("footer.php")
?>