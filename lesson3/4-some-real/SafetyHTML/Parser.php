<?php

class Parser{
	protected array $tags = [];

	public function registerTag(string $name, string $class){
		$this->tags[$name] = $class;
	}

	/* maybe Exceptions, learn later */
	public function run(string $input) : Node {
		$data = json_decode($input); // check null etc
		return $this->parseNode($data);
	}

	protected function parseNode(object|string $data) : Node{
		if(is_string($data)){
			return new TextNode($data);
		}

		$tag = $this->getTagByName($data->name);
		
		if(is_object($data->attrs)){
			foreach($data->attrs as $name => $value){
				$tag->attr($name, $value);
			}
		}
		
		if($tag instanceof PairTag && is_array($data->children)){
			foreach($data->children as $child){
				$tag->appendChild($this->parseNode($child));
			}
		}

		return $tag;
	}

	protected function getTagByName(string $name) : Tag{
		if(!isset($this->tags[$name])){
			throw new Exception($name . ' is not allow tag!');
		}

		return new $this->tags[$name];
	}
}