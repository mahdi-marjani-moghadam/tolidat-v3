<?php

include_once ROOT_DIR . 'component/invoice/model/Invoice.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/package/member/model/package.model.php';
include_once ROOT_DIR . 'component/discountCode/model/DiscountCode.php';
include_once ROOT_DIR . 'component/packageUsage/member/model/member.packageUsage.model.php';
include_once ROOT_DIR . 'component/onlinePayment/model/member.onlinePayment.controller.php';


class MemberInvoiceController
{

    /**
     * @var string
     */
    public $exportType;
    /**
     * @var
     */
    public $fileName;
    /**
     * @var int|mixed
     */
    private $company_info;


    /**
     * invoiceController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';

        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . '404');
        }
        $this->company_info = $company_info;
    }

    /**
     * @param array $list
     * @param $msg
     * @return array
     */
    public function template($list = [],$msg = '')
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.tail.inc.php';
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
     *
     */
    public function showInvoice($invoice_id)
    {

        $invoice = invoice::find($invoice_id);

        if (!is_object($invoice) | $invoice->company_id != $this->company_info['company_id']) {
            redirectPage(RELA_DIR . "404");
        }

        if ($invoice->status == 5) {
            redirectPage(RELA_DIR . "member/invoice/invoices");
        }

        $package = unserialize($invoice->invoice_detail);
        $export = $invoice->fields;
        $export['packagetype'] = $package['packagetype'];
        $export['package_class'] = package::getPackageClass($package['packagetype']);
        $packageUsage = packageusage::getAll()->where('company_id', '=', $this->company_info['company_id'])->getList();
        $export['startdate'] = $packageUsage['export']['list']['0']['start_date'];
        $export['expiredate'] = $packageUsage['export']['list']['0']['expiredate'];
        $export['show_profile_menu'] = 1;
        
        $this->fileName = 'member.invoice.show.php';
        $this->template($export);
        die();
    }

    /**
     * @param string $msg
     */
    public function showCompanyInvoices()
    {
        $invoices = invoice::getAll()->where('company_id', '=', $this->company_info['company_id'])->get();
        $packageUsage = packageusage::getAll()->where('company_id', '=', $this->company_info['company_id'])->first();
        

        foreach ($invoices['export']['list'] as $invoice) {
            $export['invoice'][$invoice->Invoice_id] = $invoice->fields;
            $export['invoice'][$invoice->Invoice_id]['package'] = unserialize($invoice->invoice_detail);
            if (is_object($packageUsage)) {
                $export['invoice'][$invoice->Invoice_id]['packageUsage'] = $packageUsage->fields;
                $export['invoice'][$invoice->Invoice_id]['start_date'] = $packageUsage->start_date;
                $export['invoice'][$invoice->Invoice_id]['expire_date'] = $packageUsage->expiredate;
                $export['active-package-upgarde'] = true;
            } else {
                $export['invoice'][$invoice->Invoice_id]['start_date'] = $invoice->date;
                $package = Package::find($invoice->package_id);
                
                $export['invoice'][$invoice->Invoice_id]['expire_date'] = date('Y-m-d', strtotime("+{$package->period} months", strtotime(substr($invoice->date, 0, 10))));
                $export['active-package-upgarde'] = false;
            }
        }
    //    dd($invoices);
        $this->fileName = 'member.invoice.showList.php';
        $this->template($export);
        die();
    }

    public function invoiceExportation($package_id)
    {
        $package = package::find($package_id);
        
        if (!is_object($package)) {
            $msg = 'این پکیج موجود نیست';
            redirectPage(RELA_DIR . 'member/package/upgrade', $msg);
        }

        if (!$package->validPackage($this->company_info['company_id'])) {
            $msg = 'شما قادر به انتخاب این پکیج نیستید';
            redirectPage(RELA_DIR . 'member/package/upgrade', $msg);
        }

        $invoiceModel = new Invoice();
        $invoice = $invoiceModel->invoiceExist($this->company_info['company_id']);
        if (is_object($invoice)) {
            $invoice->delete();
        }
        $price = $package->getPackagePrice($this->company_info['company_id']);
        $invoice = $invoiceModel->exportation($package, $price, $this->company_info['company_id'], 2);

        if (!is_object($invoice)) {
            $msg = 'صدور فاکتور با مشکل مواجه شد لطفا دوباره امتحان بفرمایید';
            redirectPage(RELA_DIR . 'member/package/upgrade', $msg);
        }

        redirectPage(RELA_DIR . "member/invoice/show/" . $invoice->Invoice_id);
    }

    public function payment($invoice_id)
    {
        $invoiceModel = new invoice();
        $discountCodeModel = new DiscountCode();
        $packageUsageModel = new packageusage();
        $oninePayment = new onlinePaymentController();

        $invoice = $invoiceModel->checkInvoice($invoice_id, $this->company_info['company_id']);
        if (!is_object($invoice)) {
            redirectPage(RELA_DIR . "profile", "فاکتوری با این مشخصات وجود ندارد");;
        }
        if ($invoice->total_price == 0) {
            $invoice->payment();
            $discountCodeModel->disableDiscountCode($invoice->discount_code_id);
            $package = package::find($invoice->package_id);
            $packageUsageModel->updatePackageUsageWithNewPackage($invoice);
            redirectPage(RELA_DIR . "member/invoice/invoices");
        }

        $oninePayment->onlinepayment($invoice);
    }
}
