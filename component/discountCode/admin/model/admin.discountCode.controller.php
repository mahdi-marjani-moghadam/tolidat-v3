<?php
require_once "admin.discountCode.model.php";
require_once ROOT_DIR . "component/company/member/model/member.company.model.php";
require_once ROOT_DIR . "component/package/member/model/package.model.php";

class adminDiscountCodeController
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
     * adminDiscountCodeController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @return array
     */
    public function template($list = [],$msg = '')
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

    /**
     *
     */
    public function showList()
    {
        $discountCodes = adminDiscountCodeModel::getAll()
            ->leftJoin('package', 'discount_code.package_id', '=', 'package.Package_id')
            ->getList();

        $export = $discountCodes['export'];
        $this->fileName = "admin.discountCode.showList.php";
        $this->template($export);
        die();
    }

    /**
     *
     */
    public function showDiscountCodeAddForm()
    {
        $packages = package::getAll()->getList();
        $export['packages'] = $packages['export']['list'];

        $this->fileName = "admin.discountCode.addForm.php";
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     */
    public function addDiscountCode($fields)
    {
        if ($fields['percent'] > 100 || $fields['percent'] < 0) {
            $msg = "درصد تخفیف باید بین 0 تا 100 باشد";
            redirectPage(RELA_DIR . 'admin/?component=discountCode&action=addDiscountCode', $msg);
        }

        if ($fields['discount_type'] == 2) {
            $this->defineDiscountCodePublic($fields);
        } else {
            $this->defineDiscountCodePrivate($fields);
        }
        redirectPage(RELA_DIR . 'admin/?component=discountCode');
    }

    /**
     * @param $fields
     */
    public function defineDiscountCodePublic($fields)
    {
        $discount = new adminDiscountCodeModel();
        $code = $this->generateCode();
        $fields['code'] = strtoupper($fields['precode']) . $code;
        $fields['type'] = $fields['discount_type'];
        $fields['start_date'] = convertJToGDate($fields['start_date']);
        $fields['expire_date'] = convertJToGDate($fields['expire_date']);
        $discount->setFields($fields);
        $discount->save();
        return;
    }

    /**
     * @param $fields
     */
    public function defineDiscountCodePrivate($fields)
    {
        $sql = "INSERT INTO `discount_code` (`Discount_code_id`, `code`, `percent`, `type`, `start_date`, `expire_date`, `status`, `package_id`) VALUES";
        $fields['start_date'] = convertJToGDate($fields['start_date']);
        $fields['expire_date'] = convertJToGDate($fields['expire_date']);

        for ($i = 1; $i <= $fields['count']; $i++) {
            $code = $this->generateCode();
            $string = strtoupper($fields['precode']) . $code;
            $sql .= " (NULL ,'" . $string .
                "','" . $fields['percent'] .
                "'," . $fields['discount_type'] .
                ",'" . $fields['start_date'] .
                "','" . $fields['expire_date'] .
                "'," . 0 .
                "," . $fields['package_id'] .
                "),";
        }
        $sql = substr($sql, 0, -1);
        $conn = dbConn::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return;
    }

    /**
     * @return string
     */
    public function generateCode()
    {
        $length = 6;
        $x = '0123456789'; // ABCDEFGHIJKLMNOPQRSTUVWXYZ
        $string = substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
        return $string;
    }

    /**
     * @param $discount_code_id
     */
    public function deleteDiscountCode($discount_code_id)
    {
        $discount = adminDiscountCodeModel::find($discount_code_id);

        if (is_object($discount)) {
            $discount->delete();
            redirectPage(RELA_DIR . 'admin/?component=discountCode', 'کد تخفیف حذف شد');
        }
        redirectPage(RELA_DIR . 'admin/?component=discountCode', 'کد تخفیف حذف نشد');
    }

    public function getCompanyListUseDiscount()
    {
        $companyLists = DB::table('company')
            ->join('invoice', 'company.company_id', '=', 'invoice.company_id')
            ->leftJoin('discount_code', 'discount_code.Discount_code_id', '=', 'invoice.discount_code_id')
            ->where('invoice.discount_code_id', '<>', '')
            ->getList();
        $this->fileName = "admin.discount.companyshowList.php";
        $this->template($companyLists['export']);
        die();

        /*SELECT * FROM company
        JOIN invoice ON company.Company_id = invoice.company_id
        LEFT JOIN discount_code ON invoice.discount_code_id = discount_code.Discount_code_id
        WHERE invoice.discount_code_id <> ''*/
    }
}
