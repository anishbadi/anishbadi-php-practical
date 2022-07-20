<?php

require_once ROOT . "/class/FormatData.php";

class NewsManager extends FormatData
{
    private static $instance = null;
    private $query;

    private function __construct()
    {
        require_once ROOT . "/utils/CommentManager.php";
        require_once ROOT . "/class/News.php";
        require_once ROOT . "/utils/Query.php";
        $this->query = Query::getInstance();
    }

    /**
     * Create or retrieve the instance of class.
     *
     * @return object
     */
    public static function getInstance(): object
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    /**
     * Fetch all news with their comments.
     *
     * @return array
     */
    public function listNewsWithComment(): array
    {
        try {
            $rows = $this->query
                ->select([
                    "news.id",
                    "news.title",
                    "news.body",
                    "news.created_at",
                    'GROUP_CONCAT(CONCAT_WS(":", comment.id, comment.body) SEPARATOR ";") as comments',
                ])
                ->from("news")
                ->leftJoin("comment ON comment.news_id = news.id")
                ->groupBy("news.id")
                ->get();
            return [
                "error" => false,
                "data" => $this->formatNewsData($rows),
            ];
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Fetch all news.
     *
     * @return array
     */
    public function listNews(): array
    {
        try {
            $rows = $this->query
                ->select([
                    "news.id",
                    "news.title",
                    "news.body",
                    "news.created_at",
                ])
                ->from("news")
                ->get();
            return [
                "error" => false,
                "data" => $this->formatNewsData($rows),
            ];
        } catch (\Exception $e) {
            return [
                "error" => true,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Insert new news record to database
     *
     * @param string $title
     * @param string $body
     * @return array
     */
    public function addNews($title, $body): array
    {
        try {
            $res = [];
            if ($title && $body) {
                $param = [
                    "title" => $title,
                    "body" => $body,
                    "created_at" => date("Y-m-d"),
                ];
                $id = $this->query->insert("news", $param);
                $res["error"] = false;
                $res["data"] = $id;
            } else {
                $res["error"] = true;
                $res["message"] = MESSAGE["AddNews"];
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
    public function deleteNews($id): array
    {
        try {
            $res = [];
            if ($id) {
                $this->query->delete("news", $id);
                $res["error"] = false;
                $res["message"] = MESSAGE["DeleteSucces"];
            } else {
                $res["error"] = true;
                $res["message"] = MESSAGE["NewsDelete"];
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

?>
