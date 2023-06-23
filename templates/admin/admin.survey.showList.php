<?php //print_r_debug($list); ?>

<script type="text/javascript" language="javascript" class="init">

  $(document).ready(function() {

    // DataTable
    var table = $('#example').DataTable({
      'order':[[0,'desc']]
    });

    // Apply the search
    table.columns().every( function () {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
          that
              .search( this.value )
              .draw();
        }
      } );
    } );
    ////

    // Apply the search

  } );
</script>
<div class="content-control">
  <!--control-nav-->
  <ul class="control-nav pull-right">
    <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست نظرات </a></li>
  </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
  <div class="row xsmallSpace"></div>
  <div id="panel-1" class="panel panel-default border-blue">
    <div class="panel-heading bg-blue">
      <h3 class="panel-title rtl">لیست نظرات</h3>
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
              <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                     width="100%">
                  <thead>
                  <tr>
                      <th>ردیف</th>
                      <th>ایمیل</th>
                      <th>نام کاربر </th>
                      <th>نظر</th>
                      <th>تاریخ </th>
                      <th>برای </th>
                      <th>وضعیت</th>
                      <th>امتیاز </th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $cn = 1;
                  if (isset($list['list']))
                  {
                      foreach ($list['list'] as $id => $fields)
                  {
                  ?>
                      <tr>
                          <td><?php echo $fields['Survey_id']; ?></td>
                          <td><?php echo $fields['user_email']; ?></td>
                          <td><?php echo $fields['user_name']; ?></td>
                          <td><?php echo $fields['comment']; ?></td>
                          <td><?php echo $fields['date']; ?></td>
                          <td><?php if( $fields['type'] == 'article' ){
                                  echo "مقالات ";
                                  
                              }elseif ($fields['type'] == 'category'){
                                  echo "دسته بندی ";

                              }elseif ($fields['type'] == 'company'){
                                echo 'کمپانی ';
                                echo "<a target='blank' href='/company/Detail/".$fields['type_id']."'>لینک</a>";
                              }
                              
                          ?></td>
                          <td><?php if( $fields['status'] == 1 ){
                                  echo "فعال";
                              }else{
                                  echo "غیر فعال";
                              }
                              ?></td>
                          <td><?php echo $fields['rate']; ?></td>
                          <td>
                              <a href="<?php echo RELA_DIR ?>admin/?component=survey&action=accept&id=<?php echo $fields['Survey_id']; ?>"><?php if( $fields['status'] == 1 ){
                                      echo " غیر فعال ";
                                  }else{
                                      echo " فعال";
                                  }
                                  ?></a>
                              <a href="<?php echo RELA_DIR ?>admin/?component=survey&action=delete&id=<?php echo $fields['Survey_id']; ?>">حذف</a>
                          </td>

                      </tr>
                  <?php
                  }
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <th><input type="hidden" name="search_1" class="search_init form-control"/></th>
                  <th><input type="text" name="search_2" class="search_init form-control"/></th>
                  <th><input type="text" name="search_3" class="search_init form-control"/></th>
                  <th><input type="text" name="search_4" class="search_init form-control"/></th>
                  <th><input type="text" name="search_5" class="search_init form-control"/></th>
                  <th><input type="text" name="search_6" class="search_init form-control"/></th>
                  <th><input type="text" name="search_7" class="search_init form-control"/></th>
                  <th><input type="text" name="search_8" class="search_init form-control"/></th>
                  <th><input type="hidden" name="search_9" class="search_init form-control"/></th>
                  </tfoot>
              </table>
          </div>
      </div>
    <div class="panel-footer clearfix">
    </div>
  </div>
</div><!--/content-body -->
