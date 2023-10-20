<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>
<script language="javascript" type="text/javascript">
    <?php if (!$offline) : ?>


        function postRefId(refIdValue) {
            var form = document.createElement("form");
            form.setAttribute("method", "POST");


            form.setAttribute("action", "<?php echo $bank_payment ?>");
            form.setAttribute("target", "_self");



            var RedirectURL = document.createElement("input");
            RedirectURL.setAttribute("name", "RedirectURL");
            RedirectURL.setAttribute("value", "<?php echo  RELA_DIR; ?>onlinePayment/returnbank");
            form.appendChild(RedirectURL);

            var RedirectURL = document.createElement("input");
            RedirectURL.setAttribute("name", "token");
            RedirectURL.setAttribute("value", "<?php echo  $token; ?>");
            form.appendChild(RedirectURL);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }


    <?php endif; ?>
</script>

<body>
    <?php if ($offline) :  ?>
        <form action="/onlinePayment/returnbank" method='POST'>
            <input type="text" value="<?php echo $ResNum ?>" name='ResNum'>
            <input type="text" value="1" name='status'>
            <input type="text" value="OK" name='State'>
            <input type="text" value="<?php echo $token ?>" name='token'>
            <button>success</button>
        </form>

        <br>
        <br>
        <br>
        <br>
        <br>
        <form action="/onlinePayment/returnbank"  method='POST'>
            <input type="text" value="local" name='resNum'>
            <input type="text" value="-1" name='StateCode'>
            <button>failed</button>
        </form><br>
        <br>
        <br>
        <br>
        <br>
        <form action="/onlinePayment/returnbank"  method='POST'>
            <input type="text" value="local" name='resNum'>
            <input type="text" value="-1" name='State'>
            <button>لغو</button>
        </form>
    <?php endif; ?>


</body>

</html>