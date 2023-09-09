<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css">
<!-- end of boxContainer -->
<!-- boxContainer -->
<div class="boxContainer slick-slider-new">
    <!------------------------ Site Map Section ------------------------>

    <div class="row">
        <!-- breadcrumb -->
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
        <!-- /end of breadcrumb -->
    </div>

    <?php if (isset($event['message'])) { ?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo  $event['message'] ?></strong>
        </div>
    <?php } ?>

    <!-- separator -->
    <div class="row xxxsmallSpace"></div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class=" whiteBg boxBorder roundCorner detailNews detailNews1 noPadding">
                <a data-toggle="modal" data-target="#myModal" class="expand">
                    <i class="fa fa-expand" aria-hidden="true"></i> </a>
                <div id="myModal" class="holder-modal modal fade holder-modal1" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <img src="#">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="slider-hover">
                    <div class="slider-for">
                        <?php foreach ($event['gallery'] as $gallery) { ?>
                            <img class="roundCorner fullWidth boxBorder" src="<?php echo  $gallery['image_path_crop'] ?>">
                        <?php } ?>
                    </div>
                    <div class="hover">
                        <?php echo  $event['description']; ?>
                    </div>
                </div>
                <div class="slider-nav">
                    <?php foreach ($event['gallery'] as $gallery) { ?>
                        <div class="content-sliderNav">
                            <div class="hover1">
                                <div class="span">
                                    <?php echo  $gallery['image_description'] ?>
                                </div>
                            </div>
                            <img class="roundCorner fullWidth boxBorder" src="<?php echo  $gallery['image_path'] ?>">
                        </div>

                    <?php } ?>

                </div>

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class=" whiteBg boxBorder roundCorner container noPadding panel panel-default">

                <div class="detailNews">
                    <!--<h2 class="text-right text-ultralight text-bold fullWidth"> <? /*= $event['title'] */ ?> </h2>-->

                    <header>
                        <div class="center-block text-right text-tab"><?php echo  $event['title'] ?></div>
                    </header>

                    <div class="content fullWidth">
                        <!------------------------ Event List Section ------------------------>

                        <article class="text-right text-justify">
                            <b> توضیحات:</b> <span><?php echo  $event['body'] ?></span>
                        </article>

                    </div>
                </div>

                <div class="panel-footer">
                    <div class="calender rtl pull-right">
                        <i class="fa fa-calendar"></i>
                        <?php echo(strlen($event['date']) ? $event['date'] : '-'); ?>
                    </div>
                    <br> <br>
                    <? // foreach ($event['meta_keyword'] as $metaKeyWord) { ?>
                    <!--    <a href="#">#--><? //= $metaKeyWord ?><!--</a>&nbsp;-->
                    <?php //} ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/slick.min.js"></script>

<script>

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'

    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        /* autoplay: true,
         speedAutoplay: 3000*/
    });


    $('.expand').click(function () {
        var srcImg = $('.slick-active').attr('src');
        var arrSrcImg = srcImg.split('/');
        var imageName = arrSrcImg.splice(-1, 1)['0'];
        var imageNameRaw = imageName.substring(imageName.indexOf(".", imageName.indexOf(".") + 1) + 1);
        var newSrcImg = arrSrcImg.join('/') + '/1300.732.' + imageNameRaw;
        $('#myModal .modal-body img').attr('src', newSrcImg);
    });

</script>

