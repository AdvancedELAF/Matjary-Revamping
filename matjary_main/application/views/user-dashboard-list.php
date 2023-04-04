<?php $this->load->view("common/header.php"); ?>
<!-- PRIVACY POLICY SECTION ONE STARTS -->
<div class="user-dashboard-wrapper">
    <div class="custom-container">
        <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-dashboard-tab" data-toggle="pill" href="#pills-dashboard" role="tab" aria-controls="pills-dashboard" aria-selected="true"><?php echo $this->lang->line('user-acc-txt-1'); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo $this->lang->line('user-acc-txt-2'); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-bhr-tab" data-toggle="pill" href="#pills-bhr" role="tab" aria-controls="pills-bhr" aria-selected="false"><?php echo $this->lang->line('user-acc-txt-3'); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-template-tab" data-toggle="pill" href="#pills-template" role="tab" aria-controls="pills-template" aria-selected="false"><?php echo $this->lang->line('user-acc-txt-33'); ?></a>
            </li>
            <li class="nav-item d-none" role="presentation">
                <a class="nav-link" id="pills-psp-tab" data-toggle="pill" href="#pills-psp" role="tab" aria-controls="pills-psp" aria-selected="false"><?php echo $this->lang->line('user-acc-txt-4'); ?></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="pills-dashboard-tab"><?php include_once 'user-dashboard.php'; ?></div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><?php include_once 'user-profile.php'; ?></div>
            <div class="tab-pane fade" id="pills-bhr" role="tabpanel" aria-labelledby="pills-contact-tab"><?php include_once 'user-purchase-history.php'; ?></div>
            <div class="tab-pane fade" id="pills-template" role="tabpanel" aria-labelledby="pills-template-tab"><?php include_once 'user-template-list.php'; ?></div>
            <div class="tab-pane fade" id="pills-psp" role="tabpanel" aria-labelledby="pills-psp-tab"><?php include_once 'user-pending-settlements.php'; ?></div>
        </div>
    </div>
</div>
<!-- Footer section  -->
<?php $this->load->view("common/footer.php"); ?>
<script>
    $(document).ready(function () {
        $("#country_id").trigger('change');
        var activeTab = window.location.hash;
        if (activeTab) {
            $(activeTab)[0].click();
        }
    });
</script>