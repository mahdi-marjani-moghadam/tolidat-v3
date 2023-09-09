<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Untitled Document</title>
    <style type="text/css">

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .body {
            top: 0;
            width: 100%;
            font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
            background: #d2d2d2;
            color: #333333;
            direction:rtl;
            text-align: center;
        }

        .header {
            top: 0;
            background: #423636;
            border-bottom: #F8A025 solid 5px;
            color:#FFF;
            font-size:18px;
            font-weight:bold;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .body-text {
            background:#eee;
            color:#5117A1;
            font-size:16px;
            font-weight:bold;
        }

        .link {
            padding: 25px;
        }

        .content-box-body h4 {
            margin-bottom: 5px;
            margin-right: 0px;
            padding: 0;
        }

        a:link {
            color: #42413C;
            text-decoration: underline;
        }

        a:visited {
            color: #6E6C64;
            text-decoration: underline;
        }

        a:hover, a:active, a:focus {
            text-decoration: none;
        }
        .smallSpace {
            height: 4em;
            width: 100%;
        }
    </style>
</head>

<body class="body">

    <div class="header">
        <h3> تولیدات دایرکتوری مشاغل</h3>
    </div>

<div style="width: 100%;background: #F1F3F2;">
    <div style="background: #FFF;color:#333333;border: #F8A025 solid 1px;">
        <div style="border:#ccc solid 1px;">
            <div class="body-text">
                برای بازیابی رمز عبور روی لینک زیر کلیک کنید :
            </div>

            <div>
                <a href="<?php echo $link ?>" class="link" name="link" title="link">
                    <?php echo $link ?>
                </a>
            </div>
        </div>
    </div>
</div>
    <div class="smallSpace"></div>
    <div class="smallSpace"></div>
</body>
</html>


