<?php
include("functions.php");
include("header.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h4>Billing Address</h4>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="bill-ship-wrapper">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">First Name <span class="required-mark">*</span></label>
                                <input type="text" class="form-control" value="Sami">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">Last Name</label>
                                <input type="text" class="form-control" value="Elbadawi">
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>Billing Email <span class="required-mark">*</span></label>
                        <input type="email" class="form-control" value="test@gmail.com">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">Address <span class="required-mark">*</span></label>
                                <input type="address" class="form-control" value="Al Thumamah Road">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">Country <span class="required-mark">*</span></label>
                                <select class="custom-select">
                                    <option selected="">Saudi Arabia</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">State <span class="required-mark">*</span></label>
                                <input type="address" class="form-control" value="Riyadh">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">City</label>
                                <input type="address" class="form-control" value="Riyadh">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">Zipcode <span class="required-mark">*</span></label>
                                <input type="zip" class="form-control" value="12211">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">Phone</label>
                                <input type="tel" class="form-control" value="+966 12345 67890">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">Mobile</label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="mb-2">Fax</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-block">
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
include("footer.php")
?>