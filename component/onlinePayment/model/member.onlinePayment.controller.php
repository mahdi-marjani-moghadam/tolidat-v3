<?php

include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/onlinePayment/model/member.onlinePayment.model.php';
include_once ROOT_DIR . 'component/invoice/InvoiceController.php';
include_once ROOT_DIR . 'component/invoice/member/model/invoice.model.php';
include_once ROOT_DIR . 'component/invoice/admin/model/admin.invoice.controller.php';
include_once ROOT_DIR . 'component/packageUsage/member/model/member.packageUsage.model.php';
include_once ROOT_DIR . 'component/discountCode/model/DiscountCode.php';
include_once ROOT_DIR . 'component/company/member/model/member.company.model.php';
include_once ROOT_DIR . 'component/login/model/login.model.php';


class onlinePaymentController
{

    public $exportType;
    public $fileName;
    private $company_info;

    public $errorVerify = array(
        '-1' => 'خطای داخلی شبکه',
        '-2' => 'سپرده ها برابر نیستند',
        '-3' => 'ورودی ها حاوی کاراکترهای غیر مجاز میباشد',
        '-4' => 'کلمه عبور یا کد فروشنده اشتباه است',
        '-5' => 'خطای بانک اطلاعاتی',
        '-6' => 'سند قبلا برگشت کامل خورده',
        '-7' => 'رسید دیجیتالی تهی است',
        '-8' => 'طول ورودی ها بیشتر از حد مجاز است',
        '-9' => 'وجود کارکترهای غیر مجاز در مبلغ برگشتی',
        '-10' => 'رسید دیجیتالی حاوی کارکترهای غیر مجاز است',
        '-11' => 'طول ورودی ها کمتر از حد مجاز است',
        '-12' => 'مبلغ برگشتی منفی است',
        '-13' => 'مبلغ برگشتی برای برگشت جزیی بیش از مبلغ برگشت نخورده رسید دیجیتالی است',
        '-14' => 'چنین تراکنشی تعریف نشده است',
        '-15' => 'مبلغ برگشتی به صورت اعشاری داده شده',
        '-16' => 'خطای داخلی سیستم',
        '-17' => 'برگشت زدن تراکنشی که با کارت بانکی غیر از بانک سامان انجام شده',
        '-18' => 'فروشنده نامعتبر است ip address'
    );

    public $msg = [
        'successInvoice' => "کاربر گرامی
همانگونه که مستحضرید مدارک ارائه شده شما، توسط همکاران تولیدات بررسی و اعتبارسنجی می گردد. لذا خواهشمند است  تا زمان تایید مدارک خود تامل فرمایید.
با تشکر تولیدات",

        'success' => "کاربر گرامی فاکتور شما پرداخت شد اما عملیاتی با مشکل مواجه شده است این موضوع را به اپراتورهای تولیدات در میان گذاشته تا بسته شما فعال شود."
    ];
    
    private $_merchantID;
    private $_merchantPass;
    private $_initpayment;
    private $_payment;
    private $_referencepayment;

    public function __construct()
    {
        global $company_info;
        $this->company_info = $company_info;
        $this->exportType = 'html';
        if (RELA_DIR == 'https://tolidat.ir') {
            $this->_merchantID = '13723922'; // main 
            $this->_merchantPass = '7151545';
            // $this->_initpayment = 'https://Payments/InitPayment.asmx?WSDL';
            $this->_initpayment = 'https://sep.shaparak.ir/Payments/InitPayment.asmx';
            $this->_payment = 'https://sep.shaparak.ir/Payment.aspx';
            $this->_referencepayment = 'https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL';
        } else {
            $this->_merchantID = 'TS9sdvlX-gtlhtZ'; // test 
            $this->_merchantPass = 'user134753457';
            $this->_initpayment = 'https://sandbox.banktest.ir/saman/sep.shaparak.ir/payments/initpayment.asmx?wsdl';
            $this->_payment = 'https://sandbox.banktest.ir/saman/sep.shaparak.ir/payment.aspx';
            $this->_referencepayment = 'https://sandbox.banktest.ir/saman/sep.shaparak.ir/payments/referencepayment.asmx?wsdl';
        }
    }

    public function getToken($onlinePayment)
    {
        // $merchantID = "10370175"; // main
        $merchantID = $this->_merchantID; // test
        // $merchantPass = "5128755"; // main
        $merchantPass = $this->_merchantPass; // test
        $context = stream_context_create([
            'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        try {

            // $soapClient = new SoapClient('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL', array('stream_context' => $context));
            $soapClient = new SoapClient($this->_initpayment, array('stream_context' => $context));

            $tokenResult = $soapClient->RequestToken("$merchantID", $onlinePayment->Online_payment_id, $onlinePayment->price);

            if (in_array($tokenResult, array_keys($this->errorVerify))) {
                $result['msg'] = $this->errorVerify[$tokenResult];
                $result['result'] = -1;
                $result['no'] = $tokenResult;
                return $result;
            }

            $result['result'] = 1;
            $result['token'] = $tokenResult;
        } catch (Exception $e) {
            $result['result'] = -1;
            // $result['msg'] =  'Caught exception: '.  $e->getMessage(). "\n";
            $result['msg'] =  'ارتباط با بانک برقرار نشد' . $e->getMessage();
        }
        
        return $result;
    }

    public function verifyTrans($onlinePayment)
    {
        // $merchantID = "10370175";
        $merchantID = $this->_merchantID;
        $context = $this->getContext();
        try{
            
            // $soapClient = new SoapClient('https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL', array('stream_context' => $context));
            $soapClient = new SoapClient($this->_referencepayment, array('stream_context' => $context));
            $result = false;
            
            for ($a = 1; $a < 6; ++$a) {
                $result = $soapClient->verifyTransaction($onlinePayment->RefNum, $merchantID);
                if ($result != false) {
                    break;
                }
            }
        }catch(Exception $e){
            return dd($e->getMessage());
        }

       

        return $result;
    }

    public function reverseTrans($onlinePayment)
    {
        // $merchantID = "10370175";
        $merchantID = $this->_merchantID;
        // $merchantPass = "5128755";
        $merchantPass = $this->_merchantPass;
        $context = $this->getContext();
        // $soapClient = new SoapClient('https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL', array('stream_context' => $context));
        $soapClient = new SoapClient($this->_referencepayment, array('stream_context' => $context));

        $result = false;
        for ($a = 1; $a < 6; ++$a) {
            $result = $soapClient->reverseTransaction($onlinePayment->RefNum, $merchantID, $onlinePayment->MID, $merchantPass);
            if ($result != false) {
                break;
            }
        }

        return $result;
    }

    public function getContext()
    {
        return stream_context_create([
            'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
    }

    public function checkVerify($verify, $price)
    {
        if ($verify != $price) {
            $result['msg'] = 'پرداخت با مشکل مواجه شد.';
            $result['result'] = -1;
            return $result;
        }

        $result['result'] = 1;
        return $result;
    }

    public function checkReverse($reverse, $price)
    {
        if ($reverse != $price) {
            $result['msg'] = 'ُپرداخت با مشکل مواجه شد، مبلغ به حساب شما برگشت داده می شود.';
            $result['result'] = -1;
            return $result;
        }

        $result['result'] = 1;
        return $result;
    }

    public function returnBank($fields)
    {
        
        $result = $this->checkReturnResult($fields);
        $invoice = $result['invoice'];

        if ($result['result'] == 1) {
            $user = $this->getUser($invoice->company_id);
            $msg =
                "سلام به مرجع اطلاعات تولیدات خوش آمدید.
با تشکر از حضور شما در تولیدات
لطفا در انتظار تایید ثبت نام بمانید.
www.tolidat.ir";

            if (is_object($user)) {
                sendSMS($user->mobile, $msg);
            }
        }

        // redirect to invoice public side
        if ($result['result'] == -1 & $invoice->type == 1) {
            redirectPage(RELA_DIR . "invoice/show/" . $invoice->Invoice_id);
        }

        if ($result['result'] == 1 & $invoice->type == 1) {
            $companyModel = new company();
            $companyModel->updatePackageStatus($this->company_info['company_id']);
            redirectPage(RELA_DIR . "profile");
        }

        // redirect to invoice member side
        if ($result['result'] == 1 & $invoice->type == 2) {
            $packageUsage = new packageusage();
            $packageUsage->updatePackageUsageWithNewPackage($invoice);
            redirectPage(RELA_DIR . "member/invoice/show/" . $invoice->Invoice_id);
        }

        if ($result['result'] == -1 & $invoice->type == 2) {
            redirectPage(RELA_DIR . "member/invoice/show/" . $invoice->Invoice_id);
        }


        if ($result['result'] == -1) {
            redirectPage(RELA_DIR . "member/invoice/show/" . $invoice->Invoice_id, $result['msg'], true);
        }
    }

    public function checkReturnResult($fields)
    {
        $onlinePayment = self::getOnlinePaymentById($fields['ResNum']);
        
        $invoice = invoice::find($onlinePayment->invoice_id);
        $result['invoice'] = $invoice;
        
        if (!is_object($onlinePayment) || !is_object($invoice)) {
            $result['msg'] = 'فاکتوری با این شماره وجود ندارد';
            $result['result'] = -1;
            return $result;
        }

        if ($fields['StateCode'] == -1) {
            $result['msg'] = 'پرداخت توسط شما لغو شد';
            $result['result'] = -1;
            return $result;
        }

        if ($fields['State'] != 'OK') {
            $result['msg'] = 'پرداخت با مشکل مواجه شد';
            $result['result'] = -1;
            return $result;
        }

        $fields['status'] = 1;
        
        $this->updateOnlinePayment($onlinePayment, $fields);
        if ($invoice->discount_code_id != 0) {
            $discountCode = DiscountCode::find($invoice->discount_code_id);
        }
        
        if (is_object($discountCode)) {
            $discount = DiscountCode::checkCode($invoice, $discountCode->code);
        }
        
        if (is_object($discount)) {
            $discount->disableDiscountCode($invoice->Discount_code_id);
        }
        
        if (!is_object($discount) & $invoice->discount_code_id != 0) {
            // Money return to user
            
            $reverse = $this->reverseTrans($onlinePayment);
            $res = $this->checkReverse($reverse, $onlinePayment->price);
        } else {
            // Deduct money from user
            
            $verify = $this->verifyTrans($onlinePayment);
            $res = $this->checkVerify($verify, $onlinePayment->price);
        }
        
        if ($res['result'] == -1) {
            $result['result'] = $res['result'];
            return $result;
        }

        $input['status'] = 5;
        $this->updateOnlinePayment($onlinePayment, $input);
        $invoice->payment();

        $result['msg'] = $this->msg['successInvoice'];
        $result['result'] = 1;
        return $result;
    }

    public function onlinepayment($invoice)
    {
        $onlinePayment = new memberonlinepaymentModel();

        // add before send to bank for get token
        $onlinePayment->addInvoiceToOnlinePayment($invoice);

        // token
        $resultToken = $this->getToken($onlinePayment);

        if ($resultToken['result'] == -1) {
            redirectPage(RELA_DIR . "profile", $resultToken['msg'], true);
            die();
        }

        // update online token
        $onlinePayment->updateTokenOnlinePayment($resultToken['token']);

        $bank_payment = $this->_payment;

        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/payment_online_addForm.php");
        die();
    }

    public static function getOnlinePaymentById($id)
    {
        $onlinePayment = memberonlinepaymentModel::find($id);
        if (is_object($onlinePayment)) {

            return $onlinePayment;
        }

        return false;
    }

    public function updateOnlinePayment($onlinePayment, $fields)
    {
        $onlinePayment->setFields($fields);
        return $onlinePayment->save();
    }

    public function getUser($company_id)
    {
        $user = members::getAll()
            ->where('company_id', '=', $company_id)
            ->first();

        return $user;
    }
}
