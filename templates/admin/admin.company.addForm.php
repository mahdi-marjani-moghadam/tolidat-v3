<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> افزودن کمپانی جدید</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم کمپانی</h3>

            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl"
                        data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->

        <?php if ($msg != null) {
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?php echo  $msg ?>
            </div>
            <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal"
                          novalidate="novalidate" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                           for="company_type">نوع کمپانی :</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="company_type" id="company_type" data-input="select2">
                                            <option></option>
                                            <option value="1">حقوقی</option>
                                            <option value="2">حقیقی</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--                            <div class="col-xs-12 col-sm-12 col-md-6">-->
                            <!--                                <div class="form-group">-->
                            <!--                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"-->
                            <!--                                           for="active">تایید :</label>-->
                            <!--                                    <input type="checkbox" name="active" value="1">-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                        <div id="step1"></div>
                        <div id="step2"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    <?php
        if (isset($list['company_type'])) {
    ?>
        k( <?php $list['company_type'] ?>);
    <?php
    }
    ?>

    //---->function
    function k(companyType) {
        $.ajax({
            url: "<?php echo RELA_DIR . 'admin/?component=company&action=checkCompany' ?>",
            data: {company_type: companyType},
            method: 'post',
            dataType: "html",
            success: function (result) {
                if()
                var newhtml = $.parseHTML(result, true);
                $("#step2").html(newhtml);
                $("#licence_box").hide();
                $("#personality_box").hide();
            },
            error: function (result, status) {
                console.log('error: ' + status);
            }
        });
        return 0;
    }


    //---->step 1
    $("#company_type").on("change", function () {
        $.ajax({
            url: "<?php echo RELA_DIR . 'admin/?component=company&action=getTypeAjax'?>",
            data: {type: this.value},
            dataType: "html",
            method: 'post',
            success: function (result) {
                var newhtml = $.parseHTML(result, true);
                $("#step1").html(newhtml);
                $("#step2").html('');
                $("#licence_box").hide();
                $("#personality_box").hide();
            },
            error: function (result, status) {
                console.log('error: ' + status);
            }
        });
    });

    //---->step 2
    $("body").on("click", "#btnCheck", function (e) {
        e.preventDefault();
        if ($("#company_type").val() == '1') {
            $.ajax({
                url: "<?php echo RELA_DIR . 'admin/?component=company&action=checkCompany' ?>",
                data: {company_type: $("#company_type").val()},
                method: 'post',
                dataType: "html",
                success: function (result) {
                    var newhtml = $.parseHTML(result, true);
                    $("#step2").html(newhtml);
                    $("#licence_box").hide();
                    $("#personality_box").hide();
                },
                error: function (result, status) {
                    console.log('error: ' + status);
                }
            });
        } else {
            $.ajax({
                url: "<?php echo RELA_DIR . 'admin/?component=company&action=checkCompany'?>",
                data: {
                    company_type: $("#company_type").val(),
                    licence_number: $("#licence_number").val(),
                    licence_type: $("#licence").val(),
                    description: $("#licence_description").val()
                },
                method: 'post',
                success: function (result) {
                    var newhtml = $.parseHTML(result, true);
                    $("#step2").html(newhtml);

                    $("#personality_box").hide();
                },
                error: function (result, status) {
                    console.log('error: ' + status);
                }
            });
        }
    });

    $("body").on("change", "#licence", function () {
        if ($("#licence").val() == '0') {
            $("#licence_box").show();
        } else {
            $("#licence_box").hide();
        }
    });

    $("body").on("change", "#personality_list", function () {
        if ($("#personality_list").val() == '0') {
            $("#personality_box").show();
        } else {
            $("#personality_box").hide();
        }
    });

    $("body").on("change", "#province_id", function () {
        $.ajax({
            url: "<?php echo RELA_DIR . 'admin/?component=company&action=getCityAjax'?>",
            data: {province_id: $("#province_id").val()},
            method: 'post',
            success: function (result) {
                $('#city_id').html(result);
            },
            error: function (result, status) {
                console.log('error: ' + status);
            }
        });
    });

</script>