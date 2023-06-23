<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/6/2015
 * Time: 10:35 AM.
 */
include_once ROOT_DIR.'/common/validators.php';
class adminc_socials_dModel extends looeic
{
      // protected   $TABLE_NAME ='company';
    public function getCompanySocialsBranchQuery($companyId)
    {
        return $this->select('*')
            ->leftJoin('c_branch', 'c_socials_d.branch_id', '=', 'c_branch.parent_id')
            ->leftJoin('social_type', 'c_socials_d.social_type_id', '=', 'social_type.Social_type_id')
            ->where('c_socials_d.company_id', '=', $companyId)
            ->where('c_socials_d.status', '=', '-1')
            ->where('c_branch.status', '=', '2')
            ->orWhere('c_branch.status', '=', '-1')
            ->where('c_socials_d.isActive', '=', '1')
            ->where('c_branch.isActive', '=', '1');

    }

    public function findCompanySocialsBranchObject($companyId)
    {
        $PhoneBranch = $this->getCompanySocialsBranchQuery($companyId)->get();
        foreach ($PhoneBranch['export']['list'] as $key => $filed) {
            $result[] = $filed->fields;
        }
        return $result ;
    }
}

