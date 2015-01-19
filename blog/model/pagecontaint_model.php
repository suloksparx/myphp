<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagecontaint_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("session");
    }

    /*     * *************function to get all page contents ************* */

    public function allrecord() {
        $pageId = $this->uri->segment(3, 0);
        $page = $this->uri->segment(4, 0);
        $start = 0;
        $searchval = "";
        $config['base_url'] = base_url() . "index.php/managepagecontaint/index/";
        $config['per_page'] = $this->uri->segment(5, 0) ? $this->uri->segment(5, 0) : 10;
        $config['uri_segment'] = 3;
        $langid = $this->session->userdata('DEFAULTLANGUAGEID');
        $this->db->where("isDeleted", '0');
        $this->db->where("pageid", $pageId);
        $query = $this->db->get(TBL_STATICPAGECONTAINT);
        $rows = $query->num_rows();
        $config['total_rows'] = $rows;
        if ($query->num_rows() > 0) {
            $i = 1;
            if ($page > 0 && $page < $config['total_rows'])
                $start = $page;
            if ($this->input->post('name')) {
                $this->db->like('pageTitle', $this->input->post('name'));
            }
            $this->db->limit($config['per_page'], $start);
            $orderby = $this->uri->segment(6, 0) ? $this->uri->segment(6, 0) : "id";
            $order = $this->uri->segment(7, 0) ? $this->uri->segment(7, 0) : "ASC";
            $this->db->order_by($orderby, $order);
            $this->db->where("isDeleted", '0');
            $this->db->where("pageid", $pageId);
            $query1 = $this->db->get(TBL_STATICPAGECONTAINT);
            $numrows = $query1->num_rows();
            $table = "<input type='hidden' name='baseurlval' id='baseurlval' value='" . base_url() . "'>";
            foreach ($query1->result() as $line) {
                $highlight = $i % 2 == 0 ? "bglingtGray" : "";
                $div_id = "status" . $line->id;
                if ($line->status == 1) {
                    $status = '<img src="' . base_url() . 'images/eye.png" alt="Inactive" border="0" style="background-repeat:no-repeat; cursor:pointer;" title="Inactive">';
                } else {
                    $status = '<img src="' . base_url() . 'images/eye-disabled.png" alt="Active" border="0" style="background-repeat:no-repeat; cursor:pointer;" title="Active">';
                }
                $isDefault = "";
                $onclickstatus = ' onClick="javascript:changeStatus(\'' . $div_id . '\',\'' . $line->id . '\',\'pagecontaint\')"';
                $chkbox = '<input name="chk[]" value="' . $line->id . '" type="checkbox" class="checkbox">';
                $delete = "<a href='javascript:void(NULL);'  onClick=\"if(confirm('Are you sure to delete this Record  ?')){window.location.href= '" . base_url() . "index.php/managepagecontaint/delete/" . $pageId . "/" . $line->id . "'}else{}\" >";
                $delete .= '<img src="' . base_url() . 'images/drop.png" alt="" border="0" style="cursor:pointer;" title="Delete"></a>';
                $edit = '<a title=" Edit " href="' . base_url() . 'index.php/managepagecontaint/edit/' . $pageId . '/' . $line->id . '"><img border="0" title="Edit" alt="" src="' . base_url() . 'images/edit.png"></a>';
                if ($this->general_model->checkEditPermission("managestaticpage.php")) {
                    $edit = $edit;
                } else {
                    $edit = "--";
                }
                if ($this->general_model->checkDeletePermission("managestaticpage.php")) {
                    $delete = $delete;
                } else {
                    $delete = "--";
                }
                $table .= '<tr  class="' . $highlight . '">
			        <td align="right" valign="middle" style="padding-right:5px;">' . $chkbox . '</td>
					<td align="right" valign="middle" style="padding-right:5px;">' . $i . '</td>
					';//<td align="left" valign="middle" style="padding-left:10px;">' . $this->fetchValue(TBL_LANGUAGE, "languageName", "id = '" . $line->langId . "'") . '</td>
					$table .='<td align="left" valign="middle" style="padding-left:10px;">' . stripslashes($this->fetchValue(TBL_STATICPAGEDESC, "staticPageName", "staticpagetypeId = $line->pageid AND langId = '" . $line->langId . "'")) . '</td>
					<td align="left" valign="middle" style="padding-left:10px;">' . $this->fetchValue(TBL_STATICPAGE, "pageUrl", "id = $line->pageid") . '</td>
					<td align="left" valign="middle" style="padding-left:10px;">' . stripslashes($line->pageTitle) . '</td>						
                                        <td align="center"><div id=' . $div_id . ' ' . $onclickstatus . '>' . $status . '</div></td>				
					<td align="left" valign="middle" style="padding-left:10px;"><a id="example2" title=" View " href="' . base_url() . 'index.php/managepagecontaint/view/' . $pageId . '/' . $line->id . '"><img border="0" title="View" alt="" src="' . base_url() . 'images/view.png"></a></td>			
					<td align="center">' . $edit . '</td>				
					<td align="center">' . $delete . '</td>					
				   </tr>';
                $i++;
            }
            $sel1 = "";
            $sel2 = "";
            $sel3 = "";
            $sel4 = "";
            switch ($config['per_page']) {
                case 10:
                    $sel1 = "selected='selected'";
                    break;
                case 20:
                    $sel2 = "selected='selected'";
                    break;
                case 30:
                    $sel3 = "selected='selected'";
                    break;
                case $query->num_rows():
                    $sel4 = "selected='selected'";
                    break;
            }
            $this->pagination->initialize($config);
            /* $table .= '<tr>
              <td align="right" valign="middle" colspan="3" style="padding-right:5px; border-right:0px;">Total '.$rows.' records found.</td>
              <td align="right" valign="middle" colspan="2" style="padding-right:5px; border-right:0px; border-left:0px;">
              <input type="hidden" name="pagename" id="pagename" value='.$config['base_url'].'>
              Display <select name="limit" id="limit" onchange="pagelimit(this.value,\''.$orderby.'\',\''.$order.'\',\''.$searchval.'\');" style="width:50px;">
              <option value="10" '.$sel1.'>10</option>
              <option value="20" '.$sel2.'>20</option>
              <option value="30" '.$sel3.'>30</option>
              <option value='.$rows.' '.$sel4.'>All</option>
              </select> Records Per Page

              </td>

              <td align="right"  colspan="6" style="text-align:right; font-size:14px; border-left:0px;">'.$this->pagination->create_links().'</td>
              </tr>'; */
        } else {
            $table = '<tr class="bglingtGray">
					<td align="right" valign="middle" style="padding-right:5px; color:#CC0000" colspan="10">Sorry not record found!</td>
					</tr>';
        }
        return $table;
    }

    /*     * *************function to add page content ************* */

    public function addrecords($post, $staticpage_containt) {
        //print_r($post);
        $pageId = $this->uri->segment(3, 0);
        $staticpagename = $pageId;
        $staticpage_title = $post['staticpage_title'];
        $meta_title = $post['meta_title'];
        $keywords = $post['key_word'];
        $description = $post['description'];
        // echo $description;die;
        $staticpage_containt = $staticpage_containt;
        $langId = $post['langid'];
        $date = date("Y-m-d");
        // echo $staticpagename;die;
        $prevalue = $this->fetchValue(TBL_STATICPAGECONTAINT, "id", "pageid = $staticpagename AND langId = '" . $langId . "' AND isDeleted='0' ");
        if ($prevalue) {
            $this->session->set_flashdata('errordata', 'Page Containt already exist! Please Select another page and add containt.');
            redirect(base_url() . "index.php/managepagecontaint/add/" . $pageId);
            return false;
        } else {
            $data = array(
                'langId' => $langId,
                'pageid' => addslashes(trim($staticpagename)),
                'pageTitle' => addslashes(trim($staticpage_title)),
                'pageContaint' => addslashes(trim($staticpage_containt)),
                'metaTitle' => addslashes(trim($meta_title)),
                'keyWords' => addslashes(trim($keywords)),
                'description' => addslashes(trim($description)),
                'isDeleted' => '0',
                'status' => '1',
                'addDate' => $date
            );
            $this->db->insert(TBL_STATICPAGECONTAINT, $data);
            $inserted_id = $this->db->insert_id();

            if (!$inserted_id) {
                log_message('error', $this->db->_error_message());
                return false;
            } else {
                $this->session->set_flashdata('success', 'Static Page Containt has been added successfully.');
                redirect(base_url() . "index.php/managepagecontaint/add/" . $pageId);
                return true;
            }
        }
    }

    /*     * *************function to change status of page content ************* */

    public function changStatus($get) {
        $this->db->where('id', $get['id']);
        $query = $this->db->get(TBL_STATICPAGECONTAINT);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $pagecontaint = $value->status;
            }
        }
        if ($pagecontaint == '1') {
            $stat = '0';
            $status1 = '<img src="' . base_url() . 'images/eye-disabled.png" alt="Active" title="Active" style="cursor:pointer;">';
        } else {
            $stat = '1';
            $status1 = '<img src="' . base_url() . 'images/eye.png" alt="InActive" title="InActive" style="cursor:pointer;">';
        }
        $this->db->where('id', $get['id']);
        $postarray = array(
            'status' => $stat,
            'modDate' => date('Y-m-d H:i:s')
        );
        $this->db->update(TBL_STATICPAGECONTAINT, $postarray);
        return $status1;
    }

    /*     * *************function to delete page content ************* */

    public function deleteRecord($get) {
        $this->db->where('id', $get['id']);
        $postarray = array(
            'isDeleted' => '1',
            'modDate' => date('Y-m-d H:i:s')
        );
        $this->db->update(TBL_STATICPAGECONTAINT, $postarray);
        $this->session->set_flashdata('success', 'Your information has been deleted successfully.');
        redirect(base_url() . "index.php/managepagecontaint/index/" . $get['pageId']);
        return true;
    }

    /*     * *************function to get page content from id ************* */

    public function getrecord($id) {
        $result = array();
        $this->db->where('id', $id);
        $query = $this->db->get(TBL_STATICPAGECONTAINT);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $value) {
                $result = $value;
            }
        }
        return $result;
    }

    /*     * *************function to edit page content ************* */

    public function editrecords($post, $staticpage_containt) {
        // print_r($post);die;

        $pageId = $this->uri->segment(3, 0);
        $staticpagename = $pageId;
        $staticpage_title = $post['staticpage_title'];
        $staticpage_containt = $staticpage_containt;
        $meta_title = $post['meta_title'];
        $key_words = $post['key_word'];
        $description = $post['description'];
        $langId = $post['langid'];
        $id = $post['id'];
        $date = date("Y-m-d");
        $prevalue = $this->fetchValue(TBL_STATICPAGECONTAINT, "id", "pageid = $staticpagename AND id != $id AND langId = '" . $langId . "'");
        if ($prevalue) {
            $this->session->set_flashdata('errordata', 'Page Containt already exist! Please Select another page and add containt.');
            redirect(base_url() . "index.php/managepagecontaint/edit/" . $pageId . "/" . $post['id']);
            return true;
        } else {
            $data = array(
                'langId' => $langId,
                'pageid' => addslashes(trim($staticpagename)),
                'pageTitle' => addslashes(trim($staticpage_title)),
                'pageContaint' => addslashes(trim($staticpage_containt)),
                'metaTitle' => addslashes(trim($meta_title)),
                'keyWords' => addslashes(trim($key_words)),
                'description' => addslashes(trim($description)),
                'isDeleted' => '0',
                'status' => '1',
                'addDate' => $date
            );
            $this->db->where('id', $post['id']);
            $this->db->update(TBL_STATICPAGECONTAINT, $data);
            $this->session->set_flashdata('success', 'Static Page has been updated successfully.');
            redirect(base_url() . "index.php/managepagecontaint/edit/" . $pageId . "/" . $post['id']);
            return true;
        }
    }

    /*     * *************function to delete, change stautus of multiple page contents ************* */

    public function multyAction($post) {
        $pageId = $this->uri->segment(3, 0);
        if (($post[action] == '')) {
            $this->session->set_flashdata('errordata', 'First select the action, and then enter submit !');
            redirect(base_url() . "index.php/managepagecontaint/index/" . $pageId);
            return true;
        }
        if ($post[action] == 'deleteselected') {
            $delres = $post[chk];
            $numrec = count($delres);
            if ($numrec > 0) {
                foreach ($delres as $key => $val) {
                    $this->db->where('id', $val);
                    $postarray = array(
                        'isDeleted' => '1',
                        'modDate' => date('Y-m-d H:i:s')
                    );
                    $this->db->update(TBL_STATICPAGECONTAINT, $postarray);
                }
                $this->session->set_flashdata('success', 'Your all selected information has been deleted successfully.');
            } else {
                $this->session->set_flashdata('errordata', 'First select record, and then enter submit for delete records!');
            }
        }
        if ($post[action] == 'enableall') {
            $delres = $post[chk];
            $numrec = count($delres);
            if ($numrec > 0) {
                foreach ($delres as $key => $val) {
                    $this->db->where('id', $val);
                    $postarray = array(
                        'status' => '1',
                        'modDate' => date('Y-m-d H:i:s')
                    );
                    $this->db->update(TBL_STATICPAGECONTAINT, $postarray);
                }
                $this->session->set_flashdata('success', 'Your all selected information has been enabled successfully.');
            } else {
                $this->session->set_flashdata('errordata', 'First select record, and then enter submit for enable records!');
            }
        }
        if ($post[action] == 'disableall') {
            $delres = $post[chk];
            $numrec = count($delres);
            if ($numrec > 0) {
                foreach ($delres as $key => $val) {
                    $this->db->where('id', $val);
                    $postarray = array(
                        'status' => '0',
                        'modDate' => date('Y-m-d H:i:s')
                    );
                    $this->db->update(TBL_STATICPAGECONTAINT, $postarray);
                }
                $this->session->set_flashdata('success', 'Your all selected information has been disabled successfully.');
            } else {
                $this->session->set_flashdata('errordata', 'First select record, and then enter submit for disable records!');
            }
        }
        redirect(base_url() . "index.php/managepagecontaint/index/" . $pageId);
        return true;
    }

    /*     * *************function to restore all deleted page contents ************* */

    public function restoreAllRecord() {
        $postarray = array(
            'isDeleted' => '0',
            'modDate' => date('Y-m-d H:i:s')
        );
        $this->db->update(TBL_STATICPAGECONTAINT, $postarray);

        $this->session->set_flashdata('success', 'All data has been restored successfully.');
        return true;
    }

    /*     * *************function to delete all page content ************* */

    public function deleteAllRecord() {
        $postarray = array(
            'isDeleted' => '1',
            'modDate' => date('Y-m-d H:i:s')
        );
        $this->db->update(TBL_STATICPAGECONTAINT, $postarray);

        $this->session->set_flashdata('success', 'All data has been deleted successfully.');
        return true;
    }

    /*     * *************function to fetch single value from table ************* */

    function fetchValue($table, $field, $where) {
        $result = "";
        $this->db->select($field);
        $this->db->where($where);
        $query = $this->db->get($table);
        foreach ($query->result() as $value) {
            $result = $value->$field;
        }
        return $result;
    }

    /*     * *************function to get page ************* */

    public function getPage($get, $id = 0) {
        $this->db->select('*');
        $this->db->from(TBL_STATICPAGEDESC);
        $this->db->join(TBL_STATICPAGE, TBL_STATICPAGE . '.id = ' . TBL_STATICPAGEDESC . '.staticpagetypeId');
        $this->db->where(TBL_STATICPAGEDESC . ".langId", $get['langId']);
        $this->db->where(TBL_STATICPAGE . ".isDeleted", '0');
        $query = $this->db->get();
        $tbl .=' <select name="staticpagename" id="staticpagename" class="input-medium">';
        if ($query->num_rows() > 0) {
            $tbl .='<option value="">Please select page</option>';
            foreach ($query->result() as $value) {
                if ($id == $value->id) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                $tbl .='<option value="' . $value->id . '" ' . $sel . '>' . $value->staticPageName . '</option>';
            }
        } else {
            $tbl .='<option value="">Not any page found!</option>';
        }
        $tbl .='</select>';

        return $tbl;
    }

    /*     * *************function to get language ************* */

    public function getLanguage($id = 0) {
        $this->db->where('isDeleted', '0');
        $this->db->where('status', '1');
        $query = $this->db->get(TBL_LANGUAGE);
        if ($query->num_rows() > 0) {
            $tbl .='<option value="">Please select language</option>';
            foreach ($query->result() as $value) {
                if ($id == $value->id) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                $tbl .='<option value="' . $value->id . '" ' . $sel . '>' . stripslashes($value->languageName) . '</option>';
            }
        } else {
            $tbl .='<option value="">Not any language found!</option>';
        }

        return $tbl;
    }

}

?>