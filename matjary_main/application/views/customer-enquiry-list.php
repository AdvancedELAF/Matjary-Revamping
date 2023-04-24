<?php include("modals/template_modal.php"); ?>

<section class="">
    <div class="custom-container">
        <div class="user-sec-title">
            <h4><?php echo $this->lang->line('user-acc-txt-45'); ?></h4>
        </div>

        <div class="dash-wrap blue-bg mb-4">

            <div class="alert <?php echo isset($msg_class)?$msg_class:''; ?> alert-dismissible fade show mx-auto text-center billing-alert" role="alert">
                <strong>
                    <?php
                    if ($msg = $this->session->flashdata('msg')) {
                        $msg_class = $this->session->flashdata('msg_class');
                        echo $msg;
                    }
                    ?>
                </strong>
            </div> 
                <table class="table table-bordered table-striped" id="viewAllSubscribersList">
                    <thead>
                        <tr>
                        <th>#</th>  
                        <th><?php echo $this->lang->line('user-acc-txt-46'); ?></th>
                        <th><?php echo $this->lang->line('user-acc-txt-47'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //echo '<pre>'; print_r($EnquiryList); die;
                            if (isset($EnquiryList) && !empty($EnquiryList)) {
                                $i = 1;
                                foreach ($EnquiryList as $value) {
                            ?>
                        <tr>
                            <td scope="row"><?php echo $i; ?></td>
                            <td><?php echo isset($value->ticket_id ) ? $value->ticket_id : 'NA'; ?></td>                                   
                            <td>                                         
                                <a class="dropdown-item" href="<?php echo base_url('ticket-details/' . $value->ticket_id); ?>"><i class="dw dw-edit2"></i>Details</a>
                             </td>
                        </tr>
                            <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5"><?php echo 'No record found'; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        
                    </tbody>
            </table>
            
        </div>
    </div>
</section>