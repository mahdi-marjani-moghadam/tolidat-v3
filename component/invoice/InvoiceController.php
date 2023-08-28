<?php
include_once ROOT_DIR . 'component/invoice/model/Invoice.php';
include_once ROOT_DIR . 'component/package/member/model/package.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/onlinePayment/model/member.onlinePayment.controller.php';
include_once ROOT_DIR . 'component/discountCode/model/DiscountCode.php';
include_once ROOT_DIR . 'component/company/member/model/member.company.model.php';
include_once ROOT_DIR . 'component/login/model/login.model.php';


class InvoiceController
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
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
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
     * @param $fields
     * @param $msg
     */
    public function showDetail($fields, $msg='')
    {
        $package = unserialize($fields['invoice_detail']);
        $export = $fields;
        $export['packagetype'] = $package['packagetype'];
        $export['package_class'] = package::getPackageClass($package['packagetype']);
        $export['period'] = $package['period'];
        $export['show_profile_menu'] = 1;
        $this->fileName = 'invoice.showList.php';
        $this->template($export, $msg);
        die();
    }

    /**
     * @param $company_id
     * @return mixed
     */
    public function getInvoice($company_id)
    {
        return invoice::getAll()
            ->where('company_id', '=', $company_id)
            ->where('type', '=', 1)
            ->first();
    }

    /**
     * @param $invoice_id
     */
    public function edit()
    {
        redirectPage(RELA_DIR . 'member/package');
    }

    /**
     * @param $package_id
     */
    public function add($package_id)
    {
        $package = package::find($package_id);

        if (!is_object($package)) {
            $result['msg'] = 'این پکیج موجود نیست';
            redirectPage(RELA_DIR . 'invoice', $result['msg']);
        }

        $invoiceModel = new Invoice();
        $invoice = $invoiceModel->invoiceExist($this->company_info['company_id']);
        if (is_object($invoice)) {
            $invoice->delete();
        }

        $invoice = $invoiceModel->exportation($package, $package->price, $this->company_info['company_id'], 1);

        if (!is_object($invoice)) {
            $msg = 'صدور فاکتور با مشکل مواجه شد لطفا دوباره امتحان بفرمایید';
            redirectPage(RELA_DIR . 'invoice', $msg);
        }

        $this->showDetail($invoice->fields);
    }

    /**
     *
     */
    public function showInvoice($invoice_id)
    {
        $invoice = invoice::find($invoice_id);
        if (!is_object($invoice) | $invoice->status == 5 | $invoice->company_id != $this->company_info['company_id']) {
            redirectPage(RELA_DIR . "404");
        }

        $package = unserialize($invoice->invoice_detail);
        $export = $invoice->fields;
        $export['packagetype'] = $package['packagetype'];
        $export['package_class'] = package::getPackageClass($package['packagetype']);
        $export['period'] = $package['period'];
        $this->fileName = 'invoice.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $resNum
     * @param $msg
     */
    public function showInvoiceAgain($resNum, $msg)
    {
        $onlinePayment = onlinePaymentController::getOnlinePaymentById($resNum);
        $invoiceModel = new invoice();
        $result = $invoiceModel->getInvoice($onlinePayment->invoice_id);
        $export = $result['export']['list']['0'];
        $export['package_class'] = package::getPackageClass($export['packagetype']);

        $this->fileName = 'invoice.showList.php';
        $this->template($export, $msg);
        die();
    }

    public function payment($invoice_id)
    {
        $invoiceModel = new invoice();
        $discountCodeModel = new DiscountCode();
        $companyModel = new company();
        $oninePayment = new onlinePaymentController();
        
        $invoice = $invoiceModel->checkInvoice($invoice_id, $this->company_info['company_id']);
        
        if (!is_object($invoice)) {
            redirectPage(RELA_DIR . "profile", "فاکتوری با این مشخصات وجود ندارد");
        }
        if ($invoice->total_price == 0) {
            $invoice->payment();
            $discountCodeModel->disableDiscountCode($invoice->discount_code_id);
            $companyModel->updatePackageStatus($this->company_info['company_id']);
            $user = $this->getUser($invoice->company_id);
            $msg =
"سلام به مرجع اطلاعات تولیدات خوش آمدید.
با تشکر از حضور شما در تولیدات
لطفا در انتظار تایید ثبت نام بمانید.
www.tolidat.ir";

            if (is_object($user)) {
                sendSMS($user->mobile, $msg);
            }

            redirectPage(RELA_DIR . "profile");
        }

        $oninePayment->onlinepayment($invoice);
    }

    public function getUser($company_id)
    {
        $user = members::getAll()
            ->where('company_id', '=', $company_id)
            ->first();

        return $user;
    }
}
