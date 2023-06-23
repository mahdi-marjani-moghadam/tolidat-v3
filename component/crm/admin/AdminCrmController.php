<?php

include_once ROOT_DIR . "component/company/admin/model/admin.company.model.php";
include_once ROOT_DIR . "model/datatable.converter.php";
include_once ROOT_DIR . "component/admin/admin/model/admin.admin.model.php";

class AdminCrmController
{
    public $exportType = 'html';

    public $fileName;

    protected $letter;

    protected $letterAction;

    protected $letterLog;

    protected $letterTask;

    /**
     * AdminCrmController constructor.
     * @param $letter
     * @param $letterAction
     * @param $letterLog
     */
    public function __construct(LetterService $letter, LetterActionService $letterAction, LetterLogService $letterLog, LetterTaskService $letterTask)
    {
        $this->letter = $letter;
        $this->letterAction = $letterAction;
        $this->letterLog = $letterLog;
        $this->letterTask = $letterTask;
    }


    public function template($list = [])
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

    public function getCompanies($searchFields)
    {
        $companies = admincompanyModel::getAll()
            ->leftJoin('packageusage', 'company.Company_id', '=', 'packageusage.company_id')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->where('status', '=', 1);

        if (isset($searchFields['search']['letter_action'])) {
            $companyIds = $this->letterLog->getCompanyIdsByAction_id($searchFields['search']['letter_action']);

            if ($searchFields['search']['have_been'] == 1) {
                $companies->where('company.Company_id', 'in', $companyIds);
            } else {
                $companies->where('company.Company_id', 'not in', $companyIds);
            }

            $objClone = clone $companies;
            $totalRecord = $objClone->getList()['export']['recordsCount'];
        }

        if (isset($searchFields['filter'])) {
            foreach ($searchFields['filter'] as $filter => $value) {
                if ($filter == 'company_name') {
                    $companies->where('company.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'expiredate') {
                    $companies->where('packageusage.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else if ($filter == 'refresh_date') {
                    $companies->where('company.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else {
                    $companies->where('company.' . $filter, '=', convertToEnglish($value));
                }
            }
        }

        if (isset($searchFields['order'])) {
            foreach ($searchFields['order'] as $filter => $value) {
                if ($filter == 'expiredate') {
                    $companies->orderBy('packageusage.' . $filter, $value);
                } else {
                    $companies->orderBy('company.' . $filter, $value);
                }
            }
        }

        $objClone = clone $companies;
        $objClone->select('count(*) as totalRecord');
        $totalRecord = $totalRecord ? $totalRecord : $objClone->getList()['export']['list'][0]['totalRecord'];

        $companies->limit($searchFields['limit']['start'], $searchFields['limit']['length']);

        $result['totalRecord'] = $totalRecord;
        $result['companies'] = $companies->getList();
        return $result;
    }

    public function filterCompany($fields)
    {
        $i = 0;
        $columns = [
            ['db' => 'Company_id', 'dt' => $i++],
            ['db' => 'company_name', 'dt' => $i++],
            ['db' => 'company_type', 'dt' => $i++],
            ['db' => 'package_status', 'dt' => $i++],
            ['db' => 'expiredate', 'dt' => $i++],
            ['db' => 'status', 'dt' => $i++],
            ['db' => 'refresh_date', 'dt' => $i++],
            ['db' => 'logo_image', 'dt' => $i]
        ];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;
        $searchFields = $convert->convertInput();
        
        
        if (isset($fields['letter_action'])) {
            foreach ($fields['letter_action'] as $letter_action) {
                $searchFields['search']['letter_action'][] = $letter_action;
                $searchFields['search']['have_been'] = isset($fields['have-been']) ? $fields['have-been'] : 1;
            }
        }
        $companies = $this->getCompanies($searchFields);
        $list['list'] = $companies['companies']['export']['list'];
        $list['paging'] = $companies['totalRecord'];
        // dd(1);
        
        $other['1'] = array('formatter' => function ($list) {
            $st = '<a href="' . RELA_DIR . 'admin/?component=crm&action=logs&company_id=' . $list['Company_id'] . '">' . $list['company_name'] . '</a>';
            
            return $st;
        });

        $other['2'] = array('formatter' => function ($list) {

            if (($list['company_type'] == '1')) {
                $st = $list['company_type'] = 'حقوقی';
            } elseif ($list['company_type'] == '2') {
                $st = $list['company_type'] = 'حقیقی';
            }

            return $st;
        });

        $other['3'] = array('formatter' => function ($list) {

            if (($list['package_status'] == '1')) {
                $st = $list['package_status'] = 'رایگان';
            } elseif ($list['package_status'] == '4') {
                $st = $list['package_status'] = 'تجاری';
            }

            return $st;
        });

        $other['4'] = array('formatter' => function ($list) {
            if ($list['package_status'] == '4') {
                $st = $list['expiredate'] ? convertDate($list['expiredate']) : '0000/00/00';
            }

            return $st;
        });

        $other['5'] = array('formatter' => function ($list) {
            if ($list['status'] == 1) {
                $st = 'فعال';
            } elseif ($list['status'] == 0) {
                $st = 'غیر فعال';
            }

            return $st;
        });

        $other['6'] = array('formatter' => function ($list) {
            if ($list['refresh_date'] != '') {
                $st = convertDate($list['refresh_date']);
            }

            return $st;
        });

        $other['7'] = array('formatter' => function ($list) {
            if (strlen($list['image']) > 0) {
                $st = '<div data-company_id="' . $list['Company_id'] . '" class="company_phone">
                    <img src="' . COMPANY_ADDRESS . $list['Company_id'] . "/logo/" . $list['image'] . '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
            } else {
                $st = '<div data-company_id="' . $list['Company_id'] . '" class="company_phone">
                    <img src="' . DEFULT_LOGO_ADDRESS . '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
            }

            return $st;
        });

        $other['8'] = array('formatter' => function ($list) {
            $st = '<br>
                    <a href="' . RELA_DIR . 'admin/?component=company&action=printCompanyInformation&id=' . $list['Company_id'] . '&branch_id=0" target="_blank">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                    </a> 
                    <br>
                    <a href="' . RELA_DIR . 'admin/?component=company&action=editCompanyInformationForPrint&id=' . $list['Company_id'] . '" target="_blank" data-toggle="tooltip" title="به روزرسانی">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true" ></span>
                    </a>
                    <br>
                    <a href="' . RELA_DIR . 'admin/?component=company&action=editCompanyInformationForExhibition&id=' . $list['Company_id'] . '" target="_blank" data-toggle="tooltip"  title="نمایشگاه">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"   style="color: red"  ></span>
                    </a>';
            return $st;
        });

        $internalVariable['showstatus'] = $fields['status'];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function showListCompany($fields)
    {
        $export['status'] = 'showAll';
        $export['have_been_value'] = 1;

        if (isset($fields['letter_action'])) {
            foreach ($fields['letter_action'] as $action) {
                $export['letter_action'] .= '&letter_action%5B%5D=' . $action;
                $export['letter_action_id'][] = $action;
            }
        }

        if (isset($fields['have-been'])) {
            $export['have_been'] = '&have-been=' . $fields['have-been'];
            $export['have_been_value'] = $fields['have-been'];
        }

        $export['actions'] = $this->letterAction->getLetterActions();
        $this->fileName = "admin.crm.companyShowList.php";
        $this->template($export);
        die();
    }

}