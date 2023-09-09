<style>
   .law {
        border: 1px solid #e3e3e3;
        background-color: #fff;
        line-height: 30px;
        padding: 10px;
        text-align: justify;
        border-radius: 5px;
    }
</style>
<!-- breadcrumb -->
<div class="boxContainer">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
    </div>
    <div class="container">
        <?php foreach ($list['laws'] as $id => $fields): ?>
            <div class="row">
                <p class="law"><?php echo nl2br($fields['text']); ?></p>
            </div>
            <div class="row xxxsmallSpace"></div>
        <?php endforeach; ?>
    </div>
</div>
