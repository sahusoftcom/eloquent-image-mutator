<?php

namespace SahusoftCom\EloquentImageMutator\Dist;

use Config;

class ImageFile
{
	public $url = null;
	public $height = null;
	public $width = null;

	public function __construct()
	{
        $default = Config::get('image.default');

        $this->url = $default['url'];
        $this->height = $default['height'];
        $this->width = $default['width'];
	}	
}