<!-- category container -->

<div id="categoryContainer" class="pull-right box whiteBg boxBorder roundCorner noSelect transition">
    <header class="text-small roundCorner">
        <a class="hamburgerIcon pull-right"><i class="fa fa-list-ul fa-rotate-180" aria-hidden="true"></i>
            <p>دسته بندی </p>
        </a>
        <a class="City pull-left"> <i class="fa fa-map-marker"></i> <span> انتخاب استان</span> <i class=" angle fa fa-angle-down angle-up-arrow" aria-hidden="true"></i></a>
    </header>
    <div class="mmenuHolder">
        <nav class="menu mm-opened" data-placeholder="Search" data-title="Category">
            <?php echo $list['category_list']; ?>
        </nav>
    </div>
    <div class="mmenuHolder1">
        <nav class="menu menu1 mm-opened" data-placeholder="جستجو در استانها" data-title="دسته بندی استانها">
            <ul>
                <?php foreach (get_Provinces() as $key => $value) : ?>
                    <li>
                        <a data-toggle="tooltip" data-placement="top" title="<?php echo $value['name'] ?>" href="<?php echo  RELA_DIR  . "company/type/تولیدی/province/" . $value['name'] ?>"><?php echo $value['name'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/virtual-keyboard/1.25.29/js/jquery.keyboard.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/virtual-keyboard/1.25.29/layouts/keyboard-layouts-microsoft.min.js"></script>