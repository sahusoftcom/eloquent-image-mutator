<?php 

namespace SahusoftCom\EloquentImageMutator;

use SahusoftCom\EloquentImageMutator\Dist\ImageService;
use SahusoftCom\EloquentImageMutator\Dist\ImageField;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait EloquentImageMutatorTrait 
{

    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);

        if(in_array($key, $this->image_fields))
        {
            $value = $this->retrievePhotoFieldValue($key, $value);

            if(!file_exists(public_path().$value->orignal->url) || empty($value->orignal->url)) {
                $value = ImageService::getImageObject();
                $this->attributes[$key] = $value->toJson();
            }
        }

        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->image_fields) && $value)
        {
            if(empty($value))
                return parent::setAttribute($key, $value);

            switch (get_class($value)) {

                case 'Symfony\Component\HttpFoundation\File\UploadedFile':
                        return $this->setImageAttributeForUploadedFileObject($key, $value);
                    break;
                case 'SahusoftCom\EloquentImageMutator\Dist\ImageFieldLocal':
                        return $this->setImageAttributeForImageFieldLocalObject($key, $value);
                    break;
                
                // case 'value':
                //     # code...
                //     break;
                
            }

        }

        return parent::setAttribute($key, $value);
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function($model)
        {
            $oldObject = $model->getOriginal();
            $imageFields = $model->image_fields;
            
            if(count($imageFields) > 0) {
                foreach ($imageFields as $key => $value) {
                    
                    if(empty($oldObject[$value]))
                        continue;

                    $imageObject = ImageService::getImageObject($oldObject[$value]);
                    if($imageObject && !empty($imageObject->orignal->url) && $model->$value->orignal->url != $imageObject->orignal->url) {
                        $imageObject->delete();
                    }
                }
            }

        });

        static::deleted(function($model)
        {
            $imageFields = $model->image_fields;
            
            if(count($imageFields) > 0) {
                foreach ($imageFields as $key => $value) {
                    $model->$value->delete();
                }
            }

        });

    }

    public function retrievePhotoFieldValue($key, $value)
    {
        return ImageService::getImageObject($value);
    }

    public function setImageAttributeForUploadedFileObject($key, $value)
    {
        $imageFieldObject = ImageService::uploadImage($key, $value);
        $this->attributes[$key] = $imageFieldObject->toJson();
    }

    public function setImageAttributeForImageFieldLocalObject($key, $value)
    {
        $imageFieldObject = ImageService::copyImage($key, $value);
        $this->attributes[$key] = $imageFieldObject->toJson();
    }

    // public function setImageAttributeForUrlString($key, $value)
    // {
    //     return $this->setImageAttributeForFileObject($key, $value);
    // }

}