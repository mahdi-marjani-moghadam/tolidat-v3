<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم کمپانی</h3>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 center-block">

                    <form action="shortLink/" data-validate="form" class="form-horizontal form-bordered" method="get">
                        <input type="hidden" name="action" value="shortLink">
                        <label for="companyId">آیدی کمپانی</label>
                        <input type="text" class="form-control" name="companyId">
                        <br>
                        <input type="submit" class="btn-success" name="submit" value="ویرایش کمپانی">
                    </form>

                </div>
            </div>
        </div>

            <?php if ($message != '') { ?>

            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> خطا: </strong>
                <br>
                <?= $message ?>
            </div>

            <?php } ?>

        </div>
</div>
