<div class="content-control">
  <!--control-nav-->
  <ul class="control-nav pull-right">
      <li><a class="rtl text-24"><i class="fa fa-file-image-o"></i> لیست بنر نمایشگاه</a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<?php //print_r_debug($list) ?>
<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست بنر نمایشگاه</h3>
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
            <div class="pull-right">
                <a href="<?= RELA_DIR ?>admin/?component=bannerExhibition&action=addBanner" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن بنر جدید </a>
            </div>
            <!-- separator -->
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>توضیحات</th>
                        <th>تصویر</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list)) : ?>
                        <tr>
                            <td style="width: 60% !important;"><?= $list['description'] ?></td>
                            <td dir="ltr">
                                <img height="293px" src="<?= IMAGES_RELA_DIR."banner/exhibition/". $list['image'] ?>"/></td>
                            <td>
                                <a href="<?= RELA_DIR ?>admin/?component=bannerExhibition&action=editBanner&id=<?php echo $list['banner_exhibition_id']; ?>">ویرایش</a>
                                <a href="<?= RELA_DIR ?>admin/?component=bannerExhibition&action=deleteBanner&id=<?php echo $list['banner_exhibition_id']; ?>">حذف</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->



