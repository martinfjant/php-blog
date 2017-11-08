<?
namespace Blogg\Domain;

class Post {
	private $id;
	private $date;
	private $title;
	private $content;

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
}
?>