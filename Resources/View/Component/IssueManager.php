<div class="qManage br5">
    <span class="result" style="display: none">...</span>
    <span class="qmr">افزودن پاسخ</span> &nbsp; &nbsp;
    <span class="qm" id="qmd-<?php echo $id?>">حذف</span> &nbsp; &nbsp;
    <?php if($status=="pending"): ?>
        <span class="qm" id="qmpu-<?php echo $id?>">تائید</span> &nbsp; &nbsp;
    <?php endif; ?>
    <?php if($status != "pending") : ?>
        <span class="qm" id="qmpe-<?php echo $id?>">لغو تائید</span>
    <?php endif;?>
</div>