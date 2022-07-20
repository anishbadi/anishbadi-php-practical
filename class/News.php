<?php

class News
{
    protected $id, $title, $body, $comments, $createdAt;

    /**
     * Set news id.
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
     * get news id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set news title.
     *
     * @param string $title
     * @return object
     */
    public function setTitle($title): object
    {
        $this->title = $title;

        return $this;
    }

    /**
     * get news title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set news body.
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
     * get news body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set news comment.
     *
     * @param array $comments
     * @return object
     */
    public function setComments($comments): object
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * get news comments.
     *
     * @return ?array
     */
    public function getComments(): ?array
    {
        return $this->comments;
    }

    /**
     * Set news create at.
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
     * get news create time.
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
