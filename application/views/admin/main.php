<html>
    <head>
        <?php $this->load->view('admin/head');?>
    </head>
    <body>

        </div>
        <div id="left_content">
            <?php $this->load->view('admin/left');?>
        </div>
        <div id="rightSide">
            <div class="topNav">
                <?php $this->load->view('admin/header');?>
            </div>
<!--            Content      -->
            <?php $this->load->view($temp,$this->data);?>

            <div class="clear mt30"></div>
            <?php $this->load->view('admin/footer');?>

        </div>
        <div class="clear"></div>
    </body>
</html>