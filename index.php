<?php

define("ROOT", __DIR__);
require_once ROOT . "/utils/NewsManager.php";
require_once ROOT . "/utils/CommentManager.php";
define("MESSAGE", include "message.php");

$newsData = NewsManager::getInstance()->listNewsWithComment();
foreach ($newsData["data"] as $news) {
    echo "<pre>";
    echo "############ NEWS " . $news->getTitle() . " ############\n";
    echo $news->getBody() . "\n";
    if (!empty($news->getComments())) {
        foreach ($news->getComments() as $comment) {
            $commentId = isset($comment[0]) ? $comment[0] : "";
            $comment = isset($comment[1]) ? $comment[1] : "";
            echo "Comment " . $commentId . " : " . $comment . "\n";
        }
    }
}
