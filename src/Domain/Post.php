<?php
namespace Blogg\Domain;

class Post {
	private $id;
	private $date;
	private $title;
	private $content;
	private $f_name;
	private $s_name;
	private $user_id;
	private $username;
	private $email;


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
		public function getAuthor(): string
				{
						return $this->f_name . ' ' . $this->s_name;
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
}
?>
