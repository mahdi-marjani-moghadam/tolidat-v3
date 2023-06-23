
<!---------- If you want to delete this tag and desing it in your own way, be my guest ---------->
<style>
    .gallery-title
    {
        font-size: 36px;
        color: #42B32F;
        text-align: center;
        font-weight: 500;
        margin-bottom: 70px;
    }
    .gallery-title:after {
        content: "";
        position: absolute;
        width: 7.5%;
        left: 46.5%;
        height: 45px;
        border-bottom: 1px solid #5e5e5e;
    }
    .filter-button
    {
        font-size: 18px;
        border: 1px solid #42B32F;
        border-radius: 5px;
        text-align: center;
        color: #42B32F;
        margin-bottom: 30px;

    }
    .filter-button:hover
    {
        font-size: 18px;
        border: 1px solid #42B32F;
        border-radius: 5px;
        text-align: center;
        color: #ffffff;
        background-color: #42B32F;

    }
    .btn-default:active .filter-button:active
    {
        background-color: #42B32F;
        color: white;
    }

    .port-image
    {
        width: 100%;
    }

    .gallery_product
    {
        margin-bottom: 30px;
    }

</style>
<div class="boxContainer">
    <div class="row">
        <!-- breadcrumb -->
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
        <!-- /end of breadcrumb -->
    </div>

    <!-- separator -->
    <div class="row xxxsmallSpace"></div>

    <div class=" whiteBg boxBorder roundCorner container noPadding">
        <div class="detailNews">
            <h2 class="text-right text-ultralight text-bold fullWidth">
                تیتر رویداد
            </h2>
            <div class="row">
                <div class="content fullWidth">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center">
                        <img src="http://joern-duwe.de/aquaristik/images/skalare00.jpg" alt="post img" class="roundCorner boxBorder pull-left img-responsive postImg img-thumbnail margin10">
                    </div>
                    <div class="col-xs-12  col-sm-12 col-md-9">
                        <article class="text-right text-justify">
                            توضیحات رویداد
                        </article>
                        <div class="xsmallSpace"></div>
                        <article class="text-right text-justify">
                            مصرف شکر در کشور سالانه ۲,۳ ميليون تن است که امسال حدود ۷۰۰ هزار تن آن وارد شده است و اين در حالي است که دبير انجمن صنفي کارخانه‌هاي قند و شکر ايران مي‌گويد: ۲ ميليون و ۴۰۰ هزار تن ظرفيت نصب شده کارخانجات قند و شکر داخلي است
                        </article>

                        <!-- separator -->
                        <div class="xsmallSpace"></div>
                        <div class="calender rtl pull-right">
                            <i class="fa fa-calendar"></i>
                            <?php echo (strlen($list['list']['date']) ? $list['list']['date'] : '-'); ?>
                        </div>
                    </div>
                    <?php
                    /*if(strlen($list['list']['meta_keyword']))
                    {
                    ?>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a><span class="badge"><?php echo (strlen($list['list']['meta_keyword']) ? $list['list']['meta_keyword'] : '-'); ?></span></a>
                        </div>
                    <?php
                    }*/
                    if(strlen($list['list']['meta_description']))
                    {
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <?php echo (strlen($list['list']['meta_description']) ? $list['list']['meta_description'] : '-'); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-10 blogShort">

    <h5>
        <?= $list['title'] ?>
    </h5>

    <article>
        <p>
            <?= $list['body'] ?>
        </p>
        <br>
    </article>
</div>

<div class="container">

    <div class="row">

        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">Gallery</h1>
        </div>

        <br/>

        <?php
        $list['gallery'] = [1, 2 ,3 ,4, 5, 6];
        foreach ($list['gallery'] as $photos) { ?>

        <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
            <img src="http://fakeimg.pl/365x365/" class="img-responsive width roundCorner boxBorder">
        </div>

        <?php } ?>

    </div>

</div>
