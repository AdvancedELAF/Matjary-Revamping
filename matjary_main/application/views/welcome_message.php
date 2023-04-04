<div id="container">
    <div style ='margin:0 auto; text-align:center'>
        <a href="<?php echo base_url("Welcome/switchLang/english"); ?>">English</a> |
        <a href="<?php echo base_url("Welcome/switchLang/arabic"); ?>">Arabic</a>
    </div>
    <h1>Line 1:     <?php echo $this->lang->line('welcome') ?></h1>

    <div id="body">
        <p>Line 2:      <?php echo $this->lang->line('message') ?></p>

        <?php
        echo "<pre>";
        print_r($_SESSION);
        ?>
    </div>
</div>