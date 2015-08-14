Eloquent Image Mutator
======================

Relating an image with a model is always a pain. Eloquent Image Mutator provides an easy mutator for Eloquent models to save and retrieve images.

## Storing images with Model

```
    $user->profile_picture = \Input::file('image');
    $user->save();
```

## Retrieving images with Model

```
    // $user->profile_picture->thumbnail
    // $user->profile_picture->xsmall
    // $user->profile_picture->small
    // $user->profile_picture->profile
    // $user->profile_picture->medium
    // $user->profile_picture->large
```

## Installation

Add the following line to the `require` section of `composer.json`:

```json
{
    "require": {
        "sahusoftcom/eloquent-image-mutator": "dev-master"
    }
}
```

## Setup

1. In `/config/app.php`, add the following to `providers`:
  
  ```
  SahusoftCom\EloquentImageMutator\ImageMutatorProvider::class,
  ```
  
2. Run `php artisan vendor:publish`.

3. In `/config/image.php`, you will have the default target folder.
	
	```
	storage/app/uploads
	```
	
	If you want to use this detination as the upload folder, Do make the directories required i.e., `storage/app/uploads`.

4. In public folder you should have a soft-link pointing to the upload folder destination named `uploads`. You could do this by creating a soft link in public.Go to your projects public folder and

	```
	ln -s relative-path-to-destination-folder uploads
	```

## How to use

1. The field against which you want to store the image should be of type `text`.
2. You should use the `ImageFieldTrait` in the Model.
2. Define the columns you want to inculde for image uploads.

For example: 

	```
	<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use SahusoftCom\EloquentImageMutator\ImageFieldTrait;

	class Image extends Model
	{

	   	use ImageFieldTrait;

	   	/**
	   	 * The photo fields should be listed here.
	   	 *
	   	 * @var array
	   	 */
	   	protected $photo_fields = ['profile_picture', 'cover_photo'];
	    
	    /**
	     * The database table used by the model.
	     *
	     * @var string
	     */
	    protected $table = 'image';

	    /**
	     * The attributes that are mass assignable.
	     *
	     * @var array
	     */
	    protected $fillable = ['profile_picture', 'acn'];

	    /**
	     * The attributes excluded from the model's JSON form.
	     *
	     * @var array
	     */
	    protected $hidden = [];
	    .
	    .
	    .
	    
	}
	```

Thanks Enjoy!

## Customization

You could customize the target folder where the images are stored. For customizing goto `config/image.php`. Line no 6
```
'assets_upload_path' => 'storage/app/uploads',
```
and change the destination to your desired folder. Make sure the destination folder has all the permissions and the soft link in the public folder is pointing to the destionation folder.