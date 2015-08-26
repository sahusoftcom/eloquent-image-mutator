<?php

return array(
    'library'     => 'gd',
    'upload_dir'  => 'uploads',
    'assets_upload_path' => 'storage/app/uploads',
    'quality'     => 85,
    'dimensions'  => [
        ['50','50',true, 85, 'thumbnail'],
        ['160','120',false, 85, 'xsmall'],
        ['240','180',false, 85, 'small'],
        ['300','300',true, 85, 'profile'],
        ['640','480',false, 85, 'medium'],
        ['800','600',false, 85, 'large']
    ]
);