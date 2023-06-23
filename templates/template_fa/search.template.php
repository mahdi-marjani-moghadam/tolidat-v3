<script type="text/javascript">
    jQuery(function ($) {
        $('input[name=q]').autoComplete({ajax: '<?=RELA_DIR?>company/ajaxSearch', postData: {}});
    });
</script>
<form class="search-bar" method="post" id="searchParam">
    <div class="btn-group select">
        <button type="button" class="btn btn-default dropdown-toggle btn-select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            تولیدی<i class="fa fa-angle-down transition"></i>
        </button>
        <ul class="dropdown-menu searchType">
            <li>
                <a data-value="تولیدی" href="#" name="product" title="تولیدی">تولیدی</a>
            </li>
        </ul>
        <select name="type" id="type" class="hidden">
            <option value="تولیدی" <?= (isset($list['type']) && $list['type'] == 'تولیدی') ? 'selected' : '' ?>>تولیدی</option>
        </select>
    </div>
    <div class="keyboard-container-search-bar">
        <input type="text" name="q" id="q" class="place keyboard q" placeholder="کلیدواژه ..." value="<?php echo isset($list['q']) ? $list['q'] : '' ?>">
        <img class="icon hidden-xs hidden-sm" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/keyboard.png" alt="Persian On Screen Keyboard">
    </div>
    <button type="submit" class="submit text-large"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>
