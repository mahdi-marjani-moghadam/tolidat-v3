<style>

    td {
        word-wrap: normal;
        text-overflow: inherit;
        word-break: break-all;
    }

    .small-space {
        margin-top: 10px;
        margin-bottom: 10px;
    }

</style>


<div class="content-control">


  <ul class="control-nav pull-right">
    <li>
        <a class="rtl text-24"><i class="sidebar-icon fa fa-newspaper-o"></i> لیست رویدادها</a>
    </li>
  </ul>

</div>

<div class="content-body">

    <!-- separator -->
    <div class="xsmallSpace"></div>

    <div id="panel-1" class="panel panel-default border-blue">

    <div class="panel-heading bg-blue">

      <h3 class="panel-title rtl">لیست رویدادها</h3>

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
            <a href="<?=RELA_DIR?>admin/?component=event&action=create" class="btn btn-primary btn-sm btn-icon text-13">
                <i class="fa fa-plus"></i> افزودن رویداد جدید
            </a>
        </div>

        <!-- separator -->
        <div class="row smallSpace"></div>

      <div class="table-responsive table-responsive-datatables">

        <table id="eventShowList" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">

          <thead>
              <tr>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>متن رویداد</th>
                <th>خلاصه توضیحات</th>
                <th>کلمات کلیدی</th>
                <th> توضیحات کلیدی</th>
                  <th>تاریخ</th>
                  <th>تصویر</th>
                <th></th>
              </tr>
          </thead>

          <tbody>
          <?php
          $counter = 1;
          if (isset($events)) {
            foreach ($events as $event) { ?>

              <tr>
                <td><?= $event['event_id'] ?></td>
                <td><?= $event['title'] ?></td>
                <td><?= $event['body'] ?></td>
                <td><?= $event['brief_description'] ?></td>
                <td><?= $event['meta_keyword'] ?></td>
                <td><?= $event['meta_description'] ?></td>
                  <td><?= $event['date'] ?></td>
                  <td dir="ltr" align="center"> <img height="60px" src="<?= $event['icon'] ?>"/> </td>
                <td>
                    <a href="<?=RELA_DIR?>admin/?component=event&action=edit&id=<?= $event['event_id'] ?>" class="btn btn-success">ویرایش</a>
                    <div class="small-space"></div>
                    <a id="delete" href="<?=RELA_DIR?>admin/?component=event&action=destroy&id=<?= $event['event_id'] ?>" class="btn btn-danger">حذف</a></td>
              </tr>

              <?php
                $counter++;
            }
          }
          ?>
          </tbody>

          <tfoot>
            <th><input type="hidden" name="search_1" class="search_init form-control" /></th>
            <th><input type="text" name="search_2" class="search_init form-control" /></th>
            <th><input type="text" name="search_3" class="search_init form-control" /></th>
            <th><input type="text" name="search_4" class="search_init form-control" /></th>
            <th><input type="text" name="search_5" class="search_init form-control" /></th>
            <th><input type="text" name="search_6" class="search_init form-control" /></th>
            <th><input type="text" name="search_8" class="search_init form-control" /></th>
            <th></th>
            <th></th>
          </tfoot>

        </table>

      </div>

    </div>

    <div class="panel-footer clearfix">

    </div>

  </div>

</div><!--/content-body -->

<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function() {

        $(document).on('click', '#delete', function(event){
            if (confirm("آیا از حذف این رویداد اطمینان دارید؟") == false) {
                return false;
            }
        });

        // DataTable
        var table = $('#eventShowList').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            });
        });

    });

</script>