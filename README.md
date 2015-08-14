Sahusoft Image Mutator
=========

A Image Mutator for Laravel 5. 

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
	
## Customization

You could customize the target folder where the images are stored. For customizing goto `config/image.php`. Line no 6
```
'assets_upload_path' => 'storage/app/uploads',
```
and change the destination to your desired folder. Make sure the destination folder has all the permissions and the soft link in the public folder is pointing to the destionation folder.