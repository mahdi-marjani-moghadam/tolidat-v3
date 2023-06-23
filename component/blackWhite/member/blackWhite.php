<?php
/**
 * Created by fadeInLeft
 * User: dabaCompany
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__) . '/model/blackWhite.controller.php';
global $admin_info,$PARAM;

$blackWhiteController = new black_whiteController();

if (isset($exportType))
{
    $blackWhiteController->exportType = $exportType;

}
if ($PARAM ['0'] == 'blackWhite' ) {
    switch ($PARAM ['1']) {
        case 'addblackWithe':
          /*  if (isset($_POST['action']) & $_POST['action'] == 'add') {
                $blackWhiteController->addblackWithe($_POST);
            } else {
                $blackWhiteController->showblackWhiteAddForm('', '');
            }
            break;*/

        case 'editblackWhite':
           /* checkPermissions('editblackWhite', 'blackWhite');
            if (isset($_POST['action']) & $_POST['action'] == 'edit') {
                $blackWhiteController->editblackWhite($_POST);
            } else {
                $input['blackWhite_id'] = $_GET['id'];
                $blackWhiteController->showblackWhiteEditForm($input, '');
            }*/
            break;

        case 'check':

            $blackWhiteController->checkPhone($PARAM ['2'], $PARAM ['3']);
            break;


        case 'deleteblackWhite':
            /*$input['blackWhite_id'] = $_GET['id'];
            $blackWhiteController->deleteblackWhite($input);*/

        default:
            /*$fields['order']['blackWhite_id'] = 'DESC';
            $blackWhiteController->showList($fields);*/
            break;
    }
}