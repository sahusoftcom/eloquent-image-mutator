<?php

namespace SahusoftCom\EloquentImageMutator\Dist;

interface ImageFieldInerface {

	public function toJson();

	public static function fromJson($jsonData);	

	public function delete();

}
