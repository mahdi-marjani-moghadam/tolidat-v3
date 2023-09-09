<?php  ?> 
<div id="verifiedSuppliers" class=" suppliers container">
    <!-- separator -->
    <div class="or-spacer center-block">
        <div class="mask">
            <span class="text-center">جستجو در <?php echo  isset($list['type']) ? $list['type'] : 'تولیدی' ?></span>
        </div>
    </div>

    <!-- breadcrumb -->
    <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
        <ul id="breadcrumb" class="pull-right">
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="" >تولیدی ها</a></li>
        </ul>
    </div>
    <!-- /end of breadcrumb -->

    <!-- separator -->
    <div class="row xxxsmallSpace"></div>
    <section class="container noPadding">
        <div class="row">
            <!--  tab for cityList -->
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="search-box">
                    <div class="search-box-header"><p>شهرها</p>
                    </div>
                    <ul class="nav-search">
                        <?php foreach ($list['list']['city'] as $key => $value) { ?>
                            <li><span>(<?php echo  $value['count'] ?>)</span><label for="city-<?php echo  $value['City_id'] ?>" class="company-name"> <?php echo  $value['name'] ?><input type="checkbox" name="city[]" id="city-<?php echo  $value['City_id'] ?>" value="<?php echo  $value['name'] ?>"></label></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="search-box">
                    <div class="search-box-header"><p>دسته بندی ها</p>
                    </div>
                    <ul class="nav-search">
                        <?php foreach ($list['list']['category'] as $key => $value) { ?>
                            <li><span>(<?php echo  $value['count'] ?>)</span><label for="cat-<?php echo  $value['Category_id'] ?>" class="company-name"> <?php echo  $value['title'] ?><input type="checkbox" name="category[]" id="cat-<?php echo  $value['Category_id'] ?>" value="<?php echo  $value['Category_id'] ?>"></label></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!--  end tab for cityList -->
            
            <!--  tab for grid&list -->
            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="searchBar center-block whiteBg boxBorder roundCorner">
                    <a data-type="grid" class="showMethod" href="#" name="grid" title="grid"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                    <a data-type="list" class="showMethod" href="#" name="list" title="list"><i class="fa fa-bars " aria-hidden="true"></i></a>
                    <div class="sortBy pull-left">
                        <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                    </div>
                </div>
                <!-- end tab for grid&list -->

                <!-- showGrid and listView -->
                <div class="row margin0">
                    <?php if(isset($msg)) { ?>
                        <div class="alert alert-warning">
                            <strong>توجه! </strong><?echo $msg;?>
                        </div>
                    <?php } ?>
                    <?php if (!isset($list['type']) || $list['type'] == 'تولیدی') { ?>
                        <?php foreach ($list['list']['company'] as $key => $value) { ?>
                            <div class="col-xs-6 col-sm-6 col-md-4 gridList BoxB boxSearch">
                                <div class="item  whiteBg boxBorder roundCorner">
                                    <div class="logoContainer pull-right">
                                        <a href="#" name="<?php echo  $value['company_name'] ?>" title="<?php echo  $value['company_name'] ?>">
                                            <img src="<?php echo  $value['logo'] ?>" alt="<?php echo  $value['company_name'] ?>">
                                        </a>
                                    </div>
                                    <div class="description1">
                                        <p> <b><i class="fa fa-envelope" aria-hidden="true"></i></b> <apan> mail.dabacenter.ir</apan></p>
                                        <p> <b><i class="fa fa-phone-square" aria-hidden="true"></i></b><apan> 02122424545</apan></p>
                                        <p> <b><i class="fa fa-internet-explorer" aria-hidden="true"></i></b><apan> www.dabacenter.ir </apan></p>
                                    </div>
                                    <div class="content pull-left">
                                        <header class="text-right">
                                            <p><span> <i class="fa fa-sticky-note-o" aria-hidden="true"></i> </span><span>f</span></p>
                                            <p><apan class="text-right text-justify"><i class="fa fa-file-text-o" aria-hidden="true"></i> s </apan></p>
                                        </header>
                                        <a href="<?php echo RELA_DIR.'company/Detail/'.$value['Company_id'].'/'.$value['company_name']; ?>" class="btn btn-link btnDetail transition roundCornerHalf" name="<?php $value['company_name']; ?>" title="نمایش">نمایش</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <!-- pagination -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <nav>
                            <ul class="pagination">
                                <li class="disabled">
                                    <a href="#" aria-label="Previous" name="Previous" title="قبلی">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?
                                foreach($list['pagination']['company'] as $key => $link)
                                {

                                    ?>
                                    <li ><a href="<?php echo RELA_DIR.$link;?>"><?php echo $key+1?></a></li>
                                    <?
                                }
                                ?>
                                <li>
                                    <a href="#" aria-label="Next" name="Next" title="بعدی">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /end of pagination -->
            </div>
        </div>
        <!--  end showGrid and listView -->

        <!-- separator -->
        <div class="row xxsmallSpace"></div>
    </section>
</div>
