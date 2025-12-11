<?php
    $useOld = isset($result) && !$result ;
    $fullName = $useOld ? $_POST["uName"] : "";
    $email  = $useOld ? $_POST["uMail"] : "" ;
    $mobile  = $useOld ? $_POST["uMobile"] : "" ;
    $issueText  = $useOld ? $_POST["uQuestion"] : "" ;
?>
<form action="" method="post" class="pure-form searchform">
    <input type="text" name="uName" placeholder="نام کامل شما" value="<?php echo $fullName;?>" />
    <input type="text" name="uMail" class="ltr" placeholder="ایمیل شما" value="<?php echo $email?>"/>
    <input type="text" name="uMobile" class="ltr" placeholder="شماره موبایل شما" value="<?php echo $mobile?>"/>
    <textarea type="text" name="uQuestion" placeholder="متن سوال شما"><?php echo $issueText ?></textarea>
    <input type="submit" name="submitQuestion" value="ارسال سوال"
           class="pure-button button-green">
</form>