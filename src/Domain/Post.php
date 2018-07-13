<?php
namespace Blogg\Domain;

class Post {
	private $id;
	private $date;
	private $title;
	private $content;
	private $user_id;
	private $username;
	private $email;
	private $cat_name;
	private $cat_id;
	private $author;
	private $tags;
	private $tag_ids;



  public function getId(): int
	    {
	        return $this->id;
	    }
	public function getDate(): string
			{
				return $this->date;
			}
  public function getTitle(): string
	    {
	        return $this->title;
	    }
	public function getContent(): string
	{
		return $this->content;
	}
	public function getAuthor()
			{
			return $this->author;
			}
	public function getUserId(): string
			{
				return $this->user_id;
			}
	public function getUserName(): string
			{
				return $this->username;
			}
	public function getEmail(): string
			{
				return $this->email;
			}
	public function getCat(): string
	{
		return $this->cat_name;
	}
	public function getCatId(): string
	{
		return $this->cat_id;
	}
	public function getTags(): array
	{
		$tags = explode(",", $this->tags);
		$ids = explode(",", $this->tag_ids);
		$tag_array = array_combine($ids, $tags);
		return $tag_array;
	}
}
?>
