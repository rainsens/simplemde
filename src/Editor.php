<?php

namespace Encore\Simplemde;

use Encore\Admin\Form\Field;

class Editor extends Field
{
    /**
     * @var string
     */
    protected $view = 'laravel-admin-simplemde::simplemde';

    /**
     * @var array
     */
    protected static $css = [
        'vendor/laravel-admin-ext/simplemde/dist/simplemde.min.css',
    ];

    /**
     * @var array
     */
    protected static $js = [
        'vendor/laravel-admin-ext/simplemde/dist/simplemde.min.js',
	    'vendor/laravel-admin-ext/simplemde/dist/codemirror-4.inline-attachment.min.js'
    ];

    /**
     * @var int
     */
    protected $height = 300;
    
    protected $upload_url = '/markdown/upload';

    /**
     * @param int $height
     * @return $this
     */
    public function height($height = 300)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $this->addVariables([
            'height'     => $this->height,
            'scopeClass' => 'simplemde-'.uniqid()
        ]);

        $name = $this->formatName($this->column);

        $config = (array) Simplemde::config('config');

        $config = json_encode($config);

        $varName = 'simplemde_'.uniqid();

        $this->script = <<<EOT
        
var inlineAttachmentConfig = {
    uploadUrl: '$this->upload_url',
    uploadFieldName: 'file',
    
};

var options = {element: $("#{$this->id}")[0]};

Object.assign(options, {$config});

var $varName = new SimpleMDE(options);

inlineAttachment.editors.codemirror4.attach($varName.codemirror, inlineAttachmentConfig);

$varName.codemirror.on("change", function(){
	var html = $varName.value();
    $('input[name=$name]').val(html);
});

EOT;
        return parent::render();
    }
}
