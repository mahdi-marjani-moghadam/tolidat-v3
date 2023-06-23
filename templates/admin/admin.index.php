<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li>
            <a class="rtl text-24">
                <i class="sidebar-icon fa fa-advetisepaper-o"></i>
            </a>
        </li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="container">
    <div class="jumbotron">
        <h1 title="<?= $list['admin_name'] ?>"><?= $list['admin_name'] ?></h1>
        <p>به پنل ادمین خوش آمدید</p>
    </div>
</div>

<div class="content-body">

    <!------------------------------------ نمایش تعداد تمامی کمپانی ها ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-primary bg-primary">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh" class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->
                <p class="lead"></p><!--/lead as title-->
                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">تمامی کمپانی ها</p>
                        <p class="text-lg">
                            <strong>
                                <?php echo $list['company_count']; ?>
                            </strong>
                        </p>
                    </li>
                </ul><!--/list-percentages-->
            </div><!--/panel-body-->
        </div><!--/panel overal-visitor-->
    </div><!--/cols-->

    <!------------------------------------ نمایش تعداد تمامی محصولات ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-success bg-success">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh" class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->
                <p class="lead"></p><!--/lead as title-->
                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">محصولات</p>
                        <p class="text-lg">
                            <strong>
                                <?=(empty($list['products_count'])) ? 0 : $list['products_count'] ?>
                            </strong>
                        </p>
                    </li>
                </ul><!--/list-percentages-->
            </div><!--/panel-body-->
        </div><!--/panel overal-visitor-->
    </div>

    <!------------------------------------ نمایش تعداد تمامی مقالات ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-danger bg-danger">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh"
                            class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->
                <p class="lead"></p><!--/lead as title-->
                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">مقالات</p>
                        <p class="text-lg">
                            <strong>
                                <?php echo $list['article_count']; ?>
                            </strong>
                        </p>
                    </li>
                </ul><!--/list-percentages-->
            </div><!--/panel-body-->
        </div><!--/panel overal-visitor-->
    </div>

    <!------------------------------------ نمایش تعداد تمامی اخبار ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-info bg-info">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh"
                            class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->
                <p class="lead"></p><!--/lead as title-->
                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">اخبار</p>
                        <p class="text-lg">
                            <strong>
                                <?php echo $list['news_count']; ?>
                            </strong>
                        </p>
                    </li>
                </ul><!--/list-percentages-->
            </div><!--/panel-body-->
        </div><!--/panel overal-visitor-->
    </div>

    <!------------------------------------ نمایش تعداد تمامی کمپانی های قفل شده ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-success bg-orange">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh"
                            class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->
                <p class="lead"></p><!--/lead as title-->
                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">کمپانی های قفل شده</p>
                        <p class="text-lg">
                            <strong>
                                <?= $list['lockedCompanies_count'] ?>
                            </strong>
                        </p>
                    </li>
                </ul><!--/list-percentages-->
            </div><!--/panel-body-->
        </div><!--/panel overal-visitor-->
    </div>

    <!------------------------------------ نمایش تعداد تمامی کمپانی های Wiki ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-success bg-customOrange">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh"
                            class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->
                <p class="lead"></p><!--/lead as title-->
                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">کمپانی های Wiki</p>
                        <p class="text-lg">
                            <strong>
                                <?= $list['wikiCompanies_count'] ?>
                            </strong>
                        </p>
                    </li>
                </ul><!--/list-percentages-->
            </div><!--/panel-body-->
        </div><!--/panel overal-visitor-->
    </div>

    <!------------------------------------ نمایش تعداد تمامی کمپانی های پولی ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-success bg-darknight">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh"
                            class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->
                <p class="lead"></p><!--/lead as title-->
                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">کمپانی های پولی</p>
                        <p class="text-lg">
                            <strong>
                                <?= $list['noneFreeCompanies_count'] ?>
                            </strong>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!------------------------------------ نمایش تعداد تمامی کمپانی های تازه ثبت نام کرده ------------------------------------>

    <div class="col-md-3">
        <div id="overall-visitor" class="panel panel-animated panel-success bg-inverse">
            <div class="panel-body">
                <div class="panel-actions-fly">
                    <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh"
                            class="btn-panel">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button><!--/btn-panel-->
                    <a href="#" title="Go to system stats page" class="btn-panel">
                        <i class="glyphicon glyphicon-stats"></i>
                    </a><!--/btn-panel-->
                </div><!--/panel-action-fly-->

                <p class="lead"></p><!--/lead as title-->

                <ul class="list-percentages row ">
                    <li class="col-xs-12">
                        <p class="text-ellipsis">کمپانی های تازه ثبت نام کرده</p>
                        <p class="text-lg">
                            <strong>
                                <?= $list['NewRegisteredCompanies_count'] ?>
                            </strong>
                        </p>
                    </li>
                </ul><!--/list-percentages-->
            </div><!--/panel-body-->
        </div><!--/panel overal-visitor-->
    </div>

</div><!--/content-body -->

