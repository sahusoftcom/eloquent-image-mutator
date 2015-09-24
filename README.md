Eloquent Image Mutator Version: 2^
======================

Relating an image with a model is always a pain. Eloquent Image Mutator provides an easy mutator for Eloquent models to save and retrieve images.

## Storing images with Model

Upload using a form

```
    $user->profile_picture = \Input::file('image');
    $user->save();
```

OR

Upload using a public URL (We will download and store the image for you)

```
    $user->profile_picture = https://scontent.fbom1-2.fna.fbcdn.net/hprofile-xaf1/v/t1.0-1/p160x160/11659393_10207093577848521_887484828555984342_n.jpg?oh=089042c5f4afa05e0dcbde51130c0eea&oe=56689CB9;
    $user->save();
```

OR

Copy already present Image Object

```
	$user->profile_picture = $user->photo_one;
	$user->save();
```

note:- 

The `$user->photo_one` should be a added to
	`protected $image_fields` 

And its model should 
	`use EloquentImageMutatorTrait;`

## Retrieving images with Model

```
     $user->profile_picture->thumbnail->url
     $user->profile_picture->xsmall->url
     $user->profile_picture->small->url
     $user->profile_picture->profile->url
     $user->profile_picture->medium->url
     $user->profile_picture->large->url
     $user->profile_picture->original->url
```

You can even access the height and width

```
	$user->profile_picture->large->height
	$user->profile_picture->large->width
```

Eg (In blade file):-

 ```
    <img src="{{ $user->profile_picture->profile->url }}" />
 ```
## Update Or Delete Images

If you update a field with a new image the old image is deleted from the system.

OR

If you delete a record from a the table the image is deleted.

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
  SahusoftCom\EloquentImageMutator\EloquentImageMutatorProvider::class,
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
2. You should use the `EloquentImageMutatorTrait` in the Model.
2. Define the columns you want to inculde for image uploads.

For example: 

	```
	<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

	class User extends Model
	{

	   	use EloquentImageMutatorTrait;

	   	/**
	   	 * The photo fields should be listed here.
	   	 *
	   	 * @var array
	   	 */
	   	protected $image_fields = ['profile_picture', 'cover_photo'];
	    
	    /**
	     * The database table used by the model.
	     *
	     * @var string
	     */
	    protected $table = 'users';

	    /**
	     * The attributes that are mass assignable.
	     *
	     * @var array
	     */
	    protected $fillable = ['profile_picture', 'cover_photo'];

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

And to then with the user object you can just use it like a property

Example:

*Storing images with Model*

```
    $user->profile_picture = \Input::file('image');
    $user->save();
```

*Retrieving images with Model*

```
     $user->profile_picture->thumbnail->url
     $user->profile_picture->xsmall->url
     $user->profile_picture->small->url
     $user->profile_picture->profile->url
     $user->profile_picture->medium->url
     $user->profile_picture->large->url
     $user->profile_picture->original->url
```

Thanks!

## Customization

You could customize the target folder where the images are stored. For customizing goto `config/image.php`. Line no 6
```
'assets_upload_path' => 'storage/app/uploads',
```
and change the destination to your desired folder. Make sure the destination folder has all the permissions and the soft link in the public folder is pointing to the destionation folder.


====================================================

Eloquent Image Mutator Version: 1.*
======================

Relating an image with a model is always a pain. Eloquent Image Mutator provides an easy mutator for Eloquent models to save and retrieve images.

## Storing images with Model

```
    $user->profile_picture = \Input::file('image');
    $user->save();
```

## Retrieving images with Model

```
     $user->profile_picture->thumbnail
     $user->profile_picture->xsmall
     $user->profile_picture->small
     $user->profile_picture->profile
     $user->profile_picture->medium
     $user->profile_picture->large
```

Eg (In blade file):-

 ```
    <img src="{{ $user->profile_picture->profile }}" />
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
  SahusoftCom\EloquentImageMutator\EloquentImageMutatorProvider::class,
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
2. You should use the `EloquentImageMutatorTrait` in the Model.
2. Define the columns you want to inculde for image uploads.

For example: 

	```
	<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

	class User extends Model
	{

	   	use EloquentImageMutatorTrait;

	   	/**
	   	 * The photo fields should be listed here.
	   	 *
	   	 * @var array
	   	 */
	   	protected $image_fields = ['profile_picture', 'cover_photo'];
	    
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
	    protected $fillable = ['profile_picture', 'cover_photo'];

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

And to then with the user object you can just use it like a property

Example:

*Storing images with Model*

```
    $user->profile_picture = \Input::file('image');
    $user->save();
```

*Retrieving images with Model*

```
     $user->profile_picture->thumbnail
     $user->profile_picture->xsmall
     $user->profile_picture->small
     $user->profile_picture->profile
     $user->profile_picture->medium
     $user->profile_picture->large
```

Thanks!

## Customization

You could customize the target folder where the images are stored. For customizing goto `config/image.php`. Line no 6
```
'assets_upload_path' => 'storage/app/uploads',
```
and change the destination to your desired folder. Make sure the destination folder has all the permissions and the soft link in the public folder is pointing to the destionation folder.
