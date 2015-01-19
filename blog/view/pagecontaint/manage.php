<div id="content_main">
    <div class="right_contant">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>index.php/adminarea">Dashboard</a> >> <span
                style="font-size: 12px"> Manage Static Page Conatint</span>
        </div>
        <h2>Manage Static Page Conatint</h2>
        <?php
        $js = 'name="myform" id="myform"';
        echo form_open('managepagecontaint/index/' . $pageId, $js);
        ?>
        <table cellspacing="2" cellpadding="0" border="0" align="center"
               width="100%">
            <tbody>
                <tr>
                    <td>
                        <table cellspacing="1" cellpadding="5" border="0" align="center"
                               width="100%" style="BORDER: #666666 1px solid;" class="border">
                            <tbody>
                                <tr
                                    style="background-color: #999999; height: 25px; vertical-align: middle; color: #ffffff; font-weight: bold; line-height: 24px;">
                                    <td style="font-size: 13px;" colspan="2">Search Panel</td>
                                </tr>

                                <tr>
                                    <td width="29%" style="text-align: right; padding-top: 13px;"><strong>Static
                                            Page Title:</strong>
                                    </td>
                                    <td valign="top">&nbsp; <?php
        $data = array(
            'name' => 'name',
            'id' => 'name',
            'value' => $name,
            'maxlength' => '25',
            'size' => '25',
            'class' => 'input-medium',
        );

        echo form_input($data);
        ?></td>
                                </tr>

                                <tr>
                                    <td align="right" width="29%">&nbsp;</td>
                                    <td valign="top">&nbsp; <?php
                                        $submitdata = array(
                                            'name' => 'Search',
                                            'id' => 'Search',
                                            'value' => 'Search',
                                            'class' => 'button',
                                        );
                                        echo form_submit($submitdata);
        ?> <input type="button"
                                               onclick="javascript:show_all('<?= base_url() ?>index.php/managepagecontaint/index/<?php echo $pageId; ?>');"
                                               value="Reset" class="button" name="btnShowAll"></td>
                                </tr>
                            </tbody>
                        </table></td>
                </tr>
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
                            <tbody>
                                <tr>
                                    <td align="left" width="40%">Action:&nbsp; <select
                                            name="action" class="input-medium" style="width: 140px;">
                                            <option value="">&nbsp;Select Action</option>
                                            <?php if ($this->general_model->checkDeletePermission("managestaticpage.php")) { ?>
                                                <option value="deleteselected">&nbsp;Delete Selected</option>
                                            <?php } ?>
                                            <option value="enableall">&nbsp;Enable Selected</option>
                                            <option value="disableall">&nbsp;Disable Selected</option>
                                        </select> &nbsp; <?php
                                            $submitdata1 = array(
                                                'name' => 'submit',
                                                'id' => 'submit',
                                                'value' => 'Submit',
                                                'class' => 'button',
                                            );
                                            echo form_submit($submitdata1);
                                            ?></td>
                                    <td align="center" width="50%"></td>
                                    <td align="center" width="50%" style="display: none;"><?php if ($this->general_model->checkDeletePermission("managestaticpage.php")) { ?>
                                            <input type="button"
                                                   onclick="javascript:deleteAll('pagecontaint');"
                                                   value="Delete All Data" class="button" name="btnShowAll">
                                            &nbsp;&nbsp; <?php } ?> <input type="button"
                                                                       onclick="javascript:restoreAll('pagecontaint','<?= base_url() ?>','managepagecontaint/index/<?php echo $pageId; ?>');"
                                                                       value="Restore All Data" class="button" name="btnShowAll"></td>
                                    <td align="right" width="5%" colspan="2"><a
                                            title="Refresh the page"
                                            href="<?= base_url() ?>index.php/managepagecontaint/index/<?php echo $pageId; ?>"><img
                                                height="32" border="0" width="30" alt=""
                                                src="<?= base_url() ?>images/icon_reload.png"> </a>
                                    </td>
                                    <?php if ($this->general_model->checkAddPermission("managestaticpage.php")) { ?>
                                        <td align="right" width="5%" colspan="2"><a title="Add New"
                                                                                    href="<?= base_url() ?>index.php/managepagecontaint/add/<?php echo $pageId; ?>"><img
                                                    height="32" border="0" width="30" alt=""
                                                    src="<?= base_url() ?>images/add.png"> </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table></td>
                </tr>
                <tr>
                    <td align="center" style="text-align: center;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="text-align: center;" align="center">
                            <tr>
                                <td align="center" style="text-align: center;"><?php if ($this->session->flashdata('success') != "") { ?>
                                        <div class="error"
                                             style="padding-left: 22px; font-weight: bold; color: #008000; text-align: center;">
                                            <div
                                                style="border: 1px solid #00ff00; background: #90EE90; padding: 5px 10px; display: inline-block; max-width: auto; width: auto; overflow: visible; line-height: 15px;">
                                                <span style="margin-right: 5px;"><img height="15" border="0"
                                                                                      width="15" alt=""
                                                                                      src="<?= base_url() ?>images/msgcorrect.jpeg"> </span>
                                                    <?= $this->session->flashdata('success'); ?>
                                            </div>
                                        </div> <?php } ?> <?php if ($this->session->flashdata('errordata') != "") { ?>
                                        <div class="error"
                                             style="padding-left: 22px; font-weight: bold; text-align: center;">
                                            <div
                                                style="border: 1px solid #FF0000; background: #F6D8D1; padding: 5px 10px; display: inline-block; max-width: auto; width: auto; overflow: visible; line-height: 15px;">
                                                <span style="margin-right: 5px;"><img height="15" border="0"
                                                                                      width="15" alt="" src="<?= base_url() ?>images/msgerr.jpeg"> </span>
                                                    <?= $this->session->flashdata('errordata'); ?>
                                            </div>
                                        </div> <?php } ?></td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td bgpagecontaint="#FFFFFF" valign="top">
                        <table cellspacing="2" cellpadding="5" border="0" align="center"
                               width="100%" class="compareTbl">
                            <tbody>
                                <tr class="whiteTxt font14 bgGray">
                                    <td align="center" width="2%"><input type="checkbox"
                                                                         onclick="checkedAll()" name="checkall">
                                    </td>
                                    <td align="center" width="5%">#</td>
                                   <!-- <td align="center" width="10%">Language</td>-->
                                    <td align="center" width="20%"><?php echo orderBy(base_url("index.php/managepagecontaint/index/") . $pageId, "pageid", "Page Name", $page, $per_page, $order, $orderby) ?>
                                    </td>
                                    <td align="center" width="20%"><?php echo orderBy(base_url("index.php/managepagecontaint/index/") . $pageId, "pageid", "Page URL", $page, $per_page, $order, $orderby) ?>
                                    </td>
                                    <td align="center" width="20%"><?php echo orderBy(base_url("index.php/managepagecontaint/index/") . $pageId, "pageTitle", "Page Title", $page, $per_page, $order, $orderby) ?>
                                    </td>
                                    <td align="center" width="15%">Status</td>
                                    <td align="center" width="15%">View</td>
                                    <td align="center" width="15%">Edit</td>
                                    <td align="center" width="15%">Delete</td>
                                </tr>
                                <?= $this->pagecontaint_model->allrecord(); ?>
                            </tbody>
                        </table></td>
                </tr>
            </tbody>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>