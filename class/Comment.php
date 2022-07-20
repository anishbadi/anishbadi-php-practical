<?php

class Comment
{
    protected $id, $body, $createdAt, $newsId;

    /**
     * Set comment id.
     *
     * @param int $id
     * @return object
     */
    public function setId($id): object
    {
        $this->id = $id;

        return $this;
    }

    /**
     * get comment id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set comment body.
     *
     * @param string $body
     * @return object
     */
    public function setBody($body): object
    {
        $this->body = $body;

        return $this;
    }

    /**
     * get comment body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set comment create at.
     *
     * @param string $createdAt
     * @return object
     */
    public function setCreatedAt($createdAt): object
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * get comment body.
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * get comment news Id.
     *
     * @return int
     */
    public function getNewsId(): int
    {
        return $this->newsId;
    }

    /**
     * Set comment news id.
     *
     * @param int $id
     * @return object
     */
    public function setNewsId($newsId): object
    {
        $this->newsId = $newsId;

        return $this;
    }
}
