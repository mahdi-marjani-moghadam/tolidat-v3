<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {
        var $modal = $('.customMobile');

        // DataTable
        /*    var table = $('#example').DataTable();
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
         } );*/


        //	dtatatable
        var dataTable = $('#example');
        var oTable = dataTable.DataTable({
            "processing": true,
            "serverSide": true,
            "sPaginationType": "bs_full",
            "oLanguage": {
                "sProcessing": "در حال بارگذاری ..."
            },
            "aaSorting": [8],
            "ajax": "<?=RELA_DIR?>admin/?component=company&action=search&status=<?=$list['status']?>",

        });

        /*$('#example').dataTable( {
         "columnDefs": [ {
         "targets": 'no-sort',
         "orderable": false,
         } ]
         } );*/

        // Apply the search
        //alert($("#search_9").val());
        var timerId;
        oTable.columns().every(function () {
            var that = this;
            $('input , select', this.footer()).on('keyup change', function () {
                var d = this;
                clockStop();
                clockStart();
                function clockStart() {
                    if (timerId) return;
                    timerId = setInterval(update, 1200);
                }

                function clockStop() {
                    if (!timerId) return;
                    clearInterval(timerId);
                    timerId = null;
                }

                function update() {
                    clockStop();
                    console.log(d.value);
                    that.search(d.value).draw();
                }

                //that.search(this.value).draw();
                //clearTimeout(timerId)
            });
        });


        //	dtatatable

        // Apply the search

        //show other phone

        $('#example tbody').on('click', '.company_phone', function () {
            var company_id = $(this).data('company_id');
            $("#loading").show();
            $.ajax({
                url: '<?=RELA_DIR?>admin/?component=company&action=getCompanyPhone',
                type: "POST",
                data: "company_id=" + company_id,
                cache: false,
                success: function (data) {
                    $("#loading").hide();
                    $("#allcompanyphone").html(data);
                    $modal.find('.phoneHolder').html('');
                    $modal.find('.phoneHolder').html(data);
                    $modal.modal('show');
                }
            });
        });

        $('body').on('click', '.company_allphone', function () {
            var company_one_phone = $(this).data('myphonenumber');
            var company_id = $(this).data('mycompanyid');
            call(company_one_phone, company_id);
            //alert(company_id+" => "+company_one_phone);
        });

        $('body').on('click', '#company-information', function () {
            var company_id = $(this).data('companyid');
           // companyInformation(company_id);
        });


    });

    function companyInformation(company_id) {

        var dataString = 'company_id=' + company_id;

        $.ajax({
            url: '<?=RELA_DIR?>admin/?component=company&action=getCompanyInfoAjax',
            type: "POST",
            data: dataString,
            cache: false,
            success: function (data) {
                $("#loading").hide();
                if (data == 'yes') {
                    window.location = '<?=RELA_DIR?>admin/?component=company&action=edit&id=' + id;
                } else {

                }
            }
        });

        $("#loading").show();
    }

    function call(number, id) {

        var dataString = 'number=' + number;
        $("#loading").show();
        $.ajax({
            url: '<?=RELA_DIR?>admin/?component=company&action=call',
            type: "POST",
            data: dataString,
            cache: false,
            success: function (data) {
                $("#loading").hide();
                if (data == 'yes') {
                    window.location = '<?=RELA_DIR?>admin/?component=company&action=edit&id=' + id;
                } else {

                }
            }
        });
    }
</script>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> لیست کمپانی</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <!-- separator -->

    <div class="row xsmallSpace"></div>

    <div id="panel-1" class="panel panel-default border-blue">

        <div class="panel-heading bg-blue">

            <h3 class="panel-title rtl ">لیست کمپانی ها</h3>

            <div class="panel-actions">

                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>

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
                    <thead>
                    <tr>
                        <th width="1%">ردیف</th>
                        <th width="20%">نام کمپانی</th>
                        <th width="5%">نوع کمپانی</th>
                        <th width="10%">نام خانوادگی نماینده</th>
                        <th width="3%">بسته</th>
                        <th width="22%">تاریخ انقضاء بسته</th>
                        <th width="3%">وضعیت</th>
                        <th width="2%">کد ویرایش کننده</th>
                        <th width="15%">تاریخ ویرایش</th>
                        <th width="5%">تصویر</th>
                        <th width="5%">ابزار</th>
                    </tr>

                    </thead>
                    <tfoot>
                    <tr>
                        <th><input type="text" name="search_1" class="search_init form-control"/></th>
                        <th><input type="text" name="search_2" class="search_init form-control"/></th>
                        <th><select name="search_3" class="search_init" id="search_3">
                                <option value="">همه</option>
                                <option value="1">حقوقی</option>
                                <option value="2">حقیقی</option>
                            </select>
                        </th>
                        <th><input type="text" name="search_4" class="search_init form-control"/></th>
                        <th><select name="search_5" class="search_init " id="search_5">
                                <option value="">همه</option>
                                <option value="1">رایگان</option>
                                <option value="4">تجاری</option>
                            </select>
                        </th>
                        <th><input type="text" name="search_6" class="search_init form-control date"/></th>
                        <th><select name="search_7" class="search_init " id="search_7">
                                <option value="">همه</option>
                                <option value="1">فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </th>
                        <th><input type="text" name="search_7" class="search_init form-control"/></th>
                        <th style="width: 200px;">
                            <input type="text" class="form-control date" name="search_9" id="expiration_date"
                                   value="<?= $list['licenceInfo']['expiration_date'] ?>">
                        </th>
                        <th><input type="hidden" name="search_9" class="search_init form-control"/></th>
                        <th><input type="hidden" name="search_10" class="search_init form-control date"></th>


                    </tr>
                    </tfoot>
                </table>

            </div>

        </div>

        <div class="panel-footer clearfix"></div>

    </div>

</div>
<!--/content-body -->

<div class="modal fade customMobile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p class="phoneHolder"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    //------> Set Reference_type
    $("#licence_type").on('change', function () {
        if ($(this).val() == '0') {
            $("#licence_box").html(
                "<div class='form-group'>" +
                "<label class='col-xs-12 col-sm-4 pull-right control-label rtl' for='licenceTypeName'>توضیحات جواز:</label>" +
                "<div class='col-xs-12 col-sm-8 pull-right'>" +
                "<input type='text' class='form-control' name='licenceTypeName' id='licenceTypeName' value='' required>" +
                "</div>" +
                "</div>" +
                "</div>"
            );
        } else {
            $("#licence_box").html("");
        }
    });

    //------>state Change
    $(document).ready(function () {
        var $body = $('body'),
            windowWidth = $(window).width(),
            windowHeight = $(window).height(),
            $toggleSideBar = $('#toggleSideBar'),
            $datePicker = $('.date'),
            $sideBar = $('.side-left');

        try {
            //------> Select City & State with Jquery
            var p = document.getElementById("province_id");
            var province = p.options[p.selectedIndex].value;
            var city = '<?php echo $list['companyInfo']['city_id']?>';

            var $maxCanSelectedInput = $body.find('#maxCanSelected'),
                $updateAllowedCat = $('.updateAllowedCat'),
                $selectedCat = $('#selectedCategories'),
                $categoryContainer = $('.container-view'),
                $maxCanSelectedNum = $maxCanSelectedInput.val(),
                selectedCatArr = [];

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


            if ("<?= isset($list['licenceInfo']['licence_number'])?>") {
                $.addLicence();
            }
            else {
                $.removeLicence();
            }


            //------>category Change
            var category_id = "<?php echo $list['companyInfo']['category_id'] ?>";
            if (category_id) {
                var ele = $('input[value="' + category_id + '"]');
                ele.attr('checked', true);
                console.log(ele.parent().text());
                var html = '<li data-id="' + category_id + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + ele.parent().text() + '</li>';
                $('.selected-category').append(html);

                selectedCatArr.push(category_id);

                selectedCatToInput();
            }
        } catch (error) {
            console.log(error);
        }

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

        /* ------ Responsive Menu ------*/
        $toggleSideBar.bind('click', function () {
            $sideBar.toggleClass('active');
        });

        // change input date to persian date picker
        $datePicker.each(function () {
            var $this = $(this);
            $this.persianDatepicker({
                months: ["فروردین ماه", "اردیبهشت ماه", "خرداد ماه", "تیر ماه", "مرداد ماه", "شهریور ماه", "مهر ماه", "آبان ماه", "آذر ماه", "دی ماه", "بهمن ماه", "اسفند ماه"],
                dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
                shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
                persianNumbers: 1,
                formatDate: "YYYY/MM/DD",
                prevArrow: '<i class="fa fa-angle-left"></i>',
                nextArrow: '<i class="fa fa-angle-right"></i>',
                selectableYears: [1410, 1409, 1408, 1407, 1406, 1405, 1404, 1403, 1402, 1401, 1400, 1399, 1398, 1397, 1396, 1395, 1394, 1393, 1392, 1391, 1390, 1389, 1388, 1387, 1386, 1385, 1384, 1383, 1382, 1381, 1380, 1379, 1378, 1377, 1376, 1375, 1374, 1373, 1372, 1371, 1370, 1369, 1368, 1367, 1366, 1365, 1364, 1363, 1362, 1361, 1360, 1359, 1358, 1357, 1356, 1355, 1354, 1353, 1352, 1351, 1350],
            });
        });

        $body.find('.pdp-default').each(function (index) {
            $(this).insertAfter('.date:eq(' + index + ')');
            $('.date:eq(' + index + ')').parent().css('position', 'relative');
        });
    });


</script>