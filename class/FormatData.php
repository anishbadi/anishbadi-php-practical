<?php

class FormatData
{
    /**
     * Data format for all news.
     *
     * @param array $row
     * @return array
     */
    protected function formatNewsData($rows): array
    {
        try {
            $news = [];
			if (!empty($rows)) {
				foreach ($rows as $row) {
					$newsObj = new News();
					$comments = isset($row["comments"])
						? CommentManager::getInstance()->formatNewsComments(
							$row["comments"]
						)
						: [];
					$news[] = $newsObj
						->setId($row["id"])
						->setTitle($row["title"])
						->setBody($row["body"])
						->setComments($comments)
						->setCreatedAt($row["created_at"]);
				}
			}
            return $news;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Data format for all comment.
     *
     * @param array $row
     * @return array
     */
    protected function formatCommentsData($rows): array
    {
        try {
            $comments = [];
			if (!empty($rows)) {
				foreach ($rows as $row) {
					$commentObj = new Comment();
					$comments[] = $commentObj
						->setId($row["id"])
						->setBody($row["body"])
						->setCreatedAt($row["created_at"])
						->setNewsId($row["news_id"]);
				}
			}
            return $comments;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Data structure change for news comments.
     *
     * @param array $row
     * @return array
     */
    protected function formatNewsComments($comments): array
    {
        try {
			$comments = array_map(function ($input) {
				return explode(":", $input);
			}, explode(";", $comments));
			return $comments;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

?>
