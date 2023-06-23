<script type="text/javascript">

    function show_confirm(id, s, os) {
        if (confirm("Are you sure?")) {
            window.location = "<?php echo $_SERVER['PHP_SELF']?>?action=status&id=" + id + "&status=" + s + "&os=" + os;
        }
    }


    function checked1(checkBox, className) {
        className = "c" + className;
        $temp = checkBox.checked;
        $('.' + className + '').attr('checked', $temp);
    }

    $(function () {
        $('input[id^="check_"]').on('click', function () {
            var self = $(this),
                inputs = $(self).closest('.panel').find('input[id^="permission"]');
            if ($(this).is(':checked')) {
                inputs.prop('checked', true);
            } else {
                inputs.prop('checked', false);
            }
        });
    });


</script>
<div class="content">
    <div class="content-header">
        <h2 class="content-title rtl"><i
                class="glyphicon glyphicon-user"></i> <?php echo adminList_002;//تعیین سطح دسترسی?></h2>
    </div>
    <!--/content-header -->


    <div class="content-body">
        <!-- APP CONTENT
        ================================================== -->
        <!-- DASHBOARD
    ================================================== -->
        <!-- Dashboard  -->

        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl"><?php echo adminList_0016;//تعیین سطوح دسترسی?></h3>

                <div class="panel-actions">
                    <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl"
                            data-original-title="<?php echo adminList_0012;//تمام صفحه?>">
                        <i class="fa fa-expand"></i>
                    </button>
                </div>
                <!-- /panel-actions -->
            </div>
            <!-- /panel-heading -->

            <form action="" method="post" enctype="multipart/form-data" data-validate="form" novalidate="novalidate">
                <div class="panel-body">
                    <?php echo  showWarningMsg($message) ?>
                    <?php echo  showMsg($redirect) ?>

                    <?php
                    $c = 0;
                    foreach ($list as $pageName => $class) {
                        $c++;
                        if ($admin_info['compid'] != 1 && ($pageName == 'advertisment.controller.admin' || $pageName == 'company.controller')) {
                            continue;
                        } else {

                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <div class="nice-checkbox">
                                            <input type="checkbox" name="check_<?php echo  $c; ?>" id="check_<?php echo  $c; ?>"
                                                   value="All">
                                            <label for="check_<?php echo  $c; ?>" class="text-success rtl">
                                                <span class="text-inverse"><?php echo  $pageName; ?></span>
                                            </label>
                                        </div>
                                        <!--/nice-checkbox-->
                                    </h3>
                                </div>
                                <!-- /panel-heading -->

                                <div class="panel-body">
                                    <table class="adminList pull-right">
                                        <tbody>
                                        <tr>
                                            <?php
                                            foreach ($class->action as $action => $arrayAction) {
                                                $class->getPointAction($arrayAction['action']);
                                                $codAction = $class->getPointAction($arrayAction['action']);
                                                ?>
                                                <td style="padding: 0 1em;">
                                                    <div class="nice-checkbox">
                                                        <input type="checkbox" name="permission[<?php echo  $codAction; ?>]"
                                                               id="permission[<?php echo  $codAction; ?>]"
                                                               value="<?php echo  $codAction; ?>" <? if ($admin_permission[$codAction - 1] == 1) {
                                                            print 'checked="checked"';
                                                        } ?>>
                                                        <label for="permission[<?php echo  $codAction; ?>]"
                                                               class="text-success rtl">
                                                            <span
                                                                class="text-inverse"><? echo $arrayAction['label']; ?></span>
                                                        </label>
                                                    </div>
                                                    <!--/nice-checkbox-->
                                                </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                    <input name="action" type="hidden" id="action" value="setAdminTask"/>
                </div>

                <div class="panel-footer clearfix bg-cloud">
                    <div class="pull-right">
                        <a href="<?php echo RELA_DIR . "admin/setting.php" ?>"
                           class="btn btn-danger btn-sm rtl"><?php echo adminList_0017;//انصراف?></a>
                        <button type="submit"
                                class="btn btn-success btn-sm rtl"><?php echo adminList_0018;//تأیید?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!--/content -->


<?php
/*
?>
<div class="content-box">
<!-- Start Content Box -->

<div class="content-box-header">
  <h3><?php echo $title;?></h3>
  <ul class="content-box-tabs">
    <li><a href="#tab2" class="default-tab">Orders List</a></li>
    <!-- href must be unique and match the id of target div -->

  </ul>
  <div class="clear"> </div>
</div>
<!-- End .content-box-header -->

<div class="content-box-content">
  <div class="tab-content default-tab" id="tab2">
    <!-- This is the target div. id must match the href of this div's tab -->
    <form action="" method="post" enctype="multipart/form-data" >

      <div class="clear"> </div>
      <!-- End .clear -->


    <?php echo showWarningMsg($message)?>
    <?php echo showMsg($redirect)?>
    <table class="list" cellspacing="0" border="1">
      <thead>
        <tr>
          <th>Page Name </th>
          <?php for($i=1;$i<=Count_Permission;$i++):?>
          <th> <?php
		 // echo  $i;
		  ?></th>
          <?php endfor; ?>
        </tr>
      </thead>
      <tbody>
        <?php
		 $c=0;
		foreach($PagePermission as $pageName=>$class):
		//$class=unserialize($classSer);
		//print_r($class);
		$c++;
		?>
        <tr>
          <td>
           <label for="check_<?php echo $c;?>" style="color: red">
          <input name="check_<?php echo $c;?>" onclick="checked1(this,'c_<?php echo $c?>')" type="checkbox" id="check_<?php echo $c;?>" value="All"  />
        <?php echo $pageName;?> </label>
            </td>
          <?php
		foreach($class->action as $action=>$arrayAction):



			  $class->getPointAction($arrayAction['action']);
              $codAction=$class->getPointAction($arrayAction['action']);

			  ?>
              <td>
                 <label >
       		    <input name="permission[<?php echo $codAction;?>]"  value="<?php echo $codAction;?>" type="checkbox"  class="cc_<?php echo $c?>" id="check"
                 <? if($admin_permission[$codAction-1]==1):?>
                 checked="checked"
                 <? endif?>
                 />

				 <? echo $arrayAction['label']; //print_r($class) ?>
                 </label>
            </td>

		 <?php

		 endforeach;
		  for($i=count($class->action)+1;$i<=Count_Permission;$i++):?>
          <td></td>
          <?php endfor; ?>
        </tr>
        <?
		//echo '<pre/>';

		endforeach;
		?>
      <div class="contact" id="contact" > </div>
      <div id="mask"> </div>
        </tbody>

      <tfoot>
        <tr>
          <td colspan="5"></td>
        </tr>
      </tfoot>
    </table>
    <input name="action" type="hidden" id="action" value="setAdminTask" />
	<br />
	<input type="submit"  class="button" name="button" id="button" value="Update" />
    </form>
  </div>
  <!-- End #tab1 -->

</div>
<!-- End .content-box-content -->
</div>
*/
?>
