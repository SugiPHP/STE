STE
===

STE stands for Sugi (or Simple) Template Engine. It is intended to be secure, lightweight and fast.

Unlike some of the famous template engines (like Smarty, Twig, etc.) the template code is
not converted (compiled) to PHP code and then evaluated, but parsed on the fly. Variables and
blocks are replaced with regular expressions (preg_replace function). This approach has
several benefits (and drawbacks). The STE code is light (currently only one file), it is
fast (compared to PHP convert-ions), but most of all it is secure - you can give anyone to
make a HTML template for your project and it is safe to use since no PHP code can be
injected in a template files. And here comes the cons using this approach - all the logic
should be done in the PHP code and then passed to the template engine. STE does not recognize
even simplest if-then-else statements.

Basic Use
---------

Template file: index.html
```HTML
<!DOCTYPE html>
<html>
<head>
	<title>{title}</title>
</head>
<body>
	<ul id="navigation">
		<!-- BEGIN navi -->
		<li><a href="{navi.link}">{navi.title}</a></li>
		<!-- END navi -->
	</ul>
</body>
</html>

```

PHP file:
```PHP

<?php

use SugiPHP\STE\Ste;

$tpl = new Ste();
// Load a file
$tpl->load(__DIR__"/index.html");
// or set a raw template from PHP $tpl->setTemplate($htmlTemplate);
// set a variable title
$tpl->assign("title", "My Site");
// sets several links at once - perfect for database results
$tpl->assign("navi", array(
	array("link" => "/blog", "title" => "My Blog"),
	array("link" => "http://gamegix.com", "title" => "Online games")
));
// parse the template
echo $tpl->parse();
?>
```

The output will be something like this:

```HTML
<!DOCTYPE html>
<html>
<head>
	<title>My Site</title>
</head>
<body>
	<ul id="navigation">
		<li><a href="/blog">My Blog</a></li>
		<li><a href="http://gamegix.com">Online games</a></li>
	</ul>
</body>
</html>
```
