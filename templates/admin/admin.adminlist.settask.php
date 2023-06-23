<script type="text/javascript">

    function show_confirm(id, s, os) {
        if (confirm("Are you sure?")) {
            window.location = "<?=$_SERVER['PHP_SELF']?>?action=status&id=" + id + "&status=" + s + "&os=" + os;
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
                class="glyphicon glyphicon-user"></i> <?php echo '';//تعیین سطح دسترسی?></h2>
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
                <h3 class="panel-title rtl"><?php echo '';//تعیین سطوح دسترسی?></h3>

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
                    <?php echo showWarningMsg($message) ?>
                    <?php echo showMsg($redirect) ?>

                    <?php
                    $c = 0;
                    foreach ($list['PagePermission'] as $pageName => $class) {
                        $c++;
                        if ($admin_info['compid'] != 1 && ($pageName == 'advertisment.controller.admin' || $pageName == 'company.controller')) {
                            continue;
                        } else {

                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <div class="nice-checkbox">
                                            <input type="checkbox" name="check_<?php echo $c; ?>" id="check_<?php echo $c; ?>"
                                                   value="All">
                                            <label for="check_<?php echo $c; ?>" class="text-success rtl">
                                                <span class="text-inverse"><?php echo $pageName; ?></span>
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
                                                        <input type="checkbox" name="permission[<?= $codAction; ?>]"
                                                               id="permission[<?= $codAction; ?>]"
                                                               value="<?= $codAction; ?>"
                                                            <?php if ($list['adminInfo']['permission'][$codAction - 1] == 1) {
                                                            print 'checked="checked"';
                                                        } ?>>
                                                        <label for="permission[<?= $codAction; ?>]"
                                                               class="text-success rtl">
                                                            <span

                                                                class="text-inverse"><?php echo $arrayAction['label']; ?></span>
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

                </div>

                <div class="panel-footer clearfix bg-cloud">
                    <div class="pull-right">
                        <a href="<?php echo RELA_DIR . "admin/setting.php" ?>"
                           class="btn btn-danger btn-sm rtl"><?php echo  "انصراف";//انصراف?></a>
                        <input name="action" type="hidden" id="action" value="setAdminTask"/>

                        <button type="submit"
                                class="btn btn-success btn-sm rtl"><?php echo "تأیید";//تأیید?></button>
                        <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!--/content -->