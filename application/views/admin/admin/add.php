<?php $this->load->view('admin/admin/head') ;?>
<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="<?php echo admin_url('admin/add')?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/')?>images/icons/dark/add.png" class="titleIcon" />
                    <h6>Thêm mới Sản phẩm</h6>
                </div>

                <div class="tab_container">
                    <div id='tab1' class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Name:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="name" id="name" _autocheck="true" type="text" value="<?php echo set_value('name')?>" /></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Username:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="username" id="username" _autocheck="true" type="text" value="<?php echo set_value('username')?>"/></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('username')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Password:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="password" id="password" _autocheck="true" type="password" /></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('password')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Re-Password:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="re_password" id="re_password" _autocheck="true" type="password" /></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('re_password')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>



                </div><!-- End tab_container-->

                <div class="formSubmit">
                    <input type="submit" value="Thêm mới" class="redB" />
                    <input type="reset" value="Hủy bỏ" class="basic" />
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>
