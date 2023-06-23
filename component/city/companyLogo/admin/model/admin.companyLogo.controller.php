<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__)."/admin.companyLogo.model.php");

/**
 * Class registerController
 */
class admincompany_logoController
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
    function template($list=[], $msg = '')
    {
        global $messageStack;
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
    public function addCompanyLogo($fields,$files)
    {

        $companyLogo=admincompanyModel::find($fields['company_id']);
        if(is_object($companyLogo)){
                if($fields['remove_image']=='on'){
                    fileRemover(COMPANY_ADDRESS_ROOT.$fields['company_id']."/logo/",$companyLogo->logo );
                }else{
                    if ($files['name'] != ''){
                        $Property = array('type' => 'jpg,png,jpeg',
                            'new_name' => $files['name'],
                            'max_size' => '2048000',
                            'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/",
                            'height' => '',
                            'wight' => '',
                            'error_msg' => '',
                            'success_msg' => '',
                        );

                        fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/", $companyLogo->fields['logo']);
                        $result_uploader = fileUploader($Property, $files);
                        $companyLogo->logo=$result_uploader['image_name'];
                        $companyLogo->save();
                    } else {
                        $field['image'] = $companyLogo->fields['logo'];
                        $companyLogo->logo=$companyLogo->fields['logo'];
                        //$companyLogo->setFields($field);
                        $companyLogo->save();
                        $msg = 'عملیات با موفقیت انجام شد';
                    }
                }
        }else{
            $msg = 'عملیات با موفقیت انجام نشد';
        }
        redirectPage(RELA_DIR.'admin/index.php?component=companyLogo&id='. $fields['company_id'], $msg);
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

    public function showCompanyLogoAddForm($fields,$msg)
    {
        print_r_debug($fields);
        $this->fileName = 'admin.companyLogo.addForm.php';
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
    public function editCompanyLogo($fields,$files)
    {
        
        $companyLogo=admincompany_logoModel::find($fields['logo_id']);
        if($fields['remove_image']=='on'){
            fileRemover(COMPANY_ADDRESS_ROOT.$fields['company_id']."/LOGO/",$companyLogo->image );

        }
        else{
            if($files['name'] != ''){
                $Property= array('type' =>'jpg,png',
                    'new_name' =>$files['name'],
                    'max_size' =>'2048000',
                    'upload_dir' =>COMPANY_ADDRESS_ROOT.$fields['company_id']."/logo/",
                    'height' =>'',
                    'wight' =>'',
                    'error_msg' =>'',
                    'success_msg' =>'',
                );
            }

            $result_uploader=fileUploader($Property,$files);
            $field['image'] = $result_uploader['image_name'];
            $field['title'] = $fields['title'];
            $field['description'] = $fields['description'];
            $field['company_id'] = $fields['company_id'];
            $result = $companyLogo->setFields($field);
            $companyLogo->save();
        }

        $companyLogo->setFields($fields);
        $companyLogo->save();
        $msg = 'عملیات با موفقیت انجام شد';
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR.'admin/index.php?component=companyLogo&id='. $fields['company_id'], $msg);
        die();
    }


    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showCompanyLogoEditForm($fields,$msg)
    {
        $companyLogo=admincompany_logoModel::find($fields['logo_id']);
        $export = $companyLogo->fields;
        $this->fileName = 'admin.companyLogo.editForm.php';
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
      
        $categoryBanner = new admincategory_bannerModel();
        $result =$categoryBanner->getByFilter();



        $export['list'] = $result['export']['list'];
        $export['recordsCount'] =  $result['export']['recordsCount'];
        $export['company_id'] = $fields['choose']['company_id'];
        $this->fileName = 'admin.companyLogo.showList.php';

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
    public function deleteCompanyLogo($fields)
    {
        $companyLogo=admincompany_logoModel::find($fields);
        if(is_object($companyLogo)) {
            $logoID = admincompany_logoModel::getBy_logo_id($fields)->getlist();
            fileRemover(COMPANY_ADDRESS_ROOT . $logoID['export']['list']['0']['company_id'] . "/companyNews/", $logoID['export']['list']['0']['image']);
            $result = $companyLogo->delete();
            if ($result['result'] != '1') {
                $this->showCompanyLogoEditForm($fields, $result['msg']);
            }
            $msg = 'عملیات با موفقیت انجام شد';
            redirectPage(RELA_DIR . 'admin/index.php?component=companyLogo&id=' . $logoID['export']['list']['0']['company_id'], $msg);
            die();
        }else{
            $msg = 'عملیات با موفقیت انجام نشد';
            calculateScoreCompany($fields['company_id']);
            redirectPage(RELA_DIR . 'admin/index.php?component=companyLogo', $msg);
            die();
        }
    }

}
?>
