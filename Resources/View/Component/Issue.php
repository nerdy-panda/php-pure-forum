<?php use App\Enum\IssueStatus ; ?>
<div class="question <?php echo $status?>" id="q-<?php echo $id?>">
    <?php componentIfLogin("IssueManager",["id" => $id , "status" => $status]);?>
    <div class="q"><span class="i">+</span><?php echo nl2br($body);?></div>
    <div class="r">
        <form action="" method="post" class="pure-form replyForm">
            <input name="qid" value="<?php echo $id?>" type="hidden"/>
            <textarea name="text" rows="5" placeholder="پاسخ دهید ..."></textarea>
            <input type="submit" name="submitAnswer" class="pure-button button-green submit"
                   value="ارسال پاسخ"/>
            <div class="clear"></div>
        </form>
    </div>
    <?php if($status == IssueStatus::answered->name): ?>
        <?php foreach ($answers as $answer) : ?>
            <?php $text = nl2br($answer["body"]); ?>
            <?php $jalaliStrDate = date_to_str($answer["created_at"]); ?>
            <div class="a">
                <?php echo $text?>
                <div class="date"><?php echo $jalaliStrDate; ?></div>
                <?php if(isLogin()) : ?>
                    <ul class="answer-management">
                        <li><a href="?issue=<?php echo $id;?>&delete=<?php echo $answer["id"]?>">حذف پاسخ</a></li>
                    </ul>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="delete-answer-controller" data-issue="<?php echo $id?>" data-answer="<?php echo $answer["id"]?>"><!--! Font Awesome Pro 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M164.2 39.5L148.9 64H299.1L283.8 39.5c-2.9-4.7-8.1-7.5-13.6-7.5H177.7c-5.5 0-10.6 2.8-13.6 7.5zM311 22.6L336.9 64H384h32 16c8.8 0 16 7.2 16 16s-7.2 16-16 16H416V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V96H16C7.2 96 0 88.8 0 80s7.2-16 16-16H32 64h47.1L137 22.6C145.8 8.5 161.2 0 177.7 0h92.5c16.6 0 31.9 8.5 40.7 22.6zM64 96V432c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V96H64zm80 80V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V176c0-8.8 7.2-16 16-16s16 7.2 16 16zm96 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V176c0-8.8 7.2-16 16-16s16 7.2 16 16zm96 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V176c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php elseif ($status == IssueStatus::pending->name ) : ?>
        <div class="a">این سوال هنوز تایید نشده !!!</div>
    <?php elseif ($status == IssueStatus::publish->name) : ?>
        <div class="a">هیچ پاسخی در سیستم برای این سوال پیدا نشد !!!</div>
    <?php endif;?>

</div>