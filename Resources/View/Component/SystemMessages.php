<?php
    $errors = $messages["error"];
    $successes = $messages["success"];
?>
<?php if(!empty($errors)): ?>
    <div class="error"><?php echo implode("<br>",$errors); ?></div>
<?php endif;?>

<?php if(!empty($successes)): ?>
    <div class="success"><?php echo implode("<br>",$successes); ?></div>
<?php endif;?>

