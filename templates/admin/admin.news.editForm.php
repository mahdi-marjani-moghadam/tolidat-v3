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
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-newspaper-o"></i> ویرایش خبر </a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">جزییات خبر</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->
        <?php if ($msg != null) { ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?= $msg ?>
            </div>
            <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" autocomplete="off" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">عنوان :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="عنوان  " required value="<?= $list['title'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="brif_description">مختصر توضیحات :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="brif_description" id="brif_description" autocomplete="off" placeholder="مختصر توضیحات" required value="<?= $list['brif_description'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="description">متن خبر:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <textarea class="form-control fullFix" name="description" id="description" autocomplete="off" placeholder="متن خبر" required><?= $list['description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="meta_keyword">کلمات کلیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword"
                                               value="<?= $list['meta_keyword'] ?>"
                                               data-error="لطفا کلمه کلیدی را وارد نمایید" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_description">توضیح کلیدی :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_description" id="meta_description" autocomplete="off" placeholder=" توضیح کلیدی " required value="<?= $list['meta_description'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="xImagePath">تصویر :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <div class="input-group" dir="ltr">
                                            <input name="image" type="text" class="form-control" id="xImagePath" value="<?= $list['image']; ?>"/>
                                            <span class="input-group-btn">
                        <input class="btn  btn-info" type="button" value="انتخاب فایل" onclick="BrowseServer( 'Images:/', 'xImagePath' );"/>
                      </span>
                                        </div>
                                        <div id="preview" style="display:none">
                                            <strong>Selected Thumbnails</strong><br/>
                                            <div id="thumbnails"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="date">تاریخ :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control date" name="date"
                                               id="date"
                                               value="<?= $list['date'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="edit"/>
                                        <input name="News_id" type="hidden" id="News_id" value="<?= $list['News_id'] ?>"/>
                                        <i class="fa fa-plus"></i> ویرایش
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
</div>



<script>
    //------>state Change
    $(document).ready(function () {
        var $body = $('body'),
            windowWidth = $(window).width(),
            windowHeight = $(window).height(),
            $toggleSideBar = $('#toggleSideBar'),
            $datePicker = $('.date'),
            $sideBar = $('.side-left');

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

        /* ------ Responsive Menu ------*/
        $toggleSideBar.bind('click', function () {
            $sideBar.toggleClass('active');
        });
    });
</script>