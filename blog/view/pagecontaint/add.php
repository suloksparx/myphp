<div id="content_main">
    <div class="right_contant">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>index.php/adminarea">Dashboard</a> >><a
                href="<?= base_url() ?>index.php/managepagecontaint/index/<?php echo $pageId; ?>">
                Manage Static Page Conatint</a> >> <span
                style="font-pagecontaint: 12px"> Add Static Page Conatint</span>
        </div>
        <h2>Add Static Page Conatint</h2>
        <table cellspacing="2" cellpadding="0" border="0" align="center"
               width="100%">
            <tbody>
                <tr>
                    <td colspan="2"><div align="center"></div>
                    </td>
                </tr>
                <tr>
                    <td align="left" width="100%" valign="top"
                        style="margin-top: 10px; padding-top: 10px;">
                        <table cellpadding="5" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                               style="text-align: center;" align="center">
                                            <tr>
                                                <td align="center" style="text-align: center;"><?php if ($this->session->flashdata('success') != "") { ?>
                                                    <div class="error"
                                                         style="padding-left: 22px; font-weight: bold; color: #008000; text-align: center;">
                                                        <div
                                                            style="border: 1px solid #00ff00; background: #90EE90; padding: 5px 10px; display: inline-block; max-width: auto; width: auto; overflow: visible; line-height: 15px;">
                                                            <span style="margin-right: 5px;"><img height="15"
                                                                                                  border="0" width="15" alt=""
                                                                                                  src="<?= base_url() ?>images/msgcorrect.jpeg"> </span>
                                                                    <?= $this->session->flashdata('success'); ?>
                                                            </div>
                                                        </div> <?php } ?> <?php if ($this->session->flashdata('errordata') != "") { ?>
                                                        <div class="error"
                                                             style="padding-left: 22px; font-weight: bold; text-align: center;">
                                                            <div
                                                                style="border: 1px solid #FF0000; background: #F6D8D1; padding: 5px 10px; display: inline-block; max-width: auto; width: auto; overflow: visible; line-height: 15px;">
                                                                <span style="margin-right: 5px;"><img height="15"
                                                                                                      border="0" width="15" alt=""
                                                                                                      src="<?= base_url() ?>images/msgerr.jpeg"> </span>
                                                                    <?= $this->session->flashdata('errordata'); ?>
                                                            </div>
                                                        </div> <?php } ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- ================= Form Section ============== --> <br />
                                        <?php echo form_open_multipart('managepagecontaint/addrecord/' . $pageId); ?>
                                        <input type='hidden' name='baseurlval' id='baseurlval'
                                               value='<?= base_url() ?>'>
                                        <?php if(1==2){?>
                                        <p>
                                            <label for="name"><font color="#931010">*</font>Language</label>

                                            <select name="langid" id="langid" class="input-medium">
                                                <?php echo $this->pagecontaint_model->getLanguage($langid); ?>
                                            </select> &nbsp;&nbsp;
                                            <?php echo form_error('langid'); ?>
                                        </p> <br>
                                        <?php }?>
                                        <p>
                                            <label for="name"><font color="#931010">*</font>Static Page
                                                Title</label>
                                            <?php
                                            $data = array(
                                                'name' => 'staticpage_title',
                                                'id' => 'staticpage_title',
                                                'value' => $staticpage_title,
                                                'maxlength' => '100',
                                                'size' => '100',
                                                'class' => 'input-medium',
                                            );

                                            echo form_input($data);
                                            ?>
                                            &nbsp;&nbsp;
                                            <?php echo form_error('staticpage_title'); ?>
                                        </p> <br>
                                        <p>
                                            <label for="name"><font color="#931010">*</font>Static Page Containt</label>

                                            <?php
                                           /* $data = array(
                                                'name' => 'staticpage_containt',
                                                'id' => 'staticpage_containt',
                                                'toolbarset' => '',
                                                'width' => '600',
                                                'height' => '400',
                                                'value' => $staticpage_containt
                                            );

                                            echo form_fckeditor($data);*/
                                            ?>
                                            &nbsp;&nbsp;
                                            <?php //echo form_error('staticpage_containt'); ?>
                                            <?php echo $this->ckeditor->editor('staticpage_containt',@$staticpage_containt);?> 
                                            <?php echo form_error('staticpage_containt','<p class="error">'); ?>
                                            
                                        </p> <br>
                                        <p>
                                            <label for="name"><font color="#931010"></font>Meta Title</label>
                                            <?php
                                            $data = array(
                                                'name' => 'meta_title',
                                                'id' => 'meta_title',
                                                'value' => $meta_title,
                                                'maxlength' => '100',
                                                'size' => '100',
                                                'class' => 'input-medium',
                                            );

                                            echo form_input($data);
                                            ?>
                                            &nbsp;&nbsp;
                                            <?php echo form_error('meta_title'); ?>
                                        </p> <br>

                                        <p>
                                            <label for="name"><font color="#931010"></font>Key Words</label>
                                            <?php
                                            $data = array(
                                                'name' => 'key_word',
                                                'id' => 'key_word',
                                                'value' => $key_words,
                                                'rows' => 10,
                                                'cols' => 10,
                                            );

                                            echo form_textarea($data);
                                            ?>
                                            &nbsp;&nbsp;
                                            <?php echo form_error('key_word'); ?>
                                        </p> <br>

                                        <p>
                                            <label for="name"><font color="#931010"></font>Description</label>
                                                <?php
                                                /*$data = array(
                                                    'name' => 'description',
                                                    'id' => 'description',
                                                    'value' => $description,
                                                    'rows' => 10,
                                                    'cols' => 10,
                                                );

                                                echo form_textarea($data);*/
                                                ?>
                                            &nbsp;&nbsp;
                                            <?php //echo form_error('description'); ?>
                                               <?php echo $this->ckeditor->editor('description',@$staticpage_containt);?>
                                            <?php echo form_error('description','<p class="error">'); ?>
                                        </p> <br>

                                        <p>
                                            <br />
                                                <?php
                                                $submitdata = array(
                                                    'name' => 'submit',
                                                    'id' => 'submit',
                                                    'value' => 'Add',
                                                    'class' => 'button',
                                                );
                                                echo form_submit($submitdata);
                                                ?>
                                            &nbsp;&nbsp;&nbsp; <input name="button" type="button"
                                                                      onClick="javascript:window.location='<?php echo base_url(); ?>index.php/managepagecontaint/index/<?php echo $pageId; ?>';"
                                                                      value="Back" class="button" />
                                        </p> <?php echo form_close(); ?> <!-- ================= Form Section ============== -->

                                    </td>
                                </tr>
                            </tbody>
                        </table></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
