<?php if(array_is_empty($issues)) : ?>
    <div class="notfound">
        هیچ مشکل و یا سوالی پیدا نشد !!!
    </div>
<?php else : ?>
    <?php foreach ($issues as $issue) : ?>
        <?php
        component("Issue",[
            "id" => $issue["id"] ,
            "body" => $issue["body"] ,
            "status" => $issue["status"] ,
            "answers" => $issue["answers"] ?? [] ,
            "created" => $issue["created_at"]
        ]);
        ?>
    <?php endforeach;?>
<?php endif ?>
