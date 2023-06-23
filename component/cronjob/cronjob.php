<!--<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Document</title>
    <style>
        .carousel-inner .active.left { left: -25%; }
        .carousel-inner .active.right { left: 25%; }
        .carousel-inner .next        { left:  25%; }
        .carousel-inner .prev		 { left: -25%; }

        .carousel-control {
            display: block;
            width: 60px;
            height: 100%;
            font-size: 100px;
            background: rgba(0, 0, 0, 0);
            font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
            font-weight: 300;
            line-height: 2;
        }

        .carousel-fade .carousel-inner .active.left,
        .carousel-fade .carousel-inner .active.right {
            left: 0;
            opacity: 0;
            z-index: 1;
        }
        .carousel-fade .carousel-inner .next.left, .carousel-fade .carousel-inner .prev.right { opacity: 1; }

        .carousel-fade .carousel-control { z-index: 2; }

    </style>
</head>
<body>
<div class="container">
    <div class="col-md-12 text-center">
        <h3 class="">Bootstrap 3 Single advance slide</h3>
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="carousel slide" id="myCarousel">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/e499e4/fff&amp;text=1" class="img-responsive"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/e477e4/fff&amp;text=2" class="img-responsive"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/eeeeee&amp;text=3" class="img-responsive"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/f4f4f4&amp;text=4" class="img-responsive"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/f566f5/333&amp;text=5" class="img-responsive"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/f477f4/fff&amp;text=6" class="img-responsive"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/eeeeee&amp;text=7" class="img-responsive"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-3"><a href="#" class=""><img src="http://placehold.it/500/fcfcfc/333&amp;text=8" class="img-responsive"></a>
                    </div>
                </div>
            </div> <a data-slide="prev" href="#myCarousel" class="left carousel-control">‹</a>

            <a data-slide="next" href="#myCarousel" class="right carousel-control">›</a>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('.carousel').carousel({
            pause: true, // init without autoplay (optional)
            interval: false, // do not autoplay after sliding (optional)
            wrap: false // do not loop
        });
        // left control hide
        //$('.carousel').children('.left.carousel-control').hide();
    });
    $('.carousel').on('slid.bs.carousel', function() {
        var carouselData = $(this).data('bs.carousel');
        var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
        $(this).children('.carousel-control').show();
        if (currentIndex == 0) {
            $(this).children('.left.carousel-control').fadeOut();
        } else if (currentIndex + 1 == carouselData.$items.length) {
            $(this).children('.right.carousel-control').fadeOut();
        }
    });



    $('.carousel .item').each(function(){
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<2;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });


</script>

</body>
</html>-->
<!--<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        .item {
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="item one" style="width: 30%; float: right;">
        <img src="../../statics/images/flex/1.jpg"  class="img-responsive">
    </div>
    <div style="width: 20%; float: right;">
        <div class="item two" style="width: 100%; float: right">
            <img src="../../statics/images/flex/2.jpg" class="img-responsive">
        </div>
        <div class="item three" style="width: 100%; float: right">
            <img src="../../statics/images/flex/3.jpg" class="img-responsive">
        </div>
    </div>
    <div class="item four" style="width: 50%; float: left">
        <img src="../../statics/images/flex/4.jpg" class="img-responsive">
    </div>
    <div class="item four" style="width: 25%; float: right">
        <img src="../../statics/images/flex/5.jpg" class="img-responsive">
    </div>
    <div class="item five" style="width: 25%; float: left">
        <img src="../../statics/images/flex/6.jpg"  class="img-responsive">
    </div>
    <div class="item six" style="width: 75%; float: right">
        <img src="../../statics/images/flex/7.jpg" class="img-responsive">
    </div>
</div>

</body>
</html>-->
<?php


include ROOT_DIR . "component/cronjob/CronjobController.php";
global $PARAM;
$controller = new CronjobController();


switch ($PARAM[1]) {

    case 'run' :
        $controller->run();
        break;
    case "phpinfo" :
        $controller->phpinfo();
        break;
    case "priority" :
        $controller->updatePriorityAllCompany();
        break;
    case "creatediscountcode" :
        $controller->createDiscountCode();
        break;
    case "calculation" :
        $controller->calculateScore($PARAM[2]);
        break;
    case "category" :
        $controller->updateCategoryCompany();
        break;
    case "editorMember" :
        $controller->AddCompanyId();
        break;
    case "editCategoryCompany" :
        $controller->editCategoryCompany();
        break;
    case "editCategoryProduct" :
        $controller->editCategoryProduct();
        break;
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    var fields = {factor: {}};

    this.name = 'fardin';

    var a = {'package': 'noghre', 'price': 1000};

    fields[this.name] = 'fardin';

    $.each(a, function (i, v) {
        fields.factor[i] = v;
    });

    console.log(fields);
</script>
