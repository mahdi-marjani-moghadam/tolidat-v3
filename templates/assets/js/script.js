/**
 * Created by omidkh on 2/9/2016 AD.
 */
$(document).ready(function()
{
    var $body = $('body'),
        $toggleNav = $('#toggleNav'),
        $newsContainer = $('.newsContainer '),
        $bestProduct = $('.bestProduct'),
        $event = $('.event'),
        $supporters = $('.supporters'),
        $navbarCollapse = $('.container.mainLink .navbar .navbar-collapse'),
        width = $(window).width(),
        height = $(window).height(),
        $searchParam = $body.find('#searchParam'),
        $validationForm = $('form[data-toggle="validator"]'),
        $menucompany = $('.menucompany'),
        $tabMenu = $('.tab .tabMenu'),
        $tab = $('.tab .menucompany .angle-up-arrow');

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

    $('.key-index .mm-search')
        .addClass('mmenu-index-container');
    $('.key-search .mm-search')
        .addClass('mmenu-search-container');
    $('.key-product .mm-search')
        .addClass('mmenu-product-container');
    /*$('.mm-search input')
        .addClass('keyboard')
        .after('<img class="icon hidden-xs hidden-sm" src="/templates/template_fa/assets/images/keyboard.png">');
    //end of mmenu

    //on screen keyboard
    if(width > 992){
        $('.keyboard').keyboard({
            layout: 'ms-Persian',
            initialFocus : true,
            autoAccept : true,
            tabNavigation : true,
            usePreview: false,
            rtl: true,
            language: "fa",
            openOn: '',
            appendLocally : true
        });
        // Typing Extension
        $(' .icon').click(function () {
            var kb = $(this).prev().getkeyboard();
            // typeIn( text, delay, callback );
            kb.reveal();
        });
        $('.ui-keyboard').addClass('hidden-xs').addClass('hidden-sm');
    }//end of on screen keyboard*/

    //filter product
    $('.product-filter button').bind('click',function() {
        $(this).find('i').toggleClass('fa-rotate-180');
    });//end of filter product

    //search bar
    $('.search-bar button').bind('click',function() {
        $(this).find('.fa-angle-down').toggleClass('fa-rotate-180');
    });//end of search bar

    //hamburger menu
    $("#js-hamburger").on("click", function(e){
        var $profile  = $('.profile'),
            $plus = $('.plus');
        if($profile && $plus .hasClass('active')) {
            $profile .removeClass('active');
            $plus .removeClass('active');
            $('.plus .angle-up-arrow').removeClass('is-open');
        }
        e.stopPropagation();
        $(this).toggleClass('is-active');
        $('.menu-content').toggleClass("is-open");

    });
    $(".menu-content").on("click", function(e) {
        e.stopPropagation();
    });
    //end of hamburger menu

    //keyDown
    $(this).keydown(function( e ) {
        var keycode = e.which ? e.which : e.keycode;
        if (keycode == 111 || keycode == 191 ) {
            $('.place').focus();
            return false;
        }
    });
    // end of keyDown


    $('.tabProfile .navbar-header button').click(function(e) {
        e.stopPropagation();
        var tabProfile = $('.tabProfile .dropdown');
        if(tabProfile.hasClass('active')) {
            tabProfile.removeClass('active');
        }
        var dropdown = $('.tabProfile .dropdown-menu');
        if(dropdown.css('display','block')) {
            dropdown.css('display','none');
        }
        var conPro  = $('.con-icon-pro .dropdown .angle');
        if(conPro.hasClass('fa-rotate-180')) {
            conPro.removeClass('fa-rotate-180');
        }
        var $notifications  = $('.notifications'),
            $click  = $('.click');
        if($notifications && $click .hasClass('active')) {
            $notifications .removeClass('active');
            $click  .removeClass('active');
        }
        if($(this).hasClass('collapsed')){
            $(this).removeClass('collapsed');
            $('.tabProfile .navbar-collapse').addClass('in');
        }
        else{
            $(this).addClass('collapsed');
            $('.tabProfile .navbar-collapse').removeClass('in');
        }
    });

    $body.click(function() {
        //hamburger menu
        var menuHolder = $('.menu-content.is-open');
        if(menuHolder.hasClass('is-open')) {
            menuHolder.removeClass('is-open');
        }
        var hamburgerHolder = $('.hamburger.is-active');
        if(hamburgerHolder.hasClass('is-active')) {
            hamburgerHolder.removeClass('is-active');
        }


        var tabProfileB = $('.tabProfile .navbar-header button');
        tabProfileB.addClass('collapsed');

        var tabProfileNav = $('.tabProfile .navbar-collapse');
        tabProfileNav.removeClass('in');


        var $profile  = $('.profile'),
            $plus = $('.plus'),
            $fa =$('.plus .angle-up-arrow');
        if($profile && $plus .hasClass('active')) {
            $profile .removeClass('active');
            $plus .removeClass('active');
            $fa.removeClass('is-open');
        }
        var $notifications  = $('.notifications'),
            $click  = $('.click');
        if($notifications && $click .hasClass('active')) {
            $notifications .removeClass('active');
            $click  .removeClass('active');
        }
        var $contentPro   = $('.contentPro h3 a '),
            $contentKebabMenu  = $('.contentPro .contentKebabMenu ');
        if($contentPro && $contentKebabMenu .hasClass('active')) {
            $contentPro .removeClass('active');
            $contentKebabMenu  .removeClass('active');
        }
        var $tabProfile  = $('.tabProfile .dropdown '),
            dropdown  = $('.tabProfile .dropdown-menu'),
            $angle= $('.con-icon-pro .dropdown .angle');

        if($tabProfile.hasClass('active')) {
            $tabProfile.removeClass('active');
            dropdown.css('display','none');
            $angle.removeClass('fa-rotate-180');
        }

        if( $('.product-filter .btn-group').hasClass('open') ){
            $('.product-filter .btn-group i').removeClass('fa-rotate-180');
        }
        if( $('.search-bar .btn-group').hasClass('open') ){
            $('.search-bar .btn-group i').removeClass('fa-rotate-180');
        }
    });
    $('.dir-ltr ul li a').click(function () {
        $('.phoneType').attr('data-value',$(this).attr('data-value'));
        //$('#id-phone').val($(this).attr('data-value'));
    });

    $('.container-location-city, .loginBtnContainer , .city-list').bind('click',function(e) {
        e.stopPropagation();
    });

    $('.showSort').click(function(e){
        e.preventDefault();
        var $find = $(this).find('i');
        if($find.hasClass('fa-sort-amount-asc')){
            $find.removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc')
        }
        else{
            $find.addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc')
        }
    });

    $body.on('click','.contentPro-cert-modal' , function (e){
        e.preventDefault();
        $(this).toggleClass('checked');
    });


    /*$marker.tooltip({placement: 'bottom'});
     if(width<500){
     $marker.tooltip( "disable" );
     }*/
    $body.on('mouseover', '.contentPro', function() {
        $('[data-toggle="tooltip"]').tooltip();
    });


    var mainPage = $('.mainPage');
    if(mainPage.length){
        $('#categoryContainer').addClass('active');
    }

    $(window).scroll(function() {
        var $header1 = $('header.pageHeader');
        if($(this).scrollTop() > 120){
            $header1.addClass("sticky");
            $body.addClass('sticky');
        }
        else if($(this).scrollTop() < 210){
            $header1.removeClass("sticky");
            $body.removeClass('sticky');
        }
        var $tab = $('.tab');
        if($(this).scrollTop() > 450){
            $tab.addClass("stick");
            $body.addClass('stick');
        }
        else if($(this).scrollTop() < 350){
            $tab.removeClass("stick");
            $body.removeClass('stick');
        }
    });

    $('#myTabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show')
    });

    $body.on('submit', '#searchParam', function(e) {
        e.preventDefault();
        sublit_search();
    });

    // search function
    function sublit_search(a) {
        var question = $("#q").val(),
            type = $("#type").val(),
            address_search = $searchParam.attr("action"),
            final_address = baseURL + 'search/type/' + type;
        if (question.length > 0) {
            final_address += '/q/' + question;
        }
        window.location.href = final_address;
    }
    $toggleNav.bind('click', function() {
        var self = $(this),
            $mainLinks = $('.pageHeader .container.mainLink .navbar .navbar-nav>li');
        self.toggleClass('active');
        $body.toggleClass('fixed');
        $navbarCollapse.fadeToggle("fast");
        $navbarCollapse.toggleClass('in');

        if (self.hasClass('active')) {
            var speed = 1000;
            $mainLinks.each(function() {
                $(this).stop().slideDown(speed);
                speed += 400;
            });
        } else {
            $mainLinks.each(function() {
                $(this).stop().slideUp(10);
            });
        }
    });

    $('#q').focus(function() {
        $(this).parents('.search-wrap').addClass('active');
    }).blur(function() {
        $(this).parents('.search-wrap').removeClass('active');
    });
/*
    if ($slider.length) {
        $slider.sliderPro({
            width: 860,
            height: 205,
            arrows: true,
            buttons: false,
            waitForLayers: true,
            thumbnailWidth: 215,
            thumbnailHeight: 100,
            thumbnailPointer: true,
            autoplay: false,
            autoScaleLayers: false
        });
    }*/
    $('#categoryContainer header .hamburgerIcon').bind('click', function() {
        var self = $(this),
            categoryContainer = $('.mmenuHolder');
        if(self.hasClass('active')){
            self.removeClass('active');
            categoryContainer.removeClass('active');
        } else {
            $('.mmenuHolder1').removeClass('active');
            $('.angle-up-arrow').removeClass('is-open');
            $('#categoryContainer .City').removeClass('active');
            self.addClass('active');
            categoryContainer.addClass('active');
        }
    });

    $('#categoryContainer .City').bind('click', function () {

        $('.mmenuHolder1').slideToggle('fast');
        var self = $(this),
            $mmenuHolder1 = $('.mmenuHolder1');
        if (self.hasClass('active')) {
            self.removeClass('active');
            $mmenuHolder1.removeClass('active');

            $('.angle-up-arrow').removeClass("is-open");
        } else {
            self.addClass('active');
            $('#categoryContainer header .hamburgerIcon').removeClass('active');
            $mmenuHolder1.addClass('active');


            $('.mmenuHolder').removeClass('active');
            $('.angle-up-arrow').addClass("is-open");
        }
    });

    $body.on('keypress', '.onlyNum', function(e) {
        var self = $(this),
            key = e.which ? e.which : e.keyCode;

        return !!((key > 47 && key < 58) || (key > 1775 && key < 1786) ||
        (key == 37 || key == 38 || key == 39 || key == 40 || key == 9 || key == 16 || key == 17 || key == 8));
    });
    $('.searchContainer a').bind('click', function(e) {
        e.preventDefault();
        var $searchContainer = $body.find('#searchContainer');

        if ($searchContainer.length && !$searchContainer.hasClass('hideSearch')) {

            $('html, body').animate({
                    scrollTop: $searchContainer.offset().top - 120
                },
                'slow',
                function() {
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

            if (!$body.find('.overlay').length)
            {
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
/*    if ($slider.length) {
        $slider.sliderPro({
            width: 860,
            height: 205,
            arrows: true,
            buttons: false,
            waitForLayers: true,
            thumbnailWidth: 215,
            thumbnailHeight: 100,
            thumbnailPointer: true,
            autoplay: false,
            autoScaleLayers: false
        });
    }*/

    if ($newsContainer.length) {
        $newsContainer.find('.content').sliderPro({
            width: '100%',
            height: width < 768 ? 125 : 100,
            orientation: 'vertical',
            visibleSize: '100%',
            arrows: true,
            buttons: false,
            fadeArrows: false,
            autoplay: false
        });

        /* $('.newsContainer .sp-arrow.sp-next-arrow').append('<i class="fa fa-angle-left" aria-hidden="true"></i>');
         $('.newsContainer .sp-arrow.sp-previous-arrow').append('<i class="fa fa-angle-right" aria-hidden="true"></i>');*/
    }



    if ($event.length) {
        $event.find('.content').sliderPro({
            width: '100%',
            height: width < 768 ? 31 : 29,
            orientation: 'vertical',
            visibleSize: '100%',
            arrows: true,
            buttons: false,
            fadeArrows: false,
            autoplay: false
        });
    }

    if ($bestProduct.length) {
        $bestProduct.find('.content1').sliderPro({
            width: '100%',
            height: width < 768 ? 92 : 100,
            orientation: 'vertical',
            visibleSize: '100%',
            arrows: true,
            buttons: false,
            fadeArrows: false,
            autoplay: false
        });

        /*$('.bestProduct .sp-arrow.sp-next-arrow').append('<i class="fa fa-angle-left" aria-hidden="true"></i>');
         $('.bestProduct .sp-arrow.sp-previous-arrow').append('<i class="fa fa-angle-right" aria-hidden="true"></i>');*/
    }
    if ($supporters.length) {
        $supporters.find('.content').sliderPro({
            width: $(window).width() < 992 ? "34%" :  "20%",
            height: 90,
            orientation: 'horizontal',
            visibleSize: '100%',
            arrows: true,
            buttons: false,
            fadeArrows: false,
            autoplay: false
        });
    }


    $body.find('input[required]').each(function() {
        $(this).parent('.form-group').append('<span class="requiredIcon">*</span>');
    });
    $body.on('click', '.overlay,#searchContainer .hamburgerMenu', function() {
        $('.overlay').fadeOut(300);
        $body.find('#searchContainer').removeClass('active');
        $body.find('#searchContainer').css('top', '-100%');
        $body.removeClass('fixed');
    });

    if ($validationForm.length) {
        $validationForm.validator().on('submit', function(e) {
            var self_ = $(this),
                $field = $(e.relatedTarget);

            if (e.isDefaultPrevented()) {
                $field.parents('.form-group').append('<div class="errorHandler">' + $field.data("error") + '</div>');
                $field.parents('.form-group').removeClass('has-success').addClass('has-error');
                $field.parents('.form-group').find('.requiredIcon').html('<i class="fa fa-check"></i>')
            } else {
                return true;
            }
        }).on('valid.bs.validator', function(e) {
            var self_ = $(this),
                $field = $(e.relatedTarget);

            $field.parents('.form-group').find('.errorHandler').remove();
            $field.parents('.form-group').removeClass('has-error').addClass('has-success');
            $field.parents('.form-group').find('.requiredIcon').html('<i class="fa fa-check"></i>')
        }).on('invalid.bs.validator', function(e) {
            var self_ = $(this),
                $field = $(e.relatedTarget);

            $field.parents('.form-group').append('<div class="errorHandler">' + $field.data("error") + '</div>');
            $field.parents('.form-group').removeClass('has-success').addClass('has-error');
            $field.parents('.form-group').find('.requiredIcon').html('*')
        });
    }
    //scroll on detailCompany
    function smk_jump_to_it( _selector, _speed ){

        _speed = parseInt(_speed, 10) === _speed ? _speed : 300;
        $(_selector).on('click', function(event){
            //alert($('body').scrollTop());
            if( $('body').scrollTop()< 125){
                var offset = 40;
            }
            else if( 126< $('body').scrollTop() && $('body').scrollTop() < 350) {
                var offset = width > 768 ? 170 : 170;
            }
            else {
                var offset = width > 768 ? 130 : 170;
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
                scrollTop: parseInt( $(url).offset().top ) - offset
            }, _speed);
        });
    }
    // Cache selectors
    var lastId,
        topMenu = $(".tabMenu"),
        topMenuHeight = topMenu.outerHeight()+100,
    // All list items
        menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
            var item = $($(this).attr("href"));
            if (item.length) { return item;
            }
        });

    smk_jump_to_it( '.link_classname',700);


// Bind to scroll
    $(window).scroll(function(){
        // Get container scroll position
        var fromTop = $(this).scrollTop()+topMenuHeight;

        // Get id of current scroll item
        var cur = scrollItems.map(function(){
            if ($(this).offset().top < fromTop)
                return this;
        });
        // Get the id of the current element
        cur = cur[cur.length-1];
        var id = cur && cur.length ? cur[0].id : "";

        if (lastId !== id) {
            lastId = id;
            // Set/remove active class
            menuItems
                .parent().removeClass("active")
                .end().filter("[href='#"+id+"']").parent().addClass("active");
        }
    });
    //end of scroll on detailCompany

    //tabMenu detailCompany
    $menucompany.bind('click', function() {
        var self = $(this);
        if(self.hasClass('active')){
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
        var tabProfile = $('.tabProfile .dropdown');
        if(tabProfile.hasClass('active')) {
            tabProfile.removeClass('active');
        }
        var dropdown = $('.tabProfile .dropdown-menu');
        if( dropdown.css('display','block')) {
            dropdown.css('display','none');
        }
        var conPro  = $('.con-icon-pro .dropdown .angle');
        if(conPro.hasClass('fa-rotate-180')) {
            conPro.removeClass('fa-rotate-180');
        }

        var navbarHeader  = $('.tabProfile .navbar-header button');
        if(!navbarHeader.hasClass('collapsed')) {
            navbarHeader.addClass('collapsed');
        }
        var navbarcollapse  =  $('.tabProfile .navbar-collapse');
        if(navbarcollapse.hasClass('in')) {
            navbarcollapse.removeClass('in');
        }

        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.notifications').removeClass('active');
        }
        else {
            $(this).addClass('active');
            $('.notifications').addClass('active');
        }
    });
    $(".notifications").on("click", function(e) {
        e.stopPropagation();
    });
    $(".navbar-collapse").on("click", function(e) {
        e.stopPropagation();
    });


    function preview(input) {

        var img = $(input).parent().prev('img');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) { img.attr('src', e.target.result);  }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".uploadFile").change(function(){
        var img = $(this).parent().prev('img');

        img.css({top: 0, left: 0});
        preview(this);
        img.draggable({ containment: 'parent',scroll: false });
    });

    $('.plus').click(function (e){
        e.stopPropagation();
        var menuHolder = $('.menu-content.is-open');
        if(menuHolder.hasClass('is-open')) {
            menuHolder.removeClass('is-open');
        }
        var hamburgerHolder = $('.hamburger.is-active');
        if(hamburgerHolder.hasClass('is-active')) {
            hamburgerHolder.removeClass('is-active');
        }
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.profile').removeClass('active');
            $('.plus .angle-up-arrow').removeClass('is-open');
        }
        else {
            $(this).addClass('active');
            $('.profile').addClass('active');
            $('.plus .angle-up-arrow').addClass('is-open');
        }
    });
    $(".profile").on("click", function(e) {
        e.stopPropagation();
    });
    $('.tabProfile .dropdown').click(function(e) {
        e.stopPropagation();
        var click = $('.click');
        var notifications = $('.notifications');
        if( click.hasClass('active') && notifications.hasClass('active') ) {
            click.removeClass('active');
            notifications.removeClass('active');
        }

        var navbarHeader  = $('.tabProfile .navbar-header button');
        if(!navbarHeader.hasClass('collapsed')) {
            navbarHeader.addClass('collapsed');
        }
        var navbarcollapse  =  $('.tabProfile .navbar-collapse');
        if(navbarcollapse.hasClass('in')) {
            navbarcollapse.removeClass('in');
        }

        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('.con-icon-pro .dropdown .angle').removeClass('fa-rotate-180');
            $('.tabProfile .dropdown-menu').css('display','none');
        }
        else{
            $(this).addClass('active');
            $('.con-icon-pro .dropdown .angle').addClass('fa-rotate-180');
            $('.tabProfile .dropdown-menu').css('display','block');
        }
    });
    $(".tabProfile .dropdown-menu").on("click", function(e) {
        e.stopPropagation();
    });


    $($body).on('click' , '.contentPro .kebabMenu a' , function(e){
        e.stopPropagation();
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).parent().next().removeClass('active');
        }
        else{
            $('.contentPro h3 .contentKebabMenu').removeClass('active');
            $(this).addClass('active');
            $(this).parent().next().addClass('active');
        }
    });

    $(".contentKebabMenu").on("click", function(e) {
        e.stopPropagation();
    });

    $('[data-toggle="popover"]').popover();

    $('.registerPage .content input').on("focus", function() {
        $(this).next().remove();
    });
});