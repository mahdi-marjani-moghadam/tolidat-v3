<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>
<script language="javascript" type="text/javascript">
    function postRefId (refIdValue) {
        var form = document.createElement("form");
        form.setAttribute("method", "POST");
       
            
        form.setAttribute("action", "<?php echo $bank_payment?>");
        form.setAttribute("target", "_self");


        // var RedirectURL = document.createElement("input");
        // RedirectURL.setAttribute("name", "MID");
        // RedirectURL.setAttribute("value", "<?php echo  $mid; ?>");
        // form.appendChild(RedirectURL);

        // var RedirectURL = document.createElement("input");
        // RedirectURL.setAttribute("name", "ResNum");
        // RedirectURL.setAttribute("value", "<?php echo $ResNum ; ?>");
        // form.appendChild(RedirectURL);

        // var RedirectURL = document.createElement("input");
        // RedirectURL.setAttribute("name", "Amount");
        // RedirectURL.setAttribute("value", "<?php echo $amount ; ?>");
        // form.appendChild(RedirectURL);
        
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


</script>
<body>

</body>
</html>
<?php echo "<script language='javascript' type='text/javascript'>postRefId('" . $resultToken['token'] . "');</script>";
exit() ;
die() ;
?>
