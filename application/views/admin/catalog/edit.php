<?php $this->load->view('admin/catalog/head') ;?>
<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="<?php echo admin_url('catalog/edit/').$info->id?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/')?>images/icons/dark/add.png" class="titleIcon" />
                    <h6>Thêm mới danh muc san pham </h6>
                </div>

                <div class="tab_container">
                    <div id='tab1' class="tab_content pd0">

                        <div class="formRow">
                            <label class="formLeft" for="name">Name:<span class="req">*</span></label>
                            <div class="formRight">
                                    <span class="oneTwo">
                                        <input name="name" id="name" _autocheck="true" type="text" value="<?php echo $info->name?>" />
                                    </span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>



                        <div class="formRow">
                            <label class="formLeft" for="sort_order">Thứ tự hiển thị:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="sort_order" id="sort_order" _autocheck="true" type="text" value="<?php echo $info->sort_order?>" /></span>
                                <span name="sort_order_autocheck" class="autocheck"></span>
                                <div name="sort_order_error" class="clear error"><?php echo form_error('name')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label class="formLeft" for="parent_id">Danh mục cha:<span class="req">*</span></label>
                            <div class="formRight">
                                    <span class="oneTwo">
                                        <select name="parent_id" id="parent_id" _autocheck="true" type="text"  >
                                             <option value="0">Là danh mục cha</option>
                                            <?php foreach ($list as $item):?>
                                                <option value="<?php echo $item->id?>" <?php echo ($item->id == $info->parent_id) ? 'selected' : '' ?>>
                                                    <?php echo $item->name?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                    </div><!-- End tab_container-->

                    <div class="formSubmit">
                        <input type="submit" value="Cập nhật" class="redB" />
                        <input type="reset" value="Hủy bỏ" class="basic" />
                    </div>
                    <div class="clear"></div>
                </div>
        </fieldset>
    </form>
</div>
