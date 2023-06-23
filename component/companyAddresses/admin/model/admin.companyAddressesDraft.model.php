<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/6/2015
 * Time: 10:35 AM.
 */
include_once ROOT_DIR . '/common/validators.php';

class adminc_addresses_dModel extends looeic
{
    // protected   $TABLE_NAME ='company';
    /*CompanyAddressesBranch--------------------*/
    public function getCompanyAddressesBranchQuery($companyId)
    {
        return $this->select('*')
            ->leftJoin('c_branch', 'c_addresses_d.branch_id', '=', 'c_branch.parent_id')
            ->where('c_addresses_d.company_id', '=', $companyId)
            ->where('c_addresses_d.status', '=', '-1')
            ->where('c_branch.status', '=', '2')
            ->orWhere('c_branch.status', '=', '-1')
            ->where('c_addresses_d.isActive', '=', '1')
            ->where('c_branch.isActive', '=', '1');
    }

    public function findCompanyAddressesBranchObject($companyId)
    {
        $addressBranch = $this->getCompanyAddressesBranchQuery($companyId)->get();
        foreach ($addressBranch['export']['list'] as $key => $filed) {
            $result[] = $filed->fields;
        }
        return $result ;
    }

}

