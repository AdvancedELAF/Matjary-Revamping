<?php
include("functions.php");
include("header.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4">
            <h4>My Giftcards</h4>
        </div>

        <div class="giftcard-count">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="giftcard-table-title" scope="col">#</th>
                            <th class="giftcard-table-title" scope="col">Giftcard Name</th>
                            <th class="giftcard-table-title" scope="col">Giftcard Code</th>
                            <th class="giftcard-table-title" scope="col">Giftcard Amount</th>
                            <th class="giftcard-table-title" scope="col">Balance Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td class="gift-card-name"><h6>GFRDC2</h6></td>
                            <td class="gift-card-code"><h5>33134546523724</h5></td>
                            <td class="gift-card-price"><h5>20.00</h5></td>
                            <td class="gift-card-price"><h5>20.00</h5></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <button class="btn btn-primary brand-btn mx-auto d-block">Back</button>
    </div>
</section>

<?php
include("footer.php")
?>