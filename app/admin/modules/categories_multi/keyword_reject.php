<?php

use App\Models\Categories\Category;

require_once("../../bootstrap.php");
require_once 'inc_security.php';
checkAddEdit("add");

$id = getValue('id', 'int', 'GET', 0, 3);
$category = Category::where('cat_id = '.$id)->select();

$action = getValue('action', 'str', 'POST', '');
$exist = true;
$aiKeyword = \App\Models\CategoryAiKeyWord::where('cak_category_id='.$id)->select();
if(!$aiKeyword) {
    $exist = false;
    $aiKeyword = new \App\Models\CategoryAiKeyWord();
}

// Transformer
$strKeywordReject = unserialize($aiKeyword->cak_keyword_reject);
$strKeywordReject = $strKeywordReject ? implode(',', $strKeywordReject): "";

$tempArrayKeywordSimilar = unserialize($aiKeyword->cak_keyword_similar);
$strKeywordSimilar = [];

if($tempArrayKeywordSimilar) {
    foreach ($tempArrayKeywordSimilar as $key => $value) {
        $strKeywordSimilar[] = "$key=>$value";
    }
    $strKeywordSimilar = implode(",", $strKeywordSimilar);
} else {
    $strKeywordSimilar = "";
}

// Get query post
$keywordReject = getValue('keyword_reject', 'str', 'POST', $strKeywordReject);
$keywordSimilar = getValue('keyword_similar', 'str', 'POST', $strKeywordSimilar);

if($action == 'update') {
    // Validate
    $keywordReject = preg_replace('#\s+#', ' ', $keywordReject);
    $arrayKeywordReject = explode(',', mb_strtolower($keywordReject, "UTF-8"));
    $arrayKeywordReject = array_unique($arrayKeywordReject);

    $keywordSimilar = preg_replace('#\s+#', ' ', $keywordSimilar);
    $arrayKeywordSimilar = explode(',', mb_strtolower($keywordSimilar, "UTF-8"));
    $arrayKeywordSimilar = array_unique($arrayKeywordSimilar);

    $tempArrayKeywordSimilar = [];
    foreach($arrayKeywordSimilar as $pair) {
        $arrayPair = explode('=>', $pair);
        $tempArrayKeywordSimilar[$arrayPair[0]] = $arrayPair[1];
    }

    if($exist) {
        \App\Models\CategoryAiKeyWord::where('cak_category_id='.$id)
                                    ->update([
                                        'cak_keyword_reject' => serialize($arrayKeywordReject),
                                        'cak_keyword_similar' => serialize($tempArrayKeywordSimilar)
                                    ]);
    } else {
        \App\Models\CategoryAiKeyWord::insert([
            'cak_category_id' => $id,
            'cak_keyword_reject' => serialize($arrayKeywordReject),
            'cak_keyword_similar' => serialize($tempArrayKeywordSimilar)
        ]);
    }

    redirect("keyword_reject.php?id=".$id);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?=$load_header?>
</head>
<body>
    <div class="container">
        <h4>Danh mục: #<?php echo $category->cat_id ?>, <?php echo $category->cat_name; ?></h4>
        <form class="form" method="POST">
            <div class="form-group">
                <label class="control-label">Những từ vô nghĩa</label>
                <textarea class="form-control" name="keyword_reject" placeholder="a,b,c,d"><?php echo $keywordReject; ?></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Những từ tương đồng</label>
                <textarea class="form-control" name="keyword_similar" placeholder="a=>b,c=>d"><?php echo $keywordSimilar; ?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="update">
                <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                <a href="listing.php" class="btn btn-default btn-sm">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>

