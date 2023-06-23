<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست مدیران </a></li>
    </ul>
    <!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست مدیران</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">

            <!-- separator -->
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">

                    <tbody>
                        <tr>
                            <td></td>
                            <td>نام کمپانی</td>
                            <td><?php echo $list['company_name'] .'<br>'.$list['meta_description']; ?></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>شماره تلفن </td>
                            <td>

                                <?php foreach ($list['company_phone']['number'] as $k => $phone) : ?>
                                    <?php echo $list['company_phone']['subject'][$k] . ': ' . $phone . ' ' . $list['company_phone']['state'][$k] . ' ' . $list['company_phone']['value'][$k] .'<br>'; ?>
                                <?php endforeach; ?>
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>وضعیت</td>
                            <td><?php
                                if ($list['status'] == 1) {
                                    echo 'فعال';
                                } else {
                                    echo 'غیر فعال';
                                }
                                ?></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>پکیج</td>
                            <td>
                                <?php echo $list['packageusage']->PackageUsage_id.'<br>' ?>
                                <?php echo 'محصول: '.$list['packageusage']->product.' استفاده شده:'.$list['packageusage']->product_Usage.'<br>'; ?>
                                <?php echo 'کی ورد: '.$list['packageusage']->keyword.' استفاده شده:'.$list['packageusage']->keyword_Usage.'<br>'; ?>
                                <?php echo 'دسته بندی: '.$list['packageusage']->category.' استفاده شده:'.$list['packageusage']->category_Usage.'<br>'; ?>
                                <?php echo 'representation: '.$list['packageusage']->representation.' استفاده شده:'.$list['packageusage']->representation_Usage.'<br>'; ?>
                                <?php echo 'شعبه: '.$list['packageusage']->branch.' استفاده شده:'.$list['packageusage']->branch_Usage.'<br>'; ?>
                                <?php echo 'تاریخ شروع: '.convertDate($list['packageusage']->start_date).' پایان:'.convertDate($list['packageusage']->expiredate); ?>
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>تاریخ خرید</td>
                            <td><?php echo convertDate($list['register_date']); ?> 
                                <?php echo 'تاریخ تایید: ' .convertDate($list['confirm_date']) ?>
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>نام مدیر</td>
                            <td><?php echo $list['maneger_name']; ?></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>
<!--/content-body -->