<?php

require_once ROOT . "/class/FormatData.php";

class CommentManager extends FormatData
{
    private static $instance = null;
    private $query;

    private function __construct()
    {
        require_once ROOT . "/database/DBBuilder.php";
        require_once ROOT . "/class/Comment.php";
        require_once ROOT . "/utils/Query.php";
        $this->query = Query::getInstance();
    }

    /**
     * Create or retrieve the instance of class.
     *
     * @return object
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    /**
     * Fetch all comments.
     *
     * @return array
     */
    public function listComments(): array
    {
        try {
            $rows = $this->query
                ->select([
                    "comment.body",
                    "comment.created_at",
                    "comment.id",
                    "comment.news_id",
                ])
                ->from("comment")
                ->get();
            $comments = $this->formatCommentsData($rows);
            return [
                "error" => false,
                "data" => $comments,
            ];
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Insert new comment record to database
     *
     * @param string $body
     * @param int $newsId
     * @return array
     */
    public function addCommentForNews($body, $newsId): array
    {
        try {
            $res = [];
            if ($newsId && $body) {
                // Check News exist or not
                $check = $this->query
                    ->select(["id"])
                    ->from("news")
                    ->where("id=" . $newsId)
                    ->fetch();
                if ($check) {
                    $param = [
                        "body" => $body,
                        "created_at" => date("Y-m-d"),
                        "news_id" => $newsId,
                    ];
                    $insertedId = $this->query->insert("comment", $param);
                    $res["error"] = false;
                    $res["data"] = $insertedId;
                } else {
                    $res["error"] = true;
                    $res["message"] = MESSAGE["NewsNotFound"];
                }
            } else {
                $res["error"] = true;
                $res["message"] = MESSAGE["AddComment"];
            }
            return $res;
        } catch (\Exception $e) {
            return [
                "error" => false,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Delete news and its related comments
     *
     * @param int $id
     * @return array
     */
    public function deleteComment($id): array
    {
        try {
            $res = [];
            if ($id) {
                $this->query->delete("comment", $id);
                $res["error"] = false;
                $res["message"] = MESSAGE["DeleteSucces"];
            } else {
                $res["error"] = true;
                $res["message"] = MESSAGE["CommentDelete"];
            }
            return $res;
        } catch (\Exception $e) {
            return [
                "error" => true,
                "data" => $e->getMessage(),
            ];
        }
    }
}
