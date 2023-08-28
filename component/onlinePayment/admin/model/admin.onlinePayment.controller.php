<?php

/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once ROOT_DIR . 'component/onlinePayment/model/member.onlinePayment.model.php';
include_once ROOT_DIR . '/component/packageUsage/admin/model/admin.packageUsage.model.php';


class adminOnlinePaymentController
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

    public function invoiceAssign($invoiceModel)
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
        $export['start_date'] = strftime('%Y-%m-%d %H:%M:%S', time());

     
        // todo: expiredate package
        $package = Package::find($invoiceModel->package_id);
        $export['expiredate'] = date('Y-m-d', strtotime("+{$package->period} months", strtotime(substr($export['start_date'], 0, 10))));

        $packageUsage = new adminpackageUsageModel();
        $packageUsage->setFields($export);
        $result = $packageUsage->save();
        if ($result['result'] == -1) {
            $msg = 'اطلاعات ذخیره نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=invoice', $msg);
        }
        $invoiceModel->status = 5;
        $result = $invoiceModel->save();
        if ($result['result'] == -1) {
            $msg = 'تایید نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=invoice', $msg);
        }
        $company = admincompanyModel::getBy_Company_id($export['company_id'])->first();
        $company->package_status = 4;
        $company->sava();
    }

    public function invoiceAssignForm($input)
    {

        $invoiceModel = adminonline_paymentModel::find($input);

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
        $status = [3, 5];
        $invoice = admininvoiceModel::getBy_not_status($status)->getList();
        $export['list'] = $invoice['export']['list'];
        $export['recordsCount'] = $invoice['export']['recordsCount'];
        for ($x = 0; $x < $export['recordsCount']; $x++) {
            $export['package'][$x] = unserialize($invoice['export']['list'][$x]['invoice_detail']);
            $export['list'][$x]['price'] = $export['package'][$x]['price'];
        }
        $this->fileName = 'admin.invoice.showListError.php';
        $this->template($export);
        die();
    }

    public function showInvoiceSuccessForm()
    {
        $invoice = admininvoiceModel::getBy_status(5)->getList();
        $export['list'] = $invoice['export']['list'];
        $export['recordsCount'] = $invoice['export']['recordsCount'];
        for ($x = 0; $x < $export['recordsCount']; $x++) {
            $export['package'][$x] = unserialize($invoice['export']['list'][$x]['invoice_detail']);
            $export['list'][$x]['price'] = $export['package'][$x]['price'];
        }
        $this->fileName = 'admin.invoice.showListSuccess.php';
        $this->template($export);
        die();
    }

    public function showAllPay()
    {
        $export['status'] = 'showAll';
        $this->fileName = 'admin.companyOnlinePayment.showList.php';
        $this->template($export);
        die();
    }

    public function searchAllPay($fields)
    {
        $i = 0;
        $columns = [
            ['db' => 'Online_payment_id', 'dt' => $i++],
            ['db' => 'company_name', 'dt' => $i++],
            ['db' => 'invoice_id', 'dt' => $i++],
            ['db' => 'price', 'dt' => $i++],
            ['db' => 'RefNum', 'dt' => $i++],
            ['db' => 'TRACENO', 'dt' => $i++],
            ['db' => 'SecurePan', 'dt' => $i++],
            ['db' => 'status', 'dt' => $i++],
            ['db' => 'date', 'dt' => $i],
        ];

        include_once ROOT_DIR . "model/datatable.converter.php";
        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();

        $payment = $this->getOnlinePayment($searchFields);

        $list['list'] = $payment['payment']['export']['list'];
        $list['paging'] = $payment['totalRecord'];

        $other['7'] = array('formatter' => function ($list) {
            if ($list['status'] == '5') {
                $st = '<i class="fa fa-check-circle" style="font-size: x-large"></i>';
            } else if ($list['status'] == '0') {
                $st = '<i class="fa fa-times-circle" style="font-size: x-large"></i>';
            } else {
                $st = '';
            }

            return $st;
        });

        $other['8'] = array('formatter' => function ($list) {
            $st = $list['date'] ? convertDate($list['date']) : '0000/00/00';
            return $st;
        });

        $internalVariable['showstatus'] = $fields['status'];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function getOnlinePayment($searchFields)
    {
        $logs = memberonlinepaymentModel::getAll()
            ->select('online_payment.*', 'invoice.date', 'company.company_name')
            ->leftJoin('invoice', 'invoice.Invoice_id', '=', 'online_payment.invoice_id')
            ->leftJoin('company', 'company.Company_id', '=', 'online_payment.company_id');


        if (isset($searchFields['filter'])) {
            foreach ($searchFields['filter'] as $filter => $value) {
                if ($filter == 'date') {
                    $logs->where('invoice.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'company_name') {
                    $logs->where('company.' . $filter, 'like', '%' . $value . '%');
                } else {
                    $logs->where('online_payment.' . $filter, 'like', '%' . convertToEnglish($value) . '%');
                }
            }
        }

        $objClone = clone $logs;
        $objClone->limit(200);
        $totalRecord = $objClone->getList()['export']['recordsCount'];

        if (isset($searchFields['order'])) {
            foreach ($searchFields['order'] as $filter => $value) {
                if ($filter == 'date') {
                    $logs->orderBy('invoice.' . $filter, $value);
                } else if ($filter == 'company_name' | $filter == 'company_id') {
                    $logs->orderBy('company.' . $filter, $value);
                } else {
                    $logs->orderBy('online_payment.' . $filter, $value);
                }
            }
        } else {
            $logs->orderBy('online_payment.Online_payment_id', 'DESC');
        }

        $logs->limit($searchFields['limit']['start'], $searchFields['limit']['length']);
        //        $c = $logs->getList(); dd($logs);

        $result['payment'] = $logs->getList();
        $result['totalRecord'] = $totalRecord;
        return $result;
    }
}
