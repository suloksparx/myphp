<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style1.css" />
<div id="content_main" style="width: 800px; margin: 0px;">
    <div class="right_contant" style="margin: 20px auto;">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>index.php/adminarea">Dashboard</a> >><a
                href="<?= base_url() ?>index.php/managepagecontaint/index/<?php echo $pageid; ?>">
                Manage Static Page Conatint</a> >> <span style="font-currency: 12px">
                View Static Page Conatint</span>
        </div>
        <h2>View Static Page Conatint</h2>
        <table cellspacing="2" cellpadding="0" border="0" align="center"
               width="100%">
            <tbody>
                <tr>
                    <td colspan="2"><div align="center"></div></td>
                </tr>
                <tr>
                    <td align="left" width="100%" valign="top"
                        style="margin-top: 10px; padding-top: 10px;">
                        <!-- ================= View Section ============== -->

                        <table cellpadding="0" border="0" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td style="text-align: right;" width="20%"><strong>Static Page
                                            Name</strong></td>
                                    <td width="5%"><strong>:</strong></td>
                                    <td width="55%"><strong><?= stripslashes($this->pagecontaint_model->fetchValue(TBL_STATICPAGEDESC, "staticPageName", "staticpagetypeId = $pageid AND langId = '" . $langId . "'")) ?>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;" width="20%"><strong>Static Page
                                            URL</strong></td>
                                    <td width="5%"><strong>:</strong></td>
                                    <td width="55%"><strong><?= stripslashes($this->pagecontaint_model->fetchValue(TBL_STATICPAGE, "pageUrl", "id = $pageid")) ?>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;" width="20%"><strong>Static Page
                                            Title</strong></td>
                                    <td width="5%"><strong>:</strong></td>
                                    <td width="55%"><strong><?= stripslashes($pageTitle) ?> </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;" width="20%"><strong>Static Page
                                            Conatint</strong></td>
                                    <td width="5%"><strong>:</strong></td>
                                    <td width="55%"><strong><?= stripslashes($pageContaint) ?> </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table> <!-- ================= View Section ============== -->
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>