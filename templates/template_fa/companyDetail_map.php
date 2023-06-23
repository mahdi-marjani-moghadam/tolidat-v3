<?php //print_r_debug($branch['position']) ?>


<!-- separator -->
<div class="row xxxsmallSpace"></div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 company-detail">

        <div class="company_map" data-value="
        <?php
        if ($branch['Branch_id'] == 0) { echo 'aaa'; }
        if ($branch['Branch_id'] == 7) { echo 'bbb'; }
        if ($branch['Branch_id'] == 8) { echo 'ccc'; }
        ?>"></div>

        <?php foreach ($branch['position'] as $key => $position): ?>
            <input type="hidden" class="x" value="<?php echo $position['x'] ?>">
            <input type="hidden" class="y" value="<?php echo $position['y'] ?>">
        <?php endforeach; ?>
        <!-- separator -->
        <div class="row xxxsmallSpace"></div>
    </div>
</div>
