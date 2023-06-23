/**
 * Created by Netplorer on 10/26/14.
 */

$(function(){
    var $datePicker = $('.date');

    $('#startDate').persianDatepicker();
    $('#stopDate').persianDatepicker();

    // DATATABLES
    $('.datatable').each(function(){
        var $this = $(this),
            page = ($this.data('page')) ? $this.data('page') : 'bs_full',
            source = ($this.data('source')) ? $this.data('source') : false

        $this.dataTable({
            "sDom": 'T<"clear">lfrtip',
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "csv",
                    "xls",
                    {
                        "sExtends": "pdf",
                        "sPdfOrientation": "landscape",
                        "sPdfMessage": "Your custom message would go here."
                    },
                    "print"
                ]
            },

            "sSwfPath": "templates/template_fa/assets/swf/copy_csv_xls_pdf.swf",
            "sPaginationType": page,
            "bProcessing": true
        });
    });

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
                extensions	: [ 'effect-slide-menu', 'pageshadow' ],
                searchField	: false,
                counters	: true,
                navbars		: [
                    {
                        position: 'top',
                        content : [ 'searchfield']
                    }
                ],
                navbar:{
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

    $('.mm-page').remove();

    $('.datatable-tools').each(function(){
        var $this = $(this),
            page = ($this.data('page')) ? $this.data('page') : 'bs_full',
            source = ($this.data('source')) ? $this.data('source') : false

        $this.dataTable({
            "sPaginationType": page,
            "sDom": "<'TTT_btn-group-wrapper'T><'row'<'col-sm-12'<'pull-right'f><'pull-left'l>r<'clearfix'>>>t<'row'<'col-sm-12'<'pull-left'i><'pull-right'p><'clearfix'>>>",
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "print",
                    {
                        "sExtends":    "collection",
                        "sButtonText": 'Save <i class="fa fa-angle-down"></i>',
                        "aButtons":    [
                            "xls",
                            "csv",
                            {
                                "sExtends": "pdf",
                                // "sPdfMessage": "Your custom message would go here.",
                                "sPdfOrientation": "landscape"
                            }
                        ]
                    }
                ],
                "sSwfPath": "templates/template_fa/assets/swf/copy_csv_xls_pdf.swf"
            }
        });
    });
    $('.datatable, .datatable-tools').each(function(){
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.addClass('form-control input-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.addClass('form-control input-sm');
    });
    // END DATATABLES


    $(".addGroup").bind("click",function(e){
        e.preventDefault();
        $("#modalAddGroup").modal("show");
    })

    $('.editGroup').bind('click', function (e) {
        e.preventDefault();
        $('#GroupIdEdit').val($(this).attr('data-id'));
        $('#GroupNameEdit').val($(this).attr('data-name'));
        $('#GroupStatusEdit').val($(this).attr('data-status'));

        $('#modalGroupEdit').modal('show');
    });

    var $body = $('body');
    var counter = 2,
        maxCashNumber = 10;

    $body.on('click','button[data-role="remove"]',function(e){
        e.preventDefault();
        if(counter >= 2) {
            counter--;
            $('.appendSchedule .row[data-target="'+counter+'"]').remove();
        }
    });

    $('button[data-role="add"]').bind('click',function(e){
        e.preventDefault();

        if(counter <= maxCashNumber) {
            if (counter <= 2) {
                counter = 2;
            }

            var htmlStream = '';

            htmlStream += '<div class="row" data-target="'+counter+'">';
            htmlStream += '<div class="row xsmallSpace"></div>';
            htmlStream +=   '<div class="col-md-2 pull-right">';
            htmlStream +=       '<div class="row">';
            htmlStream +=           '<div class="col-md-12">';
            htmlStream +=               '<div class="form-group">';
            htmlStream +=                   '<label for="weekday'+counter+'" class="col-sm-4 control-label rtl pull-right text-16 text-normal">روز : </label>';
            htmlStream +=                   '<div class="col-sm-8 pull-right rtl">';
            htmlStream +=                       '<select name="weekday[]" id="weekday'+counter+'" class="form-control">';
            htmlStream +=                           '<option value="7">شنبه</option>';
            htmlStream +=                           '<option value="1">یکشنبه</option>';
            htmlStream +=                           '<option value="2">دوشنبه</option>';
            htmlStream +=                           '<option value="3">سه شنبه</option>';
            htmlStream +=                           '<option value="4">چهارشنبه</option>';
            htmlStream +=                           '<option value="5">پنج شنبه</option>';
            htmlStream +=                           '<option value="6">جمعه</option>';
            htmlStream +=                       '</select>';
            htmlStream +=                   '</div>';
            htmlStream +=               '</div>';
            htmlStream +=           '</div>';
            htmlStream +=       '</div>';
            htmlStream +=   '</div>';

            htmlStream +=   '<div class="col-md-2 pull-right">';
            htmlStream +=       '<div class="row">';
            htmlStream +=           '<div class="col-md-12">';
            htmlStream +=               '<div class="form-group">';
            htmlStream +=                   '<label for="startTime'+counter+'" class="col-sm-5 control-label rtl pull-right text-14 text-normal">زمان شروع :</label>';
            htmlStream +=                   '<div class="col-sm-7">';
            htmlStream +=                       '<input type="text" data-input="timepicker" data-show-meridian="false" data-template="dropdown" name="startTime[]" id="startTime'+counter+'" class="form-control">';
            htmlStream +=                   '</div>';
            htmlStream +=               '</div>';
            htmlStream +=           '</div>';
            htmlStream +=       '</div>';
            htmlStream +=   '</div>';

            htmlStream +=   '<div class="col-md-2 pull-right">';
            htmlStream +=       '<div class="row">';
            htmlStream +=           '<div class="col-md-12">';
            htmlStream +=               '<div class="form-group">';
            htmlStream +=                   '<label for="stopTime'+counter+'" class="col-sm-5 control-label rtl pull-right text-14 text-normal">زمان پایان :</label>';
            htmlStream +=                   '<div class="col-sm-7">';
            htmlStream +=                       '<input type="text" data-input="timepicker" data-show-meridian="false" data-template="dropdown" name="stopTime[]" id="stopTime'+counter+'" class="form-control">';
            htmlStream +=                   '</div>';
            htmlStream +=               '</div>';
            htmlStream +=           '</div>';
            htmlStream +=       '</div>';
            htmlStream +=   '</div>';

            htmlStream +=   '<div class="col-md-3 pull-right">';
            htmlStream +=       '<div class="row">';
            htmlStream +=           '<div class="col-md-12">';
            htmlStream +=               '<div class="form-group">';
            htmlStream +=                   '<label for="startExTime'+counter+'" class="col-sm-5 control-label rtl pull-right text-14 text-normal">زمان شروع استثناء :</label>';
            htmlStream +=                   '<div class="col-sm-5 pull-right">';
            htmlStream +=                       '<input type="text" data-input="timepicker" data-show-meridian="false" data-template="dropdown" name="startExTime[]" id="startExTime'+counter+'" class="form-control">';
            htmlStream +=                   '</div>';
            htmlStream +=               '</div>';
            htmlStream +=           '</div>';
            htmlStream +=       '</div>';
            htmlStream +=   '</div>';

            htmlStream +=   '<div class="col-md-3 pull-right">';
            htmlStream +=       '<div class="row">';
            htmlStream +=           '<div class="col-md-12">';
            htmlStream +=               '<div class="form-group">';
            htmlStream +=                   '<label for="stopExTime'+counter+'" class="col-sm-5 control-label rtl pull-right text-14 text-normal">زمان پایان استثناء :</label>';
            htmlStream +=                   '<div class="col-sm-5 pull-right">';
            htmlStream +=                       '<input type="text" data-input="timepicker" data-show-meridian="false" data-template="dropdown" name="stopExTime[]" id="stopExTime'+counter+'" class="form-control">';
            htmlStream +=                   '</div>';
            htmlStream +=               '</div>';
            htmlStream +=           '</div>';
            htmlStream +=       '</div>';
            htmlStream +=   '</div>';
            htmlStream += '<div class="row">';

            $(htmlStream).appendTo('.appendSchedule');
            counter++;

            $('[data-input="timepicker"]').each(function(){
                $(this).timepicker({
                    template: false
                }).on('changeTime.timepicker', function(e) {
                    var $this = $(this),
                        fake_input = $this.attr('data-fake-input');

                    $(fake_input).val(e.time.value);
                    $this.text(e.time.value);
                });
            });
        }

    });

    $body.on('click','.deleteSchedule',function(e){
        e.preventDefault();
        $("#deleteScheduleId").val($(this).attr("data-id"));
        $("#deleteScheduleModal").modal("show");
    });

    var typeNumList = $("input[name=numberListType]");

    typeNumList.change(function(){
        var value = $("input[name=numberListType]:checked").val();
        if (value == 'importTextFile') {

            $("#generateNumPart").addClass("hide");
            $("#prefixNum").prop("disabled",true);
            $("#toNum").prop("disabled",true);
            $("#fromNum").prop("disabled",true);

            $("#fileinput_widget").prop("disabled",false);
            $("#uploadPart").removeClass("hide");
        } else if (value == 'generateNumber') {

            $("#uploadPart").addClass("hide");
            $("#fileinput_widget").prop("disabled",true);

            $("#prefixNum").prop("disabled",false);
            $("#toNum").prop("disabled",false);
            $("#fromNum").prop("disabled",false);
            $("#generateNumPart").removeClass("hide");
        }
    });

    // server side data table
    $('.dataTableBlackList').dataTable({
        "sDom": 'T<"clear">lfrtip',
        "oTableTools": {
            "aButtons": [
                "copy",
                "csv",
                "xls",
                {
                    "sExtends": "pdf",
                    "sPdfOrientation": "landscape",
                    "sPdfMessage": "Your custom message would go here."
                },
                "print"
            ]
        },

        "sSwfPath": "templates/template_fa/assets/swf/copy_csv_xls_pdf.swf",
        "sPaginationType": 'bs_full',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "blackList.php?action=black"
    });

    // server side data table
    $('.dataTableNumberList').dataTable({
        "sDom": 'T<"clear">lfrtip',
        "oTableTools": {
            "aButtons": [
                "copy",
                "csv",
                "xls",
                {
                    "sExtends": "pdf",
                    "sPdfOrientation": "landscape",
                    "sPdfMessage": "Your custom message would go here."
                },
                "print"
            ]
        },

        "sSwfPath": "templates/template_fa/assets/swf/copy_csv_xls_pdf.swf",
        "sPaginationType": 'bs_full',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "numbers.php?action=listNumber"
    });

    $('.dataTableBlackList, .dataTableNumberList').each(function(){
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.addClass('form-control input-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.addClass('form-control input-sm');
    });

    $body.on('click','.deleteIcon',function(e){
        e.preventDefault();
        $("#deleteId").val($(this).attr("data-id"));
        $("#deleteModal").modal("show");
    });

    $body.on('click','.editIcon',function(e){
        e.preventDefault();
        $("#editId").val($(this).attr("data-id"));
        $("#numberEdit").val($(this).parents('tr').find("td:nth-child(1)").text());

        var value1 = $(this).parents("tr").find("td:nth-child(3)").text();

        $('#campaignEdit option').each(function(){
            if ($(this).text() === value1) {
                $(this).prop("selected",true);
            }
        });

        var value2 = $(this).parents("tr").find("td:nth-child(2)").text();

        $('#statusEdit option').each(function(){
            if ($(this).text() === value2) {
                $(this).prop("selected",true);
            }

        });

        $("#editModal").modal("show");
    });

    $body.on('click','.addToList',function(e){
        e.preventDefault();
        $("#addModal").modal("show");
    });

    $('select').select2();

    /* category scripts */
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

    var $maxCanSelectedInput = $body.find('#maxCanSelected'),
        $updateAllowedCat = $('.updateAllowedCat'),
        $selectedCat = $('#selectedCategories'),
        $categoryContainer = $('.container-view'),
        $maxCanSelectedNum = $.trim($maxCanSelectedInput.val()),
        selectedCatArr = [];

    function selectedCatToCategory() {
        if(!$('#selectedCategories').length) {
            return;
        }

        selectedCatArr = $('#selectedCategories').val().split(',');

        if(selectedCatArr.length === 1 && selectedCatArr[0] === '') {
            selectedCatArr = [];
        }

        var maxCanSelected = $('#maxCanSelected').val(),
        selectedCat = $('.selected-category li');

        $.each(selectedCatArr, function(i, v) {
            var $el = $('.mm-menu .mm-listview input[value="'+v+'"]');
            console.log(v);

            if($el && v !== '') {
                $el.prop('checked', true);

                var html = '<li data-id="' + v + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + $el.parent().text() + '</li>';

                $('.selected-category').append(html);
            }
        });
    }

    selectedCatToCategory();

    $.iziToastSuccess = function (msg) {
        iziToast.settings({
            onOpen: function (e) {
            }
        });
        iziToast.show({
            title: 'موفقیت',
            color: 'green',
            icon: 'fa fa-times-circle',
            iconColor: 'green',
            rtl: true,
            position: 'topCenter',
            timeout: 10000,
            message: msg,
            onOpen: function (e) {
                console.log("e:" + e);
            }
        });
    };

    $.iziToastError = function (msg) {
        iziToast.settings({
            onOpen: function (e) {
            }
        });
        iziToast.show({
            title: 'خطا',
            color: 'red',
            icon: 'fa fa-times-circle',
            iconColor: 'red',
            rtl: true,
            position: 'topCenter',
            timeout: 10000,
            message: msg
        });
    };

    $body.on('click', '.mm-listview input[type="checkbox"]', function () {
        var itemVal = $(this).val(),
            itemName = $(this).parent().text(),
            htmlItem = '<li data-id="' + itemVal + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + itemName + '</li>';

        // add this line in 17th mehr 1396 - omidkh68
        if(selectedCatArr.length === 1 && selectedCatArr[0] === '') {
            selectedCatArr = [];
        }

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
            if (i !== -1) {
                selectedCatArr.splice(i, 1);
            }
        }
        $updateAllowedCat.html(selectedCatArr.length);
        selectedCatToInput();

    });

    $body.on('click', '.removeCatSelected', function (e) {
        e.preventDefault();

        var itemVal = $(this).parent().data('id').toString();
        var i = selectedCatArr.indexOf(itemVal);
        if (i !== -1) {
            selectedCatArr.splice(i, 1);
        }

        $categoryContainer.find('ul li[data-id="' + itemVal + '"]').remove();

        $('.mm-menu .mm-listview input[value="'+itemVal+'"]').prop('checked', false);

        $updateAllowedCat.html(selectedCatArr.length);

        selectedCatToInput();
    });

    function selectedCatToInput() {
        $selectedCat.val(selectedCatArr.join(','));
    }

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
