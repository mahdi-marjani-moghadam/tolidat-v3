<?php

class discountCodeController
{

    private $company_info;

    /**
     * discountCodeController constructor.
     * @param $company_info
     */
    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . '404');
        }
        $this->company_info = $company_info;
    }
}
