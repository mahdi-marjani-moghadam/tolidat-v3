<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/6/2015
 * Time: 10:35 AM.
 */
include_once ROOT_DIR.'/common/validators.php';
class adminc_websites_dModel extends looeic
{
      // protected   $TABLE_NAME ='company';
    public function getCompanyWebsitesBranchQuery($companyId)
    {
        return $this->select('*')
            ->leftJoin('c_branch', 'c_websites_d.branch_id', '=', 'c_branch.parent_id')
            ->where('c_websites_d.company_id', '=', $companyId)
            ->where('c_websites_d.status', '=', '-1')
            ->where('c_branch.status', '=', '2')
            ->orWhere('c_branch.status', '=', '-1')
            ->where('c_websites_d.isActive', '=', '1')
            ->where('c_branch.isActive', '=', '1');

    }

    public function findCompanyWebsitesBranchObject($companyId)
    {
        $WebsitesBranch = $this->getCompanyWebsitesBranchQuery($companyId)->get();
        foreach ($WebsitesBranch['export']['list'] as $key => $filed) {
            $result[] = $filed->fields;
        }
        return $result ;
    }
}

