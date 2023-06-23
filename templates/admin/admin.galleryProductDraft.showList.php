<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {

        // DataTable
        var table = $('#example').DataTable();

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
        ////

        // Apply the search


    });


</script>
<?php //print_r_debug($list)?>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> لیست محصولات ویرایش شده</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl"> لیست محصولات ویرایش شده</h3>

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
            <div class="table-responsive table-responsive-datatables">
                <div class="row smallSpace"></div>
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>تصویر</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list)) : ?>
                        <?php foreach ($list as $gallery) : ?>
                            <tr>
                                <td><?php echo $gallery['product_gallery_id']; ?></td>
                                <td dir="ltr" align="center">
                                    <img height="60px" src="<?= COMPANY_ADDRESS . $gallery['company_id'] . "/product/gallery/" . $gallery['image'] ?>"/>
                                </td>
                                <td>
                                    <a href="<?= RELA_DIR ?>admin/?component=product&action=editDraftGalleryProduct&product_gallery_id=<?= $gallery['product_gallery_id']; ?>&company_id=<?= $gallery['company_id']; ?>">بررسی</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_5" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_6" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->



