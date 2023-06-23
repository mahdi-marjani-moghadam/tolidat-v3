
</section>

<!-- footer of website -->
<footer id="mainFooter" class="container copyRightContainer mt-double4">
    <a class="img-footer" href="<?php echo RELA_DIR; ?>" name="img-footer" title="لوگوی سایت تولیدات">
        <img src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/تولیدات.png" alt="لوگوی سایت تولیدات">
    </a>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 pull-right noPadding">
            <ul class="container-link li-dirRight">
                <li class="li-right"><a class="transition" href="<?php echo RELA_DIR; ?>package/all" name="package/all" title="لیست تعرفه ها" >لیست تعرفه ها</a></li>
                <li class="li-right"><a class="transition" href="<?php echo RELA_DIR; ?>article" name="article" title="مقالات" >مقالات</a></li>
                <li class="li-right"><a class="transition" href="<?php echo RELA_DIR; ?>laws" name="laws" title="قوانین ومقررات">قوانین و مقررات</a></li>
                <li class="li-right"><a class="transition" href="<?php echo RELA_DIR; ?>aboutus" name="about" title="تولیدات">درباره تولیدات</a></li>
                <li class="li-right"><a class="transition" href="<?php echo RELA_DIR; ?>contactus" name="contactus" title="ارتباط با تولیدات">ارتباط با تولیدات</a></li>
            </ul>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 pull-left noPadding">
            <ul class="container-link li-dirLeft">
                <li class="li-left">
                    <a class="transition" target="_blank" href="https://plus.google.com/100758019528654897564" name="google" title="گوگل پلاس">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
                <li class="li-left">
                    <a class="transition" target="_blank" href="https://t.me/tolidatco" name="tolidatco" title="سایت اجتماعی تولیدات">
                        <i class="fa fa-telegram" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="li-left">
                    <a class="transition" target="_blank" href="https://www.instagram.com/tolidatco/" name="instagram" title="instagram">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 noPadding pull-left enamad mb">
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 noPadding pull-right">
            <p class="text-ultralight center-block text-right">با تولیدات جهانی دیده شوید و اهداف دست نیافتنی خود را محقق کنید</p>
            <p class="text-ultralight center-block text-right ltr">Tolidat.ir All rights reserved &copy;.</p>
        </div>
    </div>


    <div class="back-to-top pull-right">
        <span class="dmtop"><i class="fa fa-angle-up" aria-hidden="true"></i>
        </span>
    </div>
</footer>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<?php
if(isset($_COOKIE['has_keyboard']) && $_COOKIE['has_keyboard'] == 'yes') {
?>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/Keyboard-master/dist/js/jquery.keyboard.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/Keyboard-master/dist/layouts/keyboard-layouts-microsoft.min.js"></script>
<?php
}
?>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/jquery.lazy.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/search.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/script.js?v=13970306"></script>
<?php /*
<!-- Histats.com  START  (aync)-->
<!--<script type="text/javascript">var _Hasync= _Hasync|| [];
    _Hasync.push(['Histats.start', '1,3892886,4,0,0,0,00010000']);
    _Hasync.push(['Histats.fasi', '1']);
    _Hasync.push(['Histats.track_hits', '']);
    (function() {
        var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
        hs.src = ('//s10.histats.com/js15_as.js');
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
    })();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3892886&101" alt="site stats" border="0"></a></noscript>-->
<!-- Histats.com  END  -->
 */?>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154686552-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-154686552-1');
</script>


</body>
</html>