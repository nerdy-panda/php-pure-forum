<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title><?php echo TITLE?></title>
    <link rel="stylesheet" href="css/pure.css" type="text/css"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js" defer></script>
</head>
<body>
<?php componentIfLogin("AdminBar",);?>
<div class="main">
    <?php component("SystemMessages",["messages" => $messageBag ]);?>
    <div class="pure-g">
        <div class="pure-u-1 header">
            <div class="inner">
                <a href="<?php echo url();?>"><h1><?php echo TITLE?></h1></a>
                <form action="" method="get" class="pure-form searchform">
                    <?php $hasStatus = has_status(); ?>
                    <select name="status">
                        <option value="all">همه</option>
                        <?php if($isLogin): ?>
                            <option value="pending" <?php echo selected_by_status("pending");?>>منتظر تائید</option>
                        <?php endif;?>
                        <option value="publish" <?php echo selected_by_status("publish");?>>بدون پاسخ</option>
                        <option value="answered" <?php echo selected_by_status("answered");?>>پاسخ داده شده</option>
                    </select>
                    <input type="text" name="search" id="s" value="<?php echo has_search() ? $_GET["search"] : "" ?>"/>
                    <button class="pure-button button-green">جستجو</button>
                </form>
            </div>
        </div>
    </div>

    <div class="pure-g">
        <div class="pure-u-1-5 sidebar">
            <div class="inner">
                <div class="menu">
                    <div class="menu-title">طرح سوال :</div>
                    <div class="menu-content">
                        <?php component("IssueForm",["result"=> $issueFormValidation ?? null ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="pure-u-4-5 content">
            <div class="inner">
                <div class="qTitle">لیست سوالات مطرح شده :</div>
                <?php component("DisplayIssues",["issues" => $issues ]);?>
            </div>
            <?php if($issuesCount) : ?>
                <div class="pagination clearfix">
                    <?php if($currentPage != 1 ) : ?>
                        <a href="?<?php echo page_query_string(1); ?>">«</a>
                    <?php endif; ?>
                    <?php for($counter = 1 ; $counter <= $pageCount ; $counter++) : ?>
                        <?php if($currentPage == $counter) : ?>
                            <strong><?php echo $counter; ?></strong>
                        <?php else : ?>
                            <a href="?<?php echo page_query_string($counter)?>"><?php echo $counter?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if($currentPage != $pageCount) : ?>
                        <a href="?<?php echo page_query_string($pageCount);?>">»</a>
                    <?php endif;?>
                </div>
            <?php endif;?>

        </div>
    </div>
    <div class="pure-g">
        <div class="pure-u-1 footer">
            <div class="inner">تمامی حقوق محفوط است ...</div>
        </div>
    </div>

</div>
<script src="js/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<?php componentIfLogin("AdminFooterScripts");?>
</body>
</html>
