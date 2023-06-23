<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__)."/admin.companyBanner.model.php");

/**
 * Class registerController
 */
class admincompany_bannerController
{

    /**
     * Contains file type
     * @var
     */
    public $exportType;

    /**
     * Contains file name
     * @var
     */
    public $fileName;

    /**
     * registerController constructor.
     */
    public function __construct()
    {


//        $history=admincompany_historyModel::find(4);
//        echo '<br/>********************<br/>';
//       //print_r($history);
//        //$history->title='ee';
//        $history->save();
//       // print_r_debug($history);
//
//
//        //company_history::create($fields);
//        /*$history = new company_history();
//        $history->title='aa';
//        $history->description='bbb';
//        $history->save();*/
//
//        $attributes = array('title' => 'My first blog post!!', 'description' => '5');
//        $company_history=admincompany_historyModel::create($attributes);
//        print_r_debug($company_history);
//
//
//        print_r_debug($history);
//
//        $result =$history->setFields($fields);
//        print_r_debug($history);


        $this->exportType='html';

    }

    /**
     * call template
     *
     * @param string $list
     * @param $msg
     * @return string
     */
    function template($list=[], $msg)
    {
        global $messageStack,$admin_info;

        switch($this->exportType)
        {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
                break;

            case 'json':
                echo json_encode($list);
                break;

            case 'array':
                return $list;
                break;

            case 'serialize':
                 echo serialize($list);
                break;

            default:
                break;
        }

    }

    /**
     * add honour
     *
     * @param $_input
     * @return int|mixed
     * @author marjani
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addCompanyBanner($fields,$files)
    {

            $field['title'] = $fields['title'];
            $field['description'] = $fields['description'];
            $field['company_id'] = $fields['company_id'];

            if($files['name'] != ''){
                $file['name']=$files['name'];
                $file['type']=$files['type'];
                $file['tmp_name']=$files['tmp_name'];
                $file['error']=$files['error'];
                $file['size']=$files['size'];

                $Property= array('type' =>'jpg,png',
                    'new_name' =>$files['name'],
                    'max_size' =>'500000000',
                    'upload_dir' =>COMPANY_ADDRESS_ROOT.$fields['company_id']."/banner/",
                    'height' =>'',
                    'wight' =>'',
                    'error_msg' =>'',
                    'success_msg' =>'',
                );

            }

           $result_uploader=fileUploader($Property,$file);
           $field['image'] = $result_uploader['image_name'];
           $companyBanner = new admincompany_bannerModel();
           $result = $companyBanner->setFields($field);
           $companyBanner->save();





        if ($result['result'] == -1) {
            return $result;
        }

        if ($result['result'] != '1') {
            $this->showCompanyBannerAddForm($fields, $result['msg']);
        }

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=companyBanner&id='. $fields['company_id'], $msg);
        die();


    }


    /**
     * call register form
     *
     * @param $fields
     * @param $msg
     * @return mixed
     * @author malekloo
     * @date 14/03/2016
     * @version 01.01.01
     */

    public function showCompanyBannerAddForm($fields,$msg)
    {

        $this->fileName = 'admin.companyBanner.addForm.php';
        $this->template($fields, $msg);
        die();
    }


    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editCompanyBanner($fields,$files)
    {

        $companyBanner=admincompany_bannerModel::find($fields['banner_id']);

        if(is_object($companyBanner)){
            if(trim( $fields['title']) !=''){
                $field['company_id'] =$fields['company_id'];
                $field['category_id'] =implode(',',$fields['category_id']) ;
                $field['title'] =$fields['title'];
                $field['brif_description'] =$fields['brif_description'];
                $field['description'] =$fields['description'];
                $field['companyBanner'] =$fields['companyBanner'];
                $field['priority'] =$fields['priority'];
                $field['image'] = '';
                if($fields['remove_image']=='on'){
                    fileRemover(COMPANY_ADDRESS_ROOT.$fields['company_id']."/banner/",$companyBanner->image );

                }else {
                    if ($files['name'] != '') {
                        $Property = array('type' => 'jpg,png,jpeg',
                            'new_name' => $files['name'],
                            'max_size' => '2048000',
                            'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/banner/",
                            'height' => '',
                            'wight' => '',
                            'error_msg' => '',
                            'success_msg' => '',
                        );
                        fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/banner/", $companyBanner->image);
                        $result_uploader = fileUploader($Property, $files);
                        $field['image'] = $result_uploader['image_name'];

                        $result = $companyBanner->setFields($field);
                        $companyBanner->save();
                    } else {
                        $field['image'] = $companyBanner->fields['image'];
                    }
                }
                $companyBanner->setFields($field);
                $companyBanner->save();
                $msg = 'عملیات با موفقیت انجام شد';
            }else{
                $msg = 'اطلاعات به درستی وارد نشده است';
            }
        }else{
            $msg = 'عملیات با موفقیت انجام نشد';
        }
        redirectPage(RELA_DIR.'admin/index.php?component=product&id='. $fields['company_id'], $msg);
        die();


    }


    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showCompanyBannerEditForm($fields,$msg)
    {

        $companyBanner=admincompany_bannerModel::find($fields['banner_id']);

        $export = $companyBanner->fields;
        $this->fileName = 'admin.companyBanner.editForm.php';
        $this->template($export, $msg);
        die();
    }



    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList($fields)
    {

        $companyBanner = new admincompany_bannerModel();
        $result =$companyBanner::getBy_company_id($fields['choose']['company_id'])->getList();

       // print_r_debug($result);
        if ($result['result'] != '1') {

            $this->fileName = 'admin.companyBanner.showList.php';
            $this->template('', $result['msg']);
            die();
        }

        $export['list'] = $result['export']['list'];
        $export['recordsCount'] =  $result['export']['recordsCount'];
        $export['company_id'] = $fields['choose']['company_id'];
        $this->fileName = 'admin.companyBanner.showList.php';

        $this->template($export);
        die();
    }
    /**
     * delete deleteCompany by company_id
     *
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteCompanyBanner($fields)
    {

        $companyBanner=admincompany_bannerModel::find($fields);
        if(is_object($companyBanner)) {
            $bannerID = admincompany_bannerModel::getBy_banner_id($fields)->getlist();
            fileRemover(COMPANY_ADDRESS_ROOT . $bannerID['export']['list']['0']['company_id'] . "/banner/", $bannerID['export']['list']['0']['image']);
            $result = $companyBanner->delete();
            if ($result['result'] != '1') {
                $this->showCompanyBannerEditForm($fields, $result['msg']);
            }
            $msg = 'عملیات با موفقیت انجام شد';
            redirectPage(RELA_DIR . 'admin/index.php?component=companyBanner&id=' . $bannerID['export']['list']['0']['company_id'], $msg);
            die();
        }else{
            $msg = 'عملیات با موفقیت انجام نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=companyBanner', $msg);
            die();
        }
    }

}
?>
