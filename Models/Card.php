<?php
class Card implements JsonSerializable
{
    public int $id;
    public mixed $title;
    public mixed $text;
    public mixed $createdate;

    public function __construct($id, $title, $text="", $createdate="")
    {
        $this->id = $id;
        $this->title=$title;
        $this->text = $text;
        $this->createdate = $createdate;
    }

    /**
     * @return mixed
     */
    public function getTitle(): mixed
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(mixed $title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCreateDate(): mixed
    {
        return $this->createdate;
    }

    /**
     * @return mixed
     */
    public function getText(): mixed
    {
        return $this->text;
    }

    /**
     * @param mixed $createDate
     */
    public function setCreateDate($createDate): void
    {
        $this->createdate = $createDate;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function jsonSerialize() : mixed
    {
        return get_object_vars($this);
    }

    public function  __toString() : string{
        return "id: $this->id title: $this->title text: $this->text createdate: $this->createdate";
    }
}