<?php
namespace Blogg\Domain;

class Tag {
	private $tags;
	private $tag_ids;

	public function getTags()
	{		
		$tags = explode(",", $this->tags);
		$ids = explode(",", $this->tag_ids);
		$tag_array = array_combine($ids, $tags);
		return $tag_array;
	}
}
?>
