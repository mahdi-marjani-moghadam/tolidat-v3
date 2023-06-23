<script type="text/javascript" src="../common/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    function BrowseServer(startupPath, functionData) {
        var finder = new CKFinder();
        finder.basePath = '../';
        finder.startupPath = startupPath;
        finder.selectActionFunction = SetFileField;
        finder.selectActionData = functionData;

        finder.popup();
    }

    function SetFileField(fileUrl, data) {
        document.getElementById(data["selectActionData"]).value = fileUrl;
    }
    function ShowThumbnails(fileUrl, data) {
        // this = CKFinderAPI

        var sFileName = this.getSelectedFile().name;
        document.getElementById('thumbnails').innerHTML +=
            '<div class="thumb">' +
            '<img src="' + fileUrl + '" />' +
            '<div class="caption">' +
            '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
            '</div>' +
            '</div>';

        document.getElementById('preview').style.display = "";
        // It is not required to return any value.
        // When false is returned, CKFinder will not close automatically.
        return false;
    }
</script>
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم بررسی اطلاعات شعبه: </h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->
        <?php if ($msg != null) {
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?= $msg ?>
            </div>
            <?php
        }
        ?>
        <?php //print_r_debug($list)?>
        <div class="panel-body">
            <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" autocomplete="off" novalidate="novalidate" method="post">
                    <div class="row xsmallSpace hidden-xs"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="phone">نام شعبه :</label>
                                <div class="col-xs-12 col-sm-8 pull-right">
                                    <input type="text" class="form-control" name="branch_name" id="branch_name" autocomplete="off" value="<?= $list['branchInfo']['branch_name']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="maneger_name">نام نماینده :</label>
                                <div class="col-xs-12 col-sm-8 pull-right">
                                    <input type="text" class="form-control" name="maneger_name" id="maneger_name" autocomplete="off" value="<?= $list['branchInfo']['maneger_name']; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- state -->
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                        for="city_id">انتخاب استان:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                    <select name="state_id" id="province_id" data-input="select2">
                                        <option></option>
                                        <?
                                        foreach ($list['provinces'] as $province_id => $value) {
                                            ?>
                                        <option
                                            <?= $value['province_id'] == $list['branchInfo']['state_id'] ? 'selected' : '' ?>
                                                value="<?= $value['province_id'] ?>">
                                            <?= $value['name'] ?>
                                            </option><?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- city -->
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                        for="city_id">انتخاب شهر:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                    <select name="city_id" id="city_id" data-input="select2"> //complete with Ajax </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row xsmallSpace hidden-xs"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                for="process">عملیات:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select name="process" id="process">
                                                <option value="0" selected></option>
                                                <option value="1">تایید</option>
                                                <option value="-1">رد</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pull-right">
                                <input name="action" type="hidden" id="action" value="edit"/>
                                <input name="branch_id" type="hidden" id="branch_id"
                                        value="<?= $list['branchInfo']['Branch_id'] ?>"/>
                                <button type="submit" name="update" id="submit"
                                        class="btn btn-icon btn-success rtl">
                                    <i class="fa fa-plus"></i> ثبت
                                </button>
                                <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //------>state Change
    $(document).ready(function () {
        var p = document.getElementById("province_id");
        var province = p.options[p.selectedIndex].value;
        var city = <?php echo($list['branchInfo']['city_id']);?>

            cityAjax(province, city);

        function cityAjax(province_id, city_id) {
            $.ajax({
                url: "<?php echo RELA_DIR . 'admin/?component=company&action=getCityAjax'?>",
                data: {province_id: province_id, city_id: city_id},
                method: 'post',
                success: function (result) {
                    $('#city_id').html(result);
                    $("#city_id").select2();
                },
                error: function (result, status) {
                    console.log('error: ' + status);
                }
            });
        }

        $("#province_id").on("change", function () {
            cityAjax($("#province_id").val(), city);
        });


        //------>category Change
        var category_id = "<?php echo $list['list']['category_id']['0'] ?>";
        if (category_id) {
            var ele = $('input[value="' + category_id + '"]');
            ele.attr('checked', true);
            console.log(ele.parent().text());
            var html = '<li data-id="' + category_id + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + ele.parent().text() + '</li>';
            $('.selected-category').append(html);
        }

    });


    $(function () {
        var $body = $('body');

        $('select').select2();

        $('nav.menu').each(function () {
            var placeholder = $(this).attr('data-placeholder');
            var title = $(this).attr('data-title');
            $(this).mmenu({
                    "searchfield": {
                        "placeholder": placeholder,
                        "noResults": "جستجویی پیدا نشد",
                        "add": true,
                        "search": true,
                        "resultsPanel": true,
                        "showSubPanels": false,
                        "showTextItems": true
                    },
                    extensions: ['effect-slide-menu', 'pageshadow'],
                    searchField: false,
                    counters: true,
                    navbars: [
                        {
                            position: 'top',
                            content: ['searchfield']
                        }
                    ],
                    navbar: {
                        add: true,
                        title: title,
                        titleLink: "parent"
                    }
                },
                {
                    clone: false,
                    offCanvas: {
                        menuWrapperSelector: $(this).parent()
                    },
                    "searchfield": {
                        "clear": true
                    }
                });
        });


        $.iziToastSuccess = function (msg) {
            iziToast.show({
                title: 'موفقیت',
                color: 'green',
                icon: 'fa fa-times-circle',
                iconColor: 'green',
                rtl: true,
                position: 'topCenter',
                message: msg
            });
        };

        $.iziToastError = function (msg) {
            iziToast.show({
                title: 'خطا',
                color: 'red',
                icon: 'fa fa-times-circle',
                iconColor: 'red',
                rtl: true,
                position: 'topCenter',
                message: msg
            });
        };

        var $maxCanSelectedInput = $body.find('#maxCanSelected'),
            $updateAllowedCat = $('.updateAllowedCat'),
            $selectedCat = $('#selectedCategories'),
            $categoryContainer = $('.container-view'),
            $maxCanSelectedNum = $maxCanSelectedInput.val(),
            selectedCatArr = [];

        $body.on('click', '.mm-listview input[type="checkbox"]', function () {
            var itemVal = parseInt($(this).val()),
                itemName = $(this).parent().text(),
                htmlItem = '<li data-id="' + itemVal + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + itemName + '</li>';

            if ($(this).is(':checked')) {
                if (selectedCatArr.length < $maxCanSelectedNum) {
                    $categoryContainer.find('ul').append(htmlItem);

                    selectedCatArr.push(itemVal);
                } else {
                    $.iziToastError('ماکسیمم دسته بندی مجاز انتخاب شده است');
                    $(this).prop('checked', false);
                }
            } else {
                $categoryContainer.find('ul li[data-id="' + itemVal + '"]').remove();

                var i = selectedCatArr.indexOf(itemVal);
                if (i != -1) {
                    selectedCatArr.splice(i, 1);
                }
            }

            $updateAllowedCat.html(selectedCatArr.length);

            selectedCatToInput();

        });

        $body.on('click', '.removeCatSelected', function (e) {
            e.preventDefault();

            var itemVal = parseInt($(this).parent().data('id'));

            var i = selectedCatArr.indexOf(itemVal);
            if (i != -1) {
                selectedCatArr.splice(i, 1);
            }

            $categoryContainer.find('ul li[data-id="' + itemVal + '"]').remove();

            $('.mm-listview input[type="checkbox"]').each(function () {
                if ($(this).val() == itemVal) {
                    $(this).prop('checked', false);
                }
            });

            $updateAllowedCat.html(selectedCatArr.length);

            console.log(selectedCatArr.length, $maxCanSelectedNum);

            selectedCatToInput();
        });

        function selectedCatToInput() {
            $selectedCat.val(selectedCatArr.join(','));
        }

        var windowWidth = $(window).width(),
            windowHeight = $(window).height(),
            $toggleSideBar = $('#toggleSideBar'),
            $datePicker = $('.date'),
            $sideBar = $('.side-left');

        /* ------ Responsive Menu ------*/
        $toggleSideBar.bind('click', function () {
            $sideBar.toggleClass('active');
        });

        // change input date to persian date picker
        if ($datePicker.length) {
            $datePicker.persianDatepicker({
                calendarPosition: {
                    x: -25,
                    y: 0
                },
                selectableYears: [1399, 1398, 1397, 1396, 1395, 1394, 1393, 1392, 1391, 1390, 1389, 1388, 1387, 1386, 1385, 1384, 1383, 1382, 1381, 1380, 1379, 1378, 1377, 1376, 1375, 1374, 1373, 1372, 1371, 1370, 1369, 1368, 1367, 1366, 1365, 1364, 1363, 1362, 1361, 1360, 1359, 1358, 1357, 1356, 1355, 1354, 1353, 1352, 1351, 1350, 1349, 1348, 1347, 1346, 1345, 1344, 1343, 1342, 1341, 1340, 1339, 1338, 1337, 1336, 1335, 1334, 1333, 1332, 1331, 1330, 1329, 1328, 1327, 1326, 1325, 1324, 1323, 1322, 1321, 1320, 1319, 1318, 1317, 1316, 1315, 1314, 1313, 1312, 1311, 1310, 1309, 1308, 1307, 1306, 1305, 1304, 1303, 1302, 1301, 1300]
            });
        }
    });
</script>




