Simplemde enhanced editor extension for laravel-admin which supports uploading image.
======

[Simplemde](https://github.com/sparksuite/simplemde-markdown-editor) is a great markdown editor, this extension is used to integrate `Simplemde` into the `laravel-admin` form.

## Screenshot

![wx20180906-130207](https://user-images.githubusercontent.com/1479100/45136112-3deea300-b1d5-11e8-984d-9d1c8d53c97d.png)

## Installation

```bash
composer require laravel-admin-ext/simplemde
composer require intervention/image
```

Then
```bash
php artisan vendor:publish --tag=laravel-admin-simplemde
php artisan storage:link
```

## Configuration

In the `extensions` section of the `config/admin.php` file, add some configuration that belongs to this extension.
```php

    'extensions' => [

        'simplemde' => [
        
            // Set to false if you want to disable this extension
            'enable' => true,
            
            // Set upload url for attachment
            'upload_url' => 'attachments/upload',
            
            // If you want to set an alias for the calling method
            //'alias' => 'markdown',
            
            // Editor configuration
            'config' => [
                
            ]
        ]
    ]

```

The configuration of the editor can be found in [Simplemde Documentation](https://github.com/sparksuite/simplemde-markdown-editor#configuration)
```php
    'config' => [
        'autofocus'   => true,
        'placeholder' => 'xxxx',
        ....
    ]
```

## Usage

Use it in the form:
```php
$form->simplemde('content');
```

Set height
```php
$form->simplemde('content')->height(500);
```

If the method alias is specified in the configuration as `markdown`
```php
$form->markdown('content');
```

License
------------
Licensed under [The MIT License (MIT)](LICENSE).
