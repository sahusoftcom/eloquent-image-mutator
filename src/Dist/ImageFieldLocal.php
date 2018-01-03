<?php

namespace SahusoftCom\EloquentImageMutator\Dist;

use SahusoftCom\EloquentImageMutator\Dist\ImageFile;
use SahusoftCom\EloquentImageMutator\Dist\ImageService;
use Config;

class ImageFieldLocal implements ImageFieldInerface
{
	public function __construct($dimensions=[])
	{
		if(count($dimensions) < 1){
			$dimensions = Config::get('image.dimensions');
		    foreach ($dimensions as $key => $value) {
		    	$this->{$value[4]} = new ImageFile();
		    }
		    $this->orignal = new ImageFile();
		    $this->original = new ImageFile();
		    return $this;
		}
		
		foreach ($dimensions as $key => $value) {
			
			if($key == 'orignal'){
					
				$this->$key = new ImageFile();
				$this->$key->url = !empty($value['url']) ? $value['url'] : null;
				$this->$key->height = !empty($value['height']) ? $value['height'] : null;
				$this->$key->width = !empty($value['width']) ? $value['width'] : null;
				$key = 'original';
			}
			
			$this->$key = new ImageFile();
			$this->$key->url = !empty($value['url']) ? $value['url'] : null;
			$this->$key->height = !empty($value['height']) ? $value['height'] : null;
			$this->$key->width = !empty($value['width']) ? $value['width'] : null;
		}
	}	

	public function toJson()
	{
		return json_encode($this);
	}

	public function delete()
	{
		$thisArray = json_decode($this->toJson(), true);
		foreach($thisArray as $key => $item) {
			if(!empty($item['url']) && file_exists(public_path().$item['url']))
				ImageService::delete(public_path().$item['url']);
		}

		return true;
	}	

	public static function fromJson($jsonData=null)
	{
		if(!empty($jsonData))
			return new self(json_decode($jsonData, true));

		return new self();
	}
}