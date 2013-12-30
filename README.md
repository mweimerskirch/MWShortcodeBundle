Bundle that provides a Twig filter to support WordPress-like shortcodes.

Important: It's an early prototype!

Currently supported are tags of this form:
* <code>[demo]</code> (simple tags)
* <code>[demo var=xxx var2=yyy]</code> (tags with unquoted attributes)

Not yet supported are:
* <code>[demo]...[/demo]</code> (tags with embedded content)
* <code>[demo var="xxx"]</code> (tags with quoted attributes)

###Installation


Add MWShortcodeBundle in your composer.json:

```
{
    "require": {
        "mw/shortcode-bundle": "dev-master"
    }
}
```

Register the bundle in AppKernel

```
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new MW\Bundle\ShortcodeBundle\MWShortcodeBundle(),
    );
}
```

##How to use:

###1. Create a new shortcode handler

``` php
<?php

namespace MyProject\Bundle\TestBundle\Shortcode;

use MW\Bundle\ShortcodeBundle\Shortcode\BaseShortcode;

class DemoShortcode extends BaseShortcode
{

    public function parse($options)
    {
        // TODO: Render your content
        return 'Shortcode content';
    }

}
```

###2. Define the shortcode as a service (the alias will be the name of your shortcode):

``` xml
<service id="myproject.shortcode.demo" class="MyProject\Bundle\TestBundle\Shortcode\DemoShortcode">
    <tag name="mw.shortcode" alias="demo" />
</service>
```

###3. Use it in your Twig templates

``` html
<div>{{ page.content|shortcodes }}</div>
```
