<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__) . '/admin.invoice.model.php';
include_once ROOT_DIR . '/component/packageUsage/admin/model/admin.packageUsage.model.php';
include_once ROOT_DIR . 'component/company/member/model/member.company.controller.php';
include_once ROOT_DIR . 'component/package/member/model/package.model.php';

class adminInvoiceController
{

    public $exportType;

    public $fileName;


    public function __construct()
    {
        $this->exportType = 'html';
    }

    public function template($list = [], $msg = '')
    {

        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_start.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_header.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_rightMenu_admin.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_footer.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_end.php';
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

    public function showList()
    {
        $invoice = admininvoiceModel::getBy_status(3)->getList();
        $serialize = unserialize($invoice['export']['list']['0']['invoice_detail']);
        if ($invoice['export']['recordsCount'] > 0) {
            $export['list'] = $invoice['export']['list'];
            $export['list']['0']['price'] = $serialize['price'];
        }
        $export['recordsCount'] = $invoice['export']['recordsCount'];
        $this->fileName = 'admin.invoice.showList.php';
        $this->template($export);
        die();
    }

    public function showInvoiceEditForm($fields, $msg)
    {
        $invoice = adminInvoiceModel::find($fields['Invoice_id']);
        if (!is_object($invoice)) {
            $msg = 'صفحه مورد نظر یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=invoice', $msg);
        }
        $export = $invoice->fields;
        $this->fileName = 'admin.invoice.editForm.php';
        $this->template($export, $msg);
        die();
    }


    public function invoiceAssignAction($invoiceModel)
    {

        $invocie_detail = unserialize($invoiceModel->invoice_detail);

        $export['product'] = $invocie_detail['product'];
        $export['category'] = $invocie_detail['category'];
        $export['keyword'] = $invocie_detail['keyword'];
        $export['lang'] = $invocie_detail['lang'];
        $export['branch'] = $invocie_detail['branch'];
        $export['representation'] = $invocie_detail['representation'];
        $export['package_id'] = $invoiceModel->package_id;
        $export['invoice_id'] = $invoiceModel->Invoice_id;
        $export['company_id'] = $invoiceModel->company_id;
        $export['start_date'] = $invoiceModel->startdate;
        $export['expiredate'] = $invoiceModel->expiredate;
        $packageUsage = new adminpackageUsageModel();
        $packageUsage->setFields($export);
        $result = $packageUsage->save();
        if ($result['result'] == -1) {
            $result['$msg'] = 'اطلاعات ذخیره نشد';
            return $result;
        }
        $invoiceModel->status = 5;
        $result = $invoiceModel->save();

        if ($result['result'] == -1) {
            $result['$msg'] = 'تایید نشد';
            return $result;

        }
        $company = new memberCompanyController();
        $result = $company->setRefreshDate($export['company_id']);

        if ($result['result'] == -1) {
            $result['$msg'] = 'تایید نشد';
            return $result;
        }
        $result['$msg'] = 'عملیات با موفقیت انجام شد';
        return $result;

    }

    public function invoiceAssign($invoiceModel)
    {
        $result = $this->invoiceAssignAction($invoiceModel);
        $msg = [$result['msg']];
        redirectPage(RELA_DIR . 'admin/index.php?component=invoice', $msg);

    }


    public function invoiceAssignForm($input)
    {

        $invoiceModel = admininvoiceModel::find($input['Invoice_id']);

        if (!is_object($invoiceModel)) {
            print_r_debug('یافت نشد');
        }
        $this->invoiceAssign($invoiceModel);
    }

    public function editInvoice($fields)
    {
        $Invoice = adminInvoiceModel::find($fields['Invoice_id']);
        $Invoice->setFields($fields);
        $Invoice->save();

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=invoice', $msg);
        die();
    }

    public function showInvoiceErrorForm()
    {
        $status = [0];
        $invoice = admininvoiceModel::getComoanyInfo($status['0']);
        $export['list'] = $invoice['export']['list'];
        $export['recordsCount'] = $invoice['export']['recordsCount'];
        for ($x = 0; $x < $export['recordsCount']; $x++) {
            $export['package'][$x] = unserialize($invoice['export']['list'][$x]['invoice_detail']);
            $export['list'][$x]['price'] = $export['package'][$x]['price'];
            $export['list'][$x]['packagetype'] = $export['package'][$x]['packagetype'];
        }
        $this->fileName = 'admin.invoice.showListError.php';
        $this->template($export);
        die();
    }


    public function showInvoiceSuccessForm()
    {
        $status = ['5'];
        $invoices = adminInvoiceModel::getComoanyInfo($status['0']);
        $export['list'] = $invoices['export']['list'];
        $export['recordsCount'] = $invoices['export']['recordsCount'];
        for ($x = 0; $x < $export['recordsCount']; $x++) {
            $export['package'][$x] = unserialize($invoices['export']['list'][$x]['invoice_detail']);
            $export['list'][$x]['price'] = $export['package'][$x]['price'];
            $export['list'][$x]['packagetype'] = $export['package'][$x]['packagetype'];
            $export['list'][$x]['date'] = $export['package'][$x]['date'];
        }
        $this->fileName = 'admin.invoice.showListSuccess.php';
        $this->template($export);
        die();
    }

    public function deleteAllInvoiceByCompanyId($company_id)
    {
        //delete from main table
        $invoices = adminInvoiceModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($invoices['export']['recordsCount'] > 0) {
            foreach ($invoices['export']['list'] as $invoice) {
                $invoice->delete();
            }
        }
        return;
    }
}
