<?php include_once("breadcrumb.php"); ?>

<div class="container m-auto">

    <div class="bg-gray-50 rounded border-2 p-5 my-4 leading-relaxed text-sm">
        <?php if (isset($msg) && strlen($msg)) { ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?php echo $msg; ?>
                </div>
            </div>
        <?php } ?>

        <?php $key = key($list['list']); ?>


        <div class="row fullWidth center-block">

            <div class=" box text-right mb pull-left">
                <h1 class="text-orange-500 font-bold" title="<?php echo $list['list'][$key]['head1'] ?>"><?php echo (strlen($list['list'][$key]['head1']) ? $list['list'][$key]['head1'] : ""); ?></h1>
                <p class="text-justify"><?php echo (strlen($list['list'][$key]['text1']) ? nl2br($list['list'][$key]['text1']) : ""); ?></p>
            </div>
        </div>




        <div class="row fullWidth center-block mt-4">

            <div class=" box  pull-right">
                <h2 class="text-orange-500 font-bold" title="<?php echo $list['list'][$key]['head2'] ?>"><?php echo (strlen($list['list'][$key]['head2']) ? $list['list'][$key]['head2'] : ""); ?></h2>
                <p class="text-justify"><?php echo (strlen($list['list'][$key]['text2']) ? nl2br($list['list'][$key]['text2']) : ""); ?></p>
            </div>



        </div>



        <div class="row fullWidth center-block mt-4">
            <div class=" box mb">
                <h2 class="text-orange-500 font-bold" title="<?php echo $list['list'][$key]['head3'] ?>"><?php echo (strlen($list['list'][$key]['head3']) ? $list['list'][$key]['head3'] : ""); ?></h2>
                <p class="text-justify"><?php echo (strlen($list['list'][$key]['text3']) ? nl2br($list['list'][$key]['text3']) : ""); ?></p>
            </div>
        </div>

    </div>


</div>
<div class="bg-tolidatColor py-10">

    <div class="container m-auto text-center">
        <h2 class="text-white font-bold text-2xl"> جهت ثبت نام آسان بر روی دکمه زیر کلیک کنید</h2>
        <a class="rounded-full bg-white py-1 px-5 mt-5 inline-block" id="cta-aboutus-to-register" href="/register">شروع ثبت نام رایگان</a>
    </div>
</div>