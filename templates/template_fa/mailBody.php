<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
    <style type="text/css">
        <!--

        /* ~~ Element/tag selectors ~~ */
        ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
            padding: 0;
            margin: 0;
        }
        h1, h2, h3, h4, h5, h6, p {
            margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
            padding-right: 10px;
            padding-left: 10px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
            margin-bottom:10px;
        }
        .content-box-body h4 {
            margin-bottom:5px;
            margin-right:0px;
            padding:0;



        }
        a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
            border: none;
        }
        /* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
        a:link {
            color: #42413C;
            text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
        }
        a:visited {
            color: #6E6C64;
            text-decoration: underline;
        }
        a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
            text-decoration: none;
        }
        /* ~~ this fixed width container surrounds all other elements ~~ */

        .boxBody {
            width: 100%;
            background: #F1F3F2;
            margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */

        }
        .containerHead {
            width: 600px;
            background: #423636 ;

            margin: 20px auto 0px auto; /* the auto value on the sides, coupled with the width, centers the layout */
            border:#f8a025 solid 1px;
            border-bottom: #F8A025 solid 5px;

            color:#FFF;
            font-size:18px;

        }
        .container {
            width: 600px;
            background: #FFF;
            margin: 0 auto;
            color:333333;
            border: #F8A025 solid 1px;
        }
        /* ~~ This is the layout information. ~~

        1) Padding is only placed on the top and/or bottom of the div. The elements within this div have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

        */
        .contenHead {
            padding: 5px 5px;
            margin:10px 10px;
            background:#CCC;
            border:#399 solid 1px;
        }
        .content {
            padding: 10px 12px;
        }
        .content-box {
            width:550px;
            margin: 0 auto;
            border:#ccc solid 1px;


        }
        .content-box-head{
            margin: 0 auto;
            background:#eee;
            padding:10px;
            color:#5117A1;
            text-align:center;
            font-size:16px;
            font-weight:bold;
        }

        .content-box-footer{
            margin: 0 auto;
            background:#eee;
            padding:10px;
            color:#5117A1;
            text-align:center;
            font-size:11px;
        }
        .content-box-body{
            margin: 10px auto;
            text-align:justify;
            direction:rtl;

            padding:2px 14px;
            line-height:26px;
            font-size:14px;
        }


        /* ~~ miscellaneous float/clear classes ~~ */
        .fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
            float: right;
            margin-left: 8px;
        }
        .fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
            float: left;
            margin-right: 8px;
        }
        .clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the overflow:hidden on the .container is removed */
            clear:both;
            height:0;
            font-size: 1px;
            line-height: 0px;
        }
        -->
    </style>
</head>

<body style="font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;background: #d2d2d2;margin: 0;padding: 0;color: #333333;direction:rtl;">

<div style="width: 100%;background: #D2D2D2;margin: 0 auto;">

    <div style="width: 600px;background: #423636 ;margin: 20px auto 0px auto;border:#f8a025 solid 1px;border-bottom: #F8A025 solid 5px;	color:#FFF;	font-size:18px;">
        <div style="padding: 10px 12px;">
            <div style="text-align:center; font-weight:bold" >
              تولیدات دایرکتوری مشاغل</div>
        </div>

    </div>
</div>
</div>

<div  style="width: 100%;background: #F1F3F2;margin: 0 auto;">

    <div style="width: 600px;background: #FFF;margin: 0 auto;color:333333;border: #F8A025 solid 1px;">
        <div style="padding: 10px 12px">
            <div style="width:550px;margin: 0 auto;border:#ccc solid 1px;">
                <div style="margin: 0 auto;background:#eee;	padding:10px;color:#5117A1;	text-align:center;font-size:16px;font-weight:bold;">
                    <?php echo $variable['title'];?>
                    <br/>
                    <div style="font-size:12px; color:#333333; padding-top:10px;">
                    </div>
                </div>

                <div   style="margin: 10px auto;text-align:justify;	direction:rtl;padding:2px 14px;line-height:26px;font-size:14px;">

                    <p>
<!--                    <h4>با سلام و احترام </h4>
-->
                    <br />
                    کد فعال سازی :
                    <?php echo $variable['code'] ?>

                    </p>

                </div>
                <div  style="margin: 0 auto;background:#eee;padding:10px;color:#5117A1;text-align:center;font-size:11px;">
                    در صورت وجود هرگونه سوال یا مشکلی در این زمینه از همین طریق با ما در تماس باشید.<br/>
                </div>

            </div>

            <!-- end .content -->
        </div><div style="height:30px;background:#333; border:2px solid #f8a025;direction: ltr ;color:#FFF; text-align:center;padding-top:8px; font-size:12px">
            <?php echo $variable['footer'] ?>
        </div>
        <!-- end .container -->
    </div>

</div>

</body>
</html>


