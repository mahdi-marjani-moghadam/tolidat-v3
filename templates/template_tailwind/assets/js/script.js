/**
 * Created by omidkh on 2/9/2016 AD.
 */
var $body = $('body');
$(document).ready(function () {
    var $toggleNav = $('#toggleNav'),
        $navbarCollapse = $('.container.mainLink .navbar .navbar-collapse'),
        width = $(window).width(),
        height = $(window).height(),
        $searchParam = $body.find('#searchParam'),
        $validationForm = $('form[data-toggle="validator"]'),
        $menucompany = $('.menucompany'),
        $tabMenu = $('.tab .tabMenu'),
        $tab = $('.tab .menucompany .angle-up-arrow'),
        $updateAllowedCat = $('.updateAllowedCat'),
        $selectedCat = $body.find('.selectedCategories'),
        baseURL = $('#BASE_URL').data('url'),
        $datePicker = $('.datePicker'),
        $pageType = $('#page_type'),
        url = window.location.href,
        $modalWiki = $body.find('#myModal1'),
        result,
        $url = $(location).attr('href'),
        parts = $url.split("/"),
        last_part = parts[parts.length - 1],
        $quickSearchContainer = $('.quick-search-container'),
        $toDoSearch =$('#toDoSearch'),
        $boardList = $('.board-list'),
        $plusAngleUpArrow = $('.plus .angle-up-arrow'),
        $tabProfileBtn =  $('.tabProfile .navbar-header button'),
        $tabProfileDro = $('.tabProfile .dropdown'),
        $tabProfileNav = $('.tabProfile .navbar-collapse'),
        $q = $('#q'),
        $categoryContainerHeaderHamburgerIcon = $('#categoryContainer header .hamburgerIcon'),
        $categoryContainerCity = $('#categoryContainer .City'),
        $mmenuHolder1 = $('.mmenuHolder1'),
        $angleUpArrow = $('.angle-up-arrow'),
        $mmenuHolder = $('.mmenuHolder'),
        $notifications = $('.notifications'),
        $profile = $('.profile'),
        $conIconProDropdownAngle = $('.con-icon-pro .dropdown .angle'),
        $tabProfileDropdownMenu = $('.tabProfile .dropdown-menu'),
        $productGridView = $('.container-product-Grouping').find('.productList-grid'),
        $productListView = $('.container-product-Grouping').find('.productList-list'),
        $tabProfile = $('.tabProfile');

    if ($tabProfile.length) {
        try {
            $('#' + last_part).children('a').addClass('is-active');
        } catch(e) {}
    }
    //end color profile header

    // if ($body.find('.lazy').length) {
    //     try {
    //         $('.lazy').lazy({
    //             placeholder: baseURL + 'templates/template_tailwind/assets/images/placeholder.png',
    //             visibleOnly: true,
    //             onError: function (element) {
    //                 element.attr('src', baseURL + 'templates/template_tailwind/assets/images/placeholder.png');
    //             }
    //         });
    //     } catch(e) {}
    // }

    // $('.carousel-vertical, .carousel-slick, .Manufacturers').on('lazyLoadError', function(event, slick, image){
    //     image.attr('src', baseURL + 'templates/template_tailwind/assets/images/placeholder.png');
    // });

    try {
        result = getCleanUrl(url);
        if (result.params !== undefined && result.params.id !== undefined && result.params.id !== '') {
            if ($body.find('#myModal1').length) {
                $modalWiki.modal('show');
            }
        }
    } catch (error) {}

    function getCleanUrl(hash) {
        var pathTmp = hash.split('/'),
            url = '',
            params,
            paramsItems = '{',
            result = {pageTitle: '', url: '', params: {id: ''}};

        // remove useless data from path
        pathTmp = pathTmp.filter(function (el) {
            return el !== "#" && el !== '';
        });

        $.each(pathTmp, function (i, v) {
            if (v.indexOf('=') !== -1) {
                var paramsTmp = v.split('&');

                $.each(paramsTmp, function (j, k) {
                    var paramsItemTmp = k.split('=');

                    paramsItems += '"' + paramsItemTmp[0] + '" : "' + paramsItemTmp[1] + '",';
                });

                paramsItems = paramsItems.slice(0, -1);
                paramsItems += "}";
                params = JSON.parse(paramsItems);
            } else {
                url += v + '/';
            }
        });

        result.pageTitle = (pathTmp[0] !== undefined ? pathTmp[0] + ' | ' : '') + "سایت اجتماعی تولیدات";
        result.url = url;
        result.params = params;

        return result;
    }


    $('.search').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $quickSearchContainer.removeClass('active');
            $boardList.removeClass('active');

            $toDoSearch.parent().removeClass('typing');
            $toDoSearch.blur();
        }
        else {
            $(this).addClass('active');
            $quickSearchContainer.addClass('active');
            $boardList.addClass('active');

            $toDoSearch.parent().addClass('typing');
            $toDoSearch.focus();
        }
    });

    $quickSearchContainer.on('click', function (e) {
        e.stopPropagation();
    });

    // $('.avatar-save').on("click", function (e) {
    //     e.stopPropagation();
    //     var $modalAvatarFade = $('.modal.avatar.fade'),
    //         $modalOverlayModalBackdrop = $('.modal-overlay .modal-backdrop');

    //     if ($(this).hasClass('active')) {
    //         $modalAvatarFade.addClass('in');
    //         $(this).removeClass('active');
    //         $modalOverlayModalBackdrop.addClass('in')
    //     }

    //     else {
    //         $(this).addClass('active');
    //         $modalAvatarFade.removeClass('in');
    //         $modalOverlayModalBackdrop.removeClass('in')
    //     }
    // });

    /*if (width < 992) {
        $cdDropdown.removeClass('dropdown-is-active');
    }*/

    $('.select2').each(function () {
        var $placeholder = $(this).attr('data-placeholder');

        $(this).select2({
            placeholder: $placeholder,
            allowClear: false
        });
    });

    /*floating label*/
    $body.find('input, textarea, select').each(function () {
        if ($(this).val() !== null && $(this).val().length !== 0) {
            $(this).parent().addClass('typing');
        }

        if ($(this).attr('required')) {
            $(this).attr('autocomplete', 'off');
        }

        if($(this).prop('tagName') !== undefined && $(this).prop('tagName') === 'SELECT') {
            $(this).parents('.form-group').addClass('typing');
        }
    });


    // $body.on('focus keypress change', 'input, textarea', function () {
    //     $(this).parent().addClass('typing');
    // });

    // $body.on('blur', 'input, textarea', function () {
    //     $(this).parent().removeClass('typing');

    //     if ($(this).val().length !== 0) {
    //         $(this).parent().addClass('typing');
    //     }
    // });

    var timer = setInterval(function () {

        $('.filter-category nav.menu').each(function () {
            if ($(this).hasClass('mm-menu')) {
                $(this).parent().parent().find('.overlay-click').remove();
                $('.search-box .menu.mm-opened ul').css('overflow', 'initial');

                clearInterval(timer);
            }
        });
        $('.new-manufacturers').css({
            'overflow' : 'visible',
            'height' : 'initial'
        });

        $('.boxContainer .content1').css({
            'overflow' : 'visible',
            'height' : 'initial'
        });
    }, 500);

    //menu
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
            })
    });

    $('.key-index .mm-search').addClass('mmenu-index-container');
    $('.key-search .mm-search').addClass('mmenu-search-container');
    $('.key-product .mm-search').addClass('mmenu-product-container');

    function setCookie(key, value) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString() + '; path=/';
    }

    function getCookie(key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    }


    var  $cookieP = $('.cookieP');
    $cookieP.on('click', function() {
        var dataId = $(this).data("branchid");
        setCookie('test',dataId);
    });

    $('.nav-tabs .branchName').each(function (i,v) {
        var Id = $(this).find('a').data("id");
        if(Id==getCookie("test")){
            $('.nav-tabs .branchName').removeClass('active');
            $(this).addClass('active');
            setCookie('test','');
        }
    });

    // $('.mm-search input')
    //     .addClass('keyboard')
    //     .after('<img class="icon hidden-xs hidden-sm" src="/templates/template_tailwind/assets/images/keyboard.png">');
    //end of mmenu

    //on screen keyboard
    if (width > 992) {
        try {
            // Typing Extension
            $body.on('click', '.icon', function () {
                if(getCookie('has_keyboard') === 'yes') {
                    $('.keyboard').keyboard({
                        layout: 'ms-Persian',
                        initialFocus: true,
                        autoAccept: true,
                        tabNavigation: true,
                        usePreview: false,
                        rtl: true,
                        language: "fa",
                        openOn: '',
                        appendLocally: true,
                        hidden: function (event, k, el) {
                            var keyboard = $('.keyboard').keyboard().getkeyboard();
                            keyboard.destroy();
                        }
                    });

                    var kb = $(this).prev().getkeyboard();

                    // typeIn( text, delay, callback );
                    kb.reveal();

                    $('.ui-keyboard').addClass('hidden-xs').addClass('hidden-sm');
                } else {
                    if(confirm('آیا برای جستجو نیازمند صفحه کلید مجازی هستید؟\n لطغا بعد از بارگذاری مجدد، از صفحه کلید استفاده نمایید.')) {
                        setCookie('has_keyboard', 'yes');
                        window.location.reload();
                    }
                }
            });
        } catch(e) {}

    }
    //end of on screen keyboard    //on screen keyboard

    //filter product
    $('.product-filter button').bind('click', function () {
        $(this).find('i').toggleClass('fa-rotate-180');
    });
    //end of filter product

    //search bar
    $('.search-bar button').bind('click', function () {
        $(this).find('.fa-angle-down').toggleClass('fa-rotate-180');
    });
    //end of search bar

    //hamburger menu
    $('#js-hamburger').on("click", function (e) {
        var $plus = $('.topNav .plus');
        if ($profile && $plus.hasClass('active')) {
            $profile.removeClass('active');
            $plus.removeClass('active');
            $plusAngleUpArrow.removeClass('is-open');
        }
        e.stopPropagation();
        $(this).toggleClass('is-active');
        $('.menu-content').toggleClass("is-open");

    });

    $(".menu-content").on("click", function (e) {
        e.stopPropagation();
    });
    //end of hamburger menu

    //keyDown
    $(this).keydown(function (e) {
        var keycode = e.which ? e.which : e.keycode;

        if(e.target.type !== 'url') {
            if (keycode === 111 || keycode === 191) {
                $('.place').focus();
                return false;
            }
        }
    });
    // end of keyDown

    $tabProfileBtn.click(function (e) {
        e.stopPropagation();
        if ($tabProfileDro.hasClass('active')) {
            $tabProfileDro.removeClass('active');
        }

        if ($tabProfileDropdownMenu.css('display', 'block')) {
            $tabProfileDropdownMenu.css('display', 'none');
        }

        if ($conIconProDropdownAngle.hasClass('fa-rotate-180')) {
            $conIconProDropdownAngle.removeClass('fa-rotate-180');
        }

        var $click = $('.click');
        if ($notifications && $click.hasClass('active')) {
            $notifications.removeClass('active');
            $click.removeClass('active');
        }
        if ($(this).hasClass('collapsed')) {
            $(this).removeClass('collapsed');
            $tabProfileNav.addClass('in');
        } else {
            $(this).addClass('collapsed');
            $tabProfileNav.removeClass('in');
        }
    });

    $body.on('click', function () {
        // remove active of kebab menu
        $('.kebab-menu-content').removeClass('active');

        //hamburger menu
        var menuHolder = $('.menu-content.is-open');
        if (menuHolder.hasClass('is-open')) {
            menuHolder.removeClass('is-open');
        }

        var quickSearchHolder = $('.quick-search-container.active');
        if (quickSearchHolder.hasClass('active')) {
            quickSearchHolder.removeClass('active');
            $('.search.active').removeClass('active');
            $('.board-list.active').removeClass('active');
        }

        var hamburgerHolder = $('.hamburger.is-active');
        if (hamburgerHolder.hasClass('is-active')) {
            hamburgerHolder.removeClass('is-active');
        }

        $tabProfileBtn.addClass('collapsed');

        $tabProfileNav.removeClass('in');

        var $plus = $('.topNav .plus');

        if ($profile && $plus.hasClass('active')) {
            $profile.removeClass('active');
            $plus.removeClass('active');
            $plusAngleUpArrow.removeClass('is-open');
        }

        var $click = $('.click');
        if ($notifications && $click.hasClass('active')) {
            $notifications.removeClass('active');
            $click.removeClass('active');
        }

        var $tabProfile = $('.tabProfile .dropdown ');

        if ($tabProfile.hasClass('active')) {
            $tabProfile.removeClass('active');
            $tabProfileDropdownMenu.css('display', 'none');
            $conIconProDropdownAngle.removeClass('fa-rotate-180');
        }

        if ($('.product-filter .btn-group').hasClass('open')) {
            $('.product-filter .btn-group i').removeClass('fa-rotate-180');
        }

        if ($('.search-bar .btn-group').hasClass('open')) {
            $('.search-bar .btn-group i').removeClass('fa-rotate-180');
        }
    });

    $('.dir-ltr ul li a').click(function () {
        $('.phoneType').attr('data-value', $(this).attr('data-value'));
        $('#id-phone').prop('placeholder', $(this).attr('data-value'));
    });

    $('.container-location-city, .loginBtnContainer , .city-list').bind('click', function (e) {
        e.stopPropagation();
    });

    $('.showSort').click(function (e) {
        e.preventDefault();
        var $find = $(this).find('i');
        if ($find.hasClass('fa-sort-amount-asc')) {
            $find.removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc')
        }
        else {
            $find.addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc')
        }
    });

    $body.on('click', '.contentPro-cert-modal', function (e) {
        e.preventDefault();
        $(this).toggleClass('checked');
    });

    //package js
    $body.on('click', '.container-register .cart a ', function (e) {
        e.preventDefault();
        var idCart = $(this).data("id");
        $('.pricing-grid').removeClass("checked1");
        $(this).parents('.pricing-grid').addClass("checked1");
        $('.packageType').val(idCart);
    });

    $('.City').click(function (e) {
        e.preventDefault();

        var $cityName =  $('.city-name');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $cityName.removeClass('active')
        }
        else {
            $(this).addClass('active');
            $cityName.addClass('active')
        }
    });

    $body.on('mouseover', '.contentPro', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    try {
        $('[data-toggle="tooltip"]').tooltip();
    } catch(e) {}

    var mainPage = $('.mainPage');
    if (mainPage.length) {
        $('#categoryContainer').addClass('active');
    }

    $(window).scroll(function () {


        var $widthPosition = $('.width-position').width(),
            $header1 = $('header.pageHeader'),
            $posfix = $('.position-fix');

        $posfix.width($widthPosition);

        if ($(this).scrollTop() > 120) {
            $posfix.addClass("stick");
            $header1.addClass("sticky");
        }

        else if ($(this).scrollTop() < 210) {
            $posfix.removeClass("stick");
            $header1.removeClass("sticky");
        }
    });

    $('#myTabs').find('a').click(function (e) {
        e.preventDefault();
        $(this).tab('show')
    });

    $body.on('submit', '#searchParam', function (e) {
        console.log(111111);
        e.preventDefault();
        submit_search();
    });

    // search function
    function submit_search(id, searchType) {
        
        var question = $q.val(),
            type = $("#type").val(),
            address_search = $searchParam.attr("action"),
            final_address = baseURL + 'search/type/' + type;

        if(searchType === 1) {
            final_address += '/category/'+id;
        } else {
            if (question.length > 0) {
                final_address += '/q/' + question;
            }
        }

        window.location.href = final_address;
    }

    $q.on('keypress', function (e) {
        var keyCode = e.which ? e.which : e.keycode;

        if (keyCode === 13) {
            submit_search();
        }
    })
        .focus(function () {
            $(this).parents('.search-wrap').addClass('active');
        })
        .blur(function () {
            $(this).parents('.search-wrap').removeClass('active');
        });


        

    $toggleNav.bind('click', function () {
        var self = $(this),
            $mainLinks = $('.pageHeader .container.mainLink .navbar .navbar-nav>li');

        self.toggleClass('active');
        $body.toggleClass('fixed');
        $navbarCollapse.fadeToggle("fast");
        $navbarCollapse.toggleClass('in');

        if (self.hasClass('active')) {
            var speed = 1000;
            $mainLinks.each(function () {
                $(this).stop().slideDown(speed);
                speed += 400;
            });
        } else {
            $mainLinks.each(function () {
                $(this).stop().slideUp(10);
            });
        }
    });

    $categoryContainerHeaderHamburgerIcon.bind('click', function () {
        var self = $(this);

        if (self.hasClass('active')) {
            self.removeClass('active');
            $mmenuHolder.removeClass('active');
        } else {
            $mmenuHolder1.removeClass('active');
            $angleUpArrow.removeClass('is-open');
            $categoryContainerCity.removeClass('active');
            self.addClass('active');
            $mmenuHolder.addClass('active');
        }
    });

    $categoryContainerCity.bind('click', function () {

        $mmenuHolder1.slideToggle('fast');
        var self = $(this);

        if (self.hasClass('active')) {
            self.removeClass('active');
            $mmenuHolder1.removeClass('active');

            $angleUpArrow.removeClass("is-open");
        } else {
            self.addClass('active');
            $categoryContainerHeaderHamburgerIcon.removeClass('active');
            $mmenuHolder1.addClass('active');

            $mmenuHolder.removeClass('active');
            $angleUpArrow.addClass("is-open");
        }
    });

    $body.on('keypress', '.onlyNum', function (e) {
        var self = $(this),
            key = e.which ? e.which : e.keyCode;

        return !!((key > 47 && key < 58) || (key > 1775 && key < 1786) ||
        (key == 37 || key == 38 || key == 39 || key == 40 || key == 9 || key == 16 || key == 17 || key == 8));
    });

    $('.searchContainer a').bind('click', function (e) {
        e.preventDefault();
        var $searchContainer = $body.find('#searchContainer');

        if ($searchContainer.length && !$searchContainer.hasClass('hideSearch')) {

            $('html, body').animate({
                    scrollTop: $searchContainer.offset().top - 120
                },
                'slow',
                function () {
                    $("#searchContainer").find("#q").focus();
                });

        } else {
            var middleWidth = width / 2,
                middleHeight = parseInt(height / 3),
                searchWidth = parseInt($body.find('#searchContainer').width() / 2),
                searchHeight = parseInt($body.find('#searchContainer').height() / 2),
                totalWidth = middleWidth - searchWidth,
                totalHeight = middleHeight - searchHeight;

            $body.toggleClass('fixed');

            if (!$body.find('.overlay').length) {
                $('<div class="overlay transition"></div>').prependTo($body);
            }

            if ($('.overlay').is(":visible")) {
                $('.overlay').fadeOut(400);
            } else {
                $('.overlay').fadeIn(100);
            }

            $searchContainer.css('left', totalWidth + 'px');
            if ($searchContainer.hasClass('active')) {
                $searchContainer.removeClass('active');
                $searchContainer.css('top', '-100%');
            } else {
                $searchContainer.addClass('active');
                $searchContainer.css('top', totalHeight + 'px');
            }
        }
    });


    if ($datePicker.length) {
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
                // maxDate:new persianDatepicker().unix(),
                selectableYears: [1410, 1409, 1408, 1407, 1406, 1405, 1404, 1403, 1402, 1401, 1400, 1399, 1398, 1397, 1396, 1395, 1394, 1393, 1392, 1391, 1390, 1389, 1388, 1387, 1386, 1385, 1384, 1383, 1382, 1381, 1380, 1379, 1378, 1377, 1376, 1375, 1374, 1373, 1372, 1371, 1370, 1369, 1368, 1367, 1366, 1365, 1364, 1363, 1362, 1361, 1360, 1359, 1358, 1357, 1356, 1355, 1354, 1353, 1352, 1351, 1350],
                onSelect: function () {
                    console.log('ali ali');
                    console.log($this);
                    console.log($this.parent());
                    console.log($this.validity);

                    // $this.prop('required',false);
                    // $this.setCustomValidity('');$this.validity;
                    $this.parent().addClass('typing');
                    $this.parent().removeClass('has-error').addClass('has-success');
                    $this.parent().find('.errorHandler').remove();
                    $this.parent().find('.requiredIcon').html('<i class="fa fa-check"></i>');
                    // $this.value.change;
                }
            });
            $this.on('change', function(ev) {
                console.log('ali ali');
                console.log(ev);
                //console.log('ali ali', $this.val());
                // $this.valid();  // triggers the validation test
                //$this.val('ali');  // triggers the validation test
               
                // '$(this)' refers to '$("#datepicker")'
            });
        });


        $body.find('.pdp-default').each(function (index) {
            $(this).insertBefore('.datePicker:eq(' + index + ')');
        });
    }

    $body.find('input[required], textarea[required]').each(function () {
        $(this).parent('.form-group').append('<span class="requiredIcon">*</span>');
    });

    $body.on('click', '.overlay,#searchContainer .hamburgerMenu', function () {
        $('.overlay').fadeOut(300);
        $body.find('#searchContainer').removeClass('active');
        $body.find('#searchContainer').css('top', '-100%');
        $body.removeClass('fixed');
    });

    // if ($validationForm.length) {
    //     $validationForm.validator().on('submit', function (e) {
    //         var $field = $(e.relatedTarget);

    //         if (e.isDefaultPrevented()) {
    //             $field.parents('.form-group').append('<div class="errorHandler">' + $field.data("error") + '</div>');
    //             $field.parents('.form-group').removeClass('has-success').addClass('has-error');
    //             $field.parents('.form-group').find('.requiredIcon').html('<i class="fa fa-check"></i>')
    //         } else {
    //             return true;
    //         }
    //     }).on('valid.bs.validator', function (e) {
    //         var $field = $(e.relatedTarget);

    //         $field.parents('.form-group').find('.errorHandler').remove();
    //         $field.parents('.form-group').removeClass('has-error').addClass('has-success');
    //         $field.parents('.form-group').find('.requiredIcon').html('<i class="fa fa-check"></i>')
    //     }).on('invalid.bs.validator', function (e) {
    //         var $field = $(e.relatedTarget);

    //         $field.parents('.form-group').append('<div class="errorHandler">' + $field.data("error") + '</div>');
    //         $field.parents('.form-group').removeClass('has-success').addClass('has-error');
    //         $field.parents('.form-group').find('.requiredIcon').html('*')
    //     });
    // }

    //scroll on detailCompany
    function smk_jump_to_it(_selector, _speed)  {
        _speed = parseInt(_speed, 10) === _speed ? _speed : 300;
        $(_selector).on('click', function (event) {
            try {
                if ($body.scrollTop() < 125) {}

                var offset = 0;

                if (width < 1200) {
                    offset = 120;
                }
                else {
                    offset = 140;
                }

                event.preventDefault();
                //return false;
                $('.link_classname').removeClass('active');
                $menucompany.removeClass('active');
                $tabMenu.removeClass('active');
                $tab.removeClass('is-open');
                $(this).addClass('active');
                var url = $(this).find('a').attr('href'); //cache the url.
                // Animate the jump

                $("html, body").animate({
                    scrollTop: parseInt($(url).offset().top) - offset
                }, _speed);
            } catch (error) {
            }
        });
    }

    // Cache selectors
    /*var lastId,
     topMenu = $(".tabMenu"),
     topMenuHeight = topMenu.outerHeight() + 100,
     // All list items
     menuItems = topMenu.find("a"),
     // Anchors corresponding to menu items
     scrollItems = menuItems.map(function () {
     var item = $($(this).attr("href"));
     if (item.length) {
     return item;
     }
     });

     smk_jump_to_it('.link_classname', 700);

     // Bind to scroll
     $(window).scroll(function () {
     // Get container scroll position
     var fromTop = $(this).scrollTop() + topMenuHeight;

     // Get id of current scroll item
     var cur = scrollItems.map(function () {
     if ($(this).offset().top < fromTop)
     return this;
     });
     // Get the id of the current element
     cur = cur[cur.length - 1];
     var id = cur && cur.length ? cur[0].id : "";

     if (lastId !== id) {
     lastId = id;
     // Set/remove active class
     menuItems
     .parent().removeClass("active")
     .end().filter("[href='#" + id + "']").parent().addClass("active");
     }
     });*/
    //end of scroll on detailCompany

    //tabMenu detailCompany
    $menucompany.bind('click', function () {
        var self = $(this);
        if (self.hasClass('active')) {
            self.removeClass('active');
            $tabMenu.removeClass('active');
            $tab.removeClass('is-open');
        } else {
            self.addClass('active');
            $tabMenu.addClass('active');
            $tab.addClass('is-open');
        }
    });

    $('.click').click(function (e) {
        e.stopPropagation();
        if ($tabProfileDro.hasClass('active')) {
            $tabProfileDro.removeClass('active');
        }

        if ($tabProfileDropdownMenu.css('display', 'block')) {
            $tabProfileDropdownMenu.css('display', 'none');
        }

        if ($conIconProDropdownAngle.hasClass('fa-rotate-180')) {
            $conIconProDropdownAngle.removeClass('fa-rotate-180');
        }

        if (!$tabProfileBtn.hasClass('collapsed')) {
            $tabProfileBtn.addClass('collapsed');
        }

        if ($tabProfileNav.hasClass('in')) {
            $tabProfileNav.removeClass('in');
        }

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $notifications.removeClass('active');
        }
        else {
            $(this).addClass('active');
            $notifications.addClass('active');
        }
    });

    $notifications.on("click", function (e) {
        e.stopPropagation();
    });

    $(".navbar-collapse").on("click", function (e) {
        e.stopPropagation();
    });

    function preview(input) {

        var img = $(input).parent().prev('img');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".uploadFile").change(function () {
        var img = $(this).parent().prev('img');

        img.css({top: 0, left: 0});
        preview(this);
        // img.draggable({containment: 'parent', scroll: false});
    });

    $('.topNav .plus').click(function (e) {
        e.stopPropagation();
        var menuHolder = $('.menu-content.is-open');

        if (menuHolder.hasClass('is-open')) {
            menuHolder.removeClass('is-open');
        }

        var hamburgerHolder = $('.hamburger.is-active');
        if (hamburgerHolder.hasClass('is-active')) {
            hamburgerHolder.removeClass('is-active');
        }

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $profile.removeClass('active');
            $plusAngleUpArrow.removeClass('is-open');
        }

        else {
            $(this).addClass('active');
            $profile.addClass('active');
            $plusAngleUpArrow.addClass('is-open');
        }
    });

    $profile.on("click", function (e) {
        e.stopPropagation();
    });

    $tabProfileDro.click(function (e) {
        e.stopPropagation();

        var click = $('.click');

        if (click && $notifications.hasClass('active')) {
            click.removeClass('active');
            $notifications.removeClass('active');
        }

        if (!$tabProfileBtn.hasClass('collapsed')) {
            $tabProfileBtn.addClass('collapsed');
        }

        if ($tabProfileNav.hasClass('in')) {
            $tabProfileNav.removeClass('in');
        }

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $conIconProDropdownAngle.removeClass('fa-rotate-180');
            $tabProfileDropdownMenu.css('display', 'none');
        }
        else {
            $(this).addClass('active');
            $conIconProDropdownAngle.addClass('fa-rotate-180');
            $tabProfileDropdownMenu.css('display', 'block');
        }
    });

    $(".tabProfile .dropdown-menu").on("click", function (e) {
        e.stopPropagation();
    });

    $body.on('click', '.kebabMenu a', function (e) {
        e.stopPropagation();
        //e.preventDefault();

        $body.find('.kebabMenu a').removeClass('active');
        $body.find('.kebabMenu a').next().removeClass('active');

        if ( $(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).next().removeClass('active');
        }

        else {
            $(this).addClass('active');
            $(this).next().addClass('active');
        }
    });

    /*$body.on('click', function (e) {
     e.stopPropagation();

     $('.kebabMenu a').removeClass('active');
     $('.kebabMenu a').next().removeClass('active');
     });*/

    try {
        $('[data-toggle="popover"]').popover();
    } catch(e) {}

    // $('.registerPage .content input').on("focus", function () {
    //     $(this).next().remove();
    // });

    $(".successClick").click(function () {
        var $activeLink = $('.active-link');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $activeLink.removeClass('active');
        }
        else {
            $(this).addClass('active');
            $activeLink.addClass('active');
            $('.login-edit form').addClass('active');
        }
    });

    
    // register step 5
    // select category 
    var selectedCatArr = [];
    $.fillSelectedCategories = function($obj) {
        var $maxCanSelectedInput = $body.find('.maxCanSelected'),
            $maxCanSelectedNum = parseInt($maxCanSelectedInput.val()),
            $categoryContainer = $obj.container !== undefined ? $obj.container.find('.container-view') : $body.find('.container-view');

        if ($obj.mustEmptyArr !== undefined && $obj.mustEmptyArr === true) {
            selectedCatArr = [];
        }

        // fill category container with click on each item in menu
        if ($obj.el !== undefined && $obj.val !== undefined) {
            var iziParentModal;
            if( $obj.el.parents('.modal').length) {
                iziParentModal = '.' + $obj.el.parents('.modal').find('.izi-holder').data('izi');
            }

            var itemName = $obj.el.parent().text(),
                htmlItem = '<li data-id="' + $obj.val + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + itemName + '</li>';

            if ($obj.el.is(':checked')) {

                if (selectedCatArr.length < $maxCanSelectedNum) {
                    $categoryContainer.find('.selected-category').append(htmlItem);

                    selectedCatArr.push($obj.val);
                } else {
                    if (iziParentModal !== undefined) {
                        $.iziToastError('ماکسیمم دسته بندی مجاز انتخاب شده است<br> ابتدا یکی از دسته بندی های انتخاب شده را حذف کرده سپس گزینه جدید را اضافه نمایید', iziParentModal);
                    } else {
                        $.iziToastError('ماکسیمم دسته بندی مجاز انتخاب شده است<br> ابتدا یکی از دسته بندی های انتخاب شده را حذف کرده سپس گزینه جدید را اضافه نمایید', '.izi-container');
                    }

                    $obj.el.prop('checked', false);
                }

            } else {

                $categoryContainer.find('.selected-category li[data-id="' + $obj.val + '"]').remove();

                var i = selectedCatArr.indexOf($obj.val);
                if (i !== -1) {
                    selectedCatArr.splice(i, 1);
                }

            }
        }
        // fill category from page loading OR ajax in wiki
        else {
            selectedCatArr = [];

            $categoryContainer.find('ul').html('');

            if($obj.container !== undefined) {
                $obj.container.find('.mm-panels input[type="checkbox"]:checked').each(function () {
                    var itemVal = $(this).val(),
                        itemName = $(this).parent().text(),
                        htmlItem = '<li data-id="' + itemVal + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + itemName + '</li>';

                    if (selectedCatArr.length <= $maxCanSelectedNum) {
                        if (itemVal.length) {
                            selectedCatArr.push(itemVal);

                            $categoryContainer.find('.selected-category').append(htmlItem);
                        }
                    }
                });

                $obj.container.find('.mm-listview input[type="checkbox"]').on('change', function () {
                    var $this = $(this),
                        itemVal = $this.val();

                    var $newObj = {
                        el: $this,
                        val: itemVal,
                        container: $obj.container
                    };

                    $.fillSelectedCategories($newObj);
                });
            } else {
                $('.mm-listview input[type="checkbox"]:checked').each(function () {
                    var itemVal = $(this).val(),
                        itemName = $(this).parent().text(),
                        htmlItem = '<li data-id="' + itemVal + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + itemName + '</li>';

                    if (selectedCatArr.length <= $maxCanSelectedNum) {
                        if (itemVal.length) {
                            selectedCatArr.push(itemVal);

                            $categoryContainer.find('.selected-category').append(htmlItem);
                        }
                    }
                });
            }
        }

        $updateAllowedCat.html($categoryContainer.find('.selected-category li').length);

        selectedCatToInput();
    };

    // if isn't search page
    if (!($pageType.length === 1 && $pageType.val() === 'searchPage')) {
        $body.on('change', '.mm-listview input[type="checkbox"]', function () {
            var $this = $(this),
                itemVal = $this.val();

            var $obj = {
                el: $this,
                val: itemVal
            };

            $.fillSelectedCategories($obj);
        });
    }

    $body.on('click', '.removeCatSelected', function (e) {
        e.preventDefault();

        var itemVal = parseInt($(this).parent().data('id'));

        var i = selectedCatArr.indexOf(itemVal);
        if (i !== -1) {
            selectedCatArr.splice(i, 1);
        }

        $('.mm-listview input[value="'+itemVal+'"]').prop('checked', false).trigger('change');

        $updateAllowedCat.html(selectedCatArr.length);

        selectedCatToInput();
    });

    function selectedCatToInput() {
        $selectedCat.val(selectedCatArr.join(','));
    }

    // Back to top
    $(window).scroll(function () {
        var $scTop = $(this).scrollTop(),
            backTOP = $('.back-to-top');

        if ($scTop > 80) {
            backTOP.fadeIn();
            backTOP.addClass('scrol');
        } else {
            backTOP.fadeOut();
            backTOP.removeClass('scrol');
            //hide up button
        }
    });

    $('.dmtop').click(function () {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

    $('.has-children .item-search').click(function () {
        $boardList.animate({scrollTop: '0px'}, 100);
        return false;
    });

    $('img').on('error', function () {
        $(this).attr('src', baseURL + 'templates/template_tailwind/assets/images/placeholder.png');

        if($(this).hasClass('image-banner')) {
            $(this).attr('src', baseURL + 'templates/template_tailwind/assets/images/placeholder1.png');
        }
    });

    $(window).resize(function () {
        $('.item-search').hover(function () {
            $(this).css({
                backgroundColor: '#f5f5f5'
            });
            $(this).parent().prev('.title-search').find('a').css({
                backgroundColor: '#f5f5f5'
            });
        }, function () {
            $(this).css({
                backgroundColor: '#fff'
            });
            $(this).parent().prev('.title-search').find('a').css({
                backgroundColor: '#fff'
            });
        });
    });

    $('.filter-category .categoryContainer label').on('click', function () {
        var $overlay = '' +
                '<div class="overlay-click">' +
                '<span> لطفا منتظر بمانید...</span>' +
                '<div class="sk-circle">' +
                '<div class="sk-circle1 sk-child"></div>' +
                '<div class="sk-circle2 sk-child"></div>' +
                '<div class="sk-circle3 sk-child"></div>' +
                '<div class="sk-circle4 sk-child"></div>' +
                '<div class="sk-circle5 sk-child"></div>' +
                '<div class="sk-circle6 sk-child"></div>' +
                '<div class="sk-circle7 sk-child"></div>' +
                '<div class="sk-circle8 sk-child"></div>' +
                '<div class="sk-circle9 sk-child"></div>' +
                '<div class="sk-circle10 sk-child"></div>' +
                '<div class="sk-circle11 sk-child"></div>' +
                '<div class="sk-circle12 sk-child"></div>' +
                '</div>' +
                '</div>',
            $category = $(this).parents('.categoryContainer');
        $category.prepend($overlay);
    });

    // show circular progressive in selecor
    $.circularProgressive = function (selector, width, height, thickness, textColor) {
        $body.find(selector).each(function () {
            var progressNum = $(this).val(),
                color = '';

            switch (true) {
                case (progressNum >= 0 && progressNum <= 20) :
                    color = '#f00';
                    break;

                case (progressNum > 20 && progressNum <= 40) :
                    color = '#ff7514';
                    break;

                case (progressNum > 40 && progressNum <= 60) :
                    color = '#ffc214';
                    break;

                case (progressNum > 60 && progressNum <= 80) :
                    color = '#95ff00';
                    break;

                case (progressNum > 80 && progressNum <= 100) :
                    color = '#15c160';
                    break;
            }
            $(this).knob({
                'readOnly': true,
                'width': width,
                'height': height,
                'thickness': thickness,
                'fgColor': color,
                'inputColor': textColor,
                'bgColor': 'transparent'
            });
        });
    };

    $.circularProgressive('.dial', 100, 100, 0.1, '#000');

    $('.title-search a').hover(function () {
        $(this).parent().next().find('.cd-secondary-dropdown').addClass('is-active');
    }, function () {
        $(this).parent().next().find('.cd-secondary-dropdown').removeClass('is-active');
    });


    /*    setInterval(function() {*/
    if (width < 992) {
        $('.item-search').hover(function () {
            $(this).parent().prev('.title-search').find('a').css({
                backgroundColor: '#f5f5f5'
            });
            $(this).css({
                backgroundColor: '#f5f5f5'
            });

        }, function () {
            $(this).parent().prev('.title-search').find('a').css({
                backgroundColor: '#fff'
            });
            $(this).css({
                backgroundColor: '#fff'
            });
        });
    }
    /*    }, 50);*/


    var timer = setInterval(function () {
        var slick = $('#slider').width();
        var slick2 = $('.container-slider').height();
        $('.cd-secondary-dropdown').height(slick2 + 1);
        $('.cd-secondary-dropdown').width(slick + 30);
    }, 50);

    setInterval(function () {
        if ($('.auto-complete-list').length) {

            $('.auto-complete-list').css({
                width: $q.width() + 3,
                left: $q.offset().left,
                top: $q.offset().top + $q.height() + 2
            })
        }
    }, 500);

    $body.on('click', '.auto-complete-list-rollover', function (e) {
        var text = $(this).text(),
            id = $(this).data('id'),
            type = $(this).data('type');

        $q.val(text);

        submit_search(id, type);
    });

    $body.on('keyup', '#q', function (e) {
        if (e.keyCode === 13) {
            if ($('.auto-complete-list-rollover').text() == $(this).val()) {
                submit_search();
            }
        }
    });

    $body.on('keyup', '#toDoSearch', function () {
        var $list = $body.find('.board-list'),
            value = $(this).val().toLowerCase();
        if (value !== '') {
            $list.find('.title-search').each(function () {
                if ($(this).find('a').text().toLowerCase().indexOf(value) > -1) {
                    $(this).stop().fadeIn(200);
                    $(this).next('.has-children').stop().fadeIn(200);
                } else {
                    $(this).stop().fadeOut(200);
                    $(this).next('.has-children').stop().fadeOut(200);
                }
            });
        } else {
            $list.find('.title-search').stop().fadeIn(200);
            $list.find('.title-search+.has-children').stop().fadeIn(200);
        }
    });

    $body.on('keyup', '#toDoSearch1', function () {
        var $list = $body.find('.board-list1'),
            value = $(this).val().toLowerCase();

        if (value !== '') {
            $list.find('.newsColumn').each(function () {
                if ($(this).find('h4').text().toLowerCase().indexOf(value) > -1) {
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }
            });
        } else {
            $list.find('.newsColumn').removeClass('active');
        }
    });

    if ($body.find('.img-cropper').length){
        var $dataX = $('#dataX');
        var $dataY = $('#dataY');
        var $dataHeight = $('#dataHeight');
        var $dataWidth = $('#dataWidth');
        var $dataRotate = $('#dataRotate');
        var $dataScaleX = $('#dataScaleX');
        var $dataScaleY = $('#dataScaleY');

        if(!$('.register-crop').length) {
            $('.image-crop').cropper({
                minContainerWidth: 415,
                minContainerHeight: 250,
                viewMode: 2
            });
        }

        var cropper,
            options,
            lastImg;
        $('#avatar-modal, #myModal-banner, #myModal1, #myModal2, #basicModal').on('shown.bs.modal', function (e) {
            lastImg = $(this).find('.img-cropper').attr('src');
        });

        function initCrop($el) {
            try {
                cropper.cropper('destroy');
            } catch (e) {}

            options = {
                restore: false,
                viewMode: 1,
                preview: '.img-preview',
                crop: function (e) {
                    $dataX.val(Math.round(e.x));
                    $dataY.val(Math.round(e.y));
                    $dataHeight.val(Math.round(e.height));
                    $dataWidth.val(Math.round(e.width));
                    $dataRotate.val(e.rotate);
                    $dataScaleX.val(e.scaleX);
                    $dataScaleY.val(e.scaleY);
                }
            };

            var $imgCrop = $el.find('.img-cropper');

            if($imgCrop.hasClass('image-crop')) {
                options.width = 250;
                options.height = 250;
                options.minContainerWidth = 250;
                options.minContainerHeight = 250;
                options.aspectRatio = 1;
            }else if($imgCrop.hasClass('image-javaz')) {
                options.width = 250;
                options.height = 250;
                options.minContainerWidth = 250;
                options.minContainerHeight = 250;
                // options.aspectRatio = 1;
            }
             else if($imgCrop.hasClass('image-banner')) {
                options.width = 1400;
                options.height = 230;
                options.aspectRatio = 6.08;
            }

            cropper = $imgCrop.cropper(options);

            try {
                cropper.on('cropend', function (e) {
                    try {
                        var result = cropper.cropper('getCroppedCanvas', {fillColor: '#fff'});

                        $el.find('.result-crop').val(result.toDataURL('image/jpeg'));
                    } catch(e) {}
                    $('.addGallery').prop( "disabled", false );
                });

                cropper.on('zoom', function (e) {
                    try {
                        var result = cropper.cropper('getCroppedCanvas', {fillColor: '#fff'});

                        $el.find('.result-crop').val(result.toDataURL('image/jpeg'));
                    } catch(e) {}
                    $('.addGallery').prop( "disabled", false );
                });

                cropper.on('ready', function (e) {
                    try {
                        var result = cropper.cropper('getCroppedCanvas', {fillColor: '#fff'});

                        $el.find('.result-crop').val(result.toDataURL('image/jpeg'));
                    } catch(e) {}
                    $('.addGallery').prop( "disabled", false );

                });
            } catch(e) {}
        }

        $('#avatar-modal, #myModal-banner, #myModal1, #myModal2, #basicModal, #modalWiki').on('show.bs.modal', function (e) {
            try {
                cropper.cropper('destroy');
            } catch(e) {}

            var last = $('.my-imgcrop-banner').attr('src');
            var last1 = $('.avatar-preview img').attr('src');
            $('#myModal-banner').find('.img-cropper').attr('src', last);
            $('#avatar-modal').find('.img-cropper').attr('src', last1);
        });

        $(".addGallery").on("click", function () {
            try {
                cropper.cropper('destroy');
            } catch(e) {}
            $body.find('#addGallery .img-cropper').attr('src', '');
            $(this).prop( "disabled", true );

        });


        $('#avatar-modal, #myModal-banner, #myModal1, #myModal2, #basicModal, #modalWiki').on('hidden.bs.modal', function (e) {
            try {
                cropper.cropper('destroy');

                $(this).find('.img-cropper').attr('src', lastImg);
            } catch(e) {}

            $body.find('.iziAdd-container, .iziEdit-container').html('');
        });

        function readURL(input, $el) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $el.attr('src', e.target.result);

                    var $modalElement = $el.parents('.modal-body');

                    initCrop($modalElement);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputImage, #inputImage-banner, #inputImageLogo, #inputImage-edit, #inputImage1, #inputImageGallery, #inputWiki").change(function () {
            var $el = $(this).parents('.modal-body').find('.img-container .img-cropper');

            readURL(this, $el);
        });
    }

    $productGridView.on("click", function (e) {
        if(!$(this).hasClass('active')) {
            $(this).addClass('active');
            $('.product-list').removeClass('list-view').addClass('grid-view');
            $productListView.removeClass('active');
        }
    });

    $productListView.on("click", function (e) {
        if(!$(this).hasClass('active')) {
            $(this).addClass('active');
            $('.product-list').addClass('list-view').removeClass('grid-view');
            $productGridView.removeClass('active');
        }
    });

    /*progressText*/

    $body.find('.progressText').each(function () {

        $(this).parent('.form-group').append('<div class="progress"> ' +
            '<div class="progress-bar bg-danger" role="progressbar" style="width: 2%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' +
            '</div>' +
            '</div>');
    });
    $body.on('keyup', '.form-group .progressText', function () {
            var $minWord = $(this).attr('data-minWord'),
                wordCountTmp = $(this).val().split(' '),
                wordCount = wordCountTmp.filter(function(v){return v!==''}).length,
                progressBar  = $(this).parent('.form-group').find('.progress-bar');

            var total = $minWord / 2;

            if(wordCount >= $minWord){
                progressBar.css('width','100%');
                cleanBtnClass(progressBar, 'bg-success')

            }
            else if(wordCount<total) {
                cleanBtnClass(progressBar, 'bg-danger');
                progressBar.css('width', '10%');
            }
            else if(wordCount==0){
                cleanBtnClass(progressBar, 'bg-danger');
                progressBar.css('width', '2%');
            }

            else {
                cleanBtnClass(progressBar, 'bg-warning');
                progressBar.css('width','50%');
            }

    });
    function cleanBtnClass($el, background) {
        $el.removeAttr('class');
        $el.addClass('progress-bar ' + background);
    }
    $('#myModal2').on('hidden.bs.modal', function (e) {
        $(this).find('input, textarea').each(function () {
            if ($(this).prop('type') !== 'hidden') {
                $(this).val('');
                $(this).parents('.form-group').removeClass('has-success').removeClass('has-error');
                $(this).parents('.form-group').find('.requiredIcon').html('*');
                $(this).parent().removeClass('typing');
            }
        });


        var progressBar = $(this).find('.progress-bar');
        cleanBtnClass(progressBar, 'bg-danger');
        progressBar.css('width', '2%');
    });

    $('#myModal1').on('shown.bs.modal', function (e) {
        $body.find('.progressText').each(function () {
            if($(this).val()!=0){
                var $minWord = $(this).attr('data-minWord'),
                    wordCountTmp = $(this).val().split(' '),
                    wordCount = wordCountTmp.filter(function(v){return v!==''}).length,
                    progressBar  = $(this).parent('.form-group').find('.progress-bar');

                var total = $minWord / 2;

                if(wordCount >= $minWord){
                    progressBar.css('width','100%');
                    cleanBtnClass(progressBar, 'bg-success')

                }
                else if(wordCount<total) {
                    cleanBtnClass(progressBar, 'bg-danger');
                    progressBar.css('width', '10%');
                }
                else if(wordCount==0){
                    cleanBtnClass(progressBar, 'bg-danger');
                    progressBar.css('width', '2%');
                }

                else {
                    cleanBtnClass(progressBar, 'bg-warning');
                    progressBar.css('width','50%');
                }

            }
        });
    });

    /* end of progressText*/

    $.httpRequest = function(url, method, data, isFormData) {
        var options = {
            url: url,
            cache: false
        };

        if(isFormData === undefined && isFormData !== false) {
            options.contentType = false;
            options.processData = false;
        }

        if(method !== "" && method !== undefined){
            options.method = method;
        }

        if(data !== "" && data !== undefined){
            options.data = data;
        }

        return $.ajax(options)
    };

    $.checkBar = function($form) {
        return new Promise(function(res, rej) {
            var cnt = 0;
            $form.find('.progressText').each(function (){
                var $color = $(this).parent().find('.progress-bar');
                if(!$color.hasClass('bg-success')){
                    cnt++;
                }
            });

            if(cnt) {
                iziToast.question({
                    title: "تعداد کلمات وارد شده برای اطلاعات فرم کافی نمی باشد و این خود موجب پایین آمدن seo صفحه شما خواهد شد،<br> آیا از ثبت اطلاعات اطمینان دارید؟",
                    close: false,
                    backgroundColor: '#FFF',
                    messageColor: 'red',
                    color: 'green',
                    icon: 'fa fa-question',
                    iconColor: 'gray',
                    rtl: true,
                    closeOnEscape: false,
                    toastOnce: true,
                    overlay: true,
                    overlayClose: true,
                    overlayColor: 'rgba(0, 0, 0, 0.6)',
                    drag: false,
                    timeout: false,
                    position: 'center',
                    buttons: [
                        ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                            return res(true);

                        }, true],
                        ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }]
                    ]
                });
            }
            else{
                return res(true);
            }
        });
    };

    $(".container-Legal .form-control").change(function() {
        var value = $(this).val();

        $('.legal').addClass('hidden');
        $('.legal[data-value="'+value+'"]').removeClass('hidden');
    });
});

$(window).on('load', function() {
    $('.enamad').html('<img class="pull-left" src="https://trustseal.enamad.ir/logo.aspx?id=72444&amp;p=i34DkJRZ8o96TE0S" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=72444&amp;p=i34DkJRZ8o96TE0S&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="i34DkJRZ8o96TE0S">')
});

$.iziToastSuccess = function (msg, container) {
    var option = {
        title: '',
        color: 'green',
        titleColor: 'white',
        messageColor: 'white',
        icon: 'fa fa-check',
        backgroundColor: '#33a84f',
        iconColor: '#97f497',
        rtl: true,
        position: 'topCenter',
        timeout: 10000,
        message: msg,
        zindex: null
    };

    if (container !== undefined && container !== '') {
        $body.find(container).html('');
        option.target = container;

        if($body.find(container).parents('.modal').length) {
            $('html, body').animate({
                scrollTop: 0
            }, 200);
        } else {
            $('html, body').animate({
                scrollTop: 0
            }, 200);
        }
    } else {
        $('html, body').animate({scrollTop: '0px'}, 800);
    }

    try {
        iziToast.show(option);
    } catch (e) {}
};

$.iziToastError = function (msg, container) {
    var option = {
        title: 'خطا : ',
        color: 'red',
        titleColor: 'white',
        messageColor: 'white',
        icon: 'fa fa-times-circle',
        backgroundColor: '#f44336',
        iconColor: 'white',
        rtl: true,
        position: 'topCenter',
        timeout: 10000,
        message: msg,
        zindex: null
    };

    if(container !== undefined && container !== '') {
        $body.find(container).html('');
        option.target = container;

        if($body.find(container).parents('.modal').length) {
            $('body').find(container).parents('.modal').animate({
                scrollTop: 0
            }, 200);
        } else {
            $('html, body').animate({
                scrollTop: 0
            }, 200);
        }
    } else {
        $('html, body').animate({scrollTop: '0px'}, 800);
    }

    try {
        iziToast.show(option);
    } catch (e) {}
};