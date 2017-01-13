<?php

Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('truncate');

    return preg_replace(
        $pattern,
        '$1'.PHP_EOL
        .'<?php $t = $2." "; ?>'.PHP_EOL
        .'<?php $t = substr($t,0,10); ?>'.PHP_EOL
        .'<?php $t = substr($t,0,strpos($t, " ")); ?>'.PHP_EOL
        .'<?php $t = $t."...."; ?>'.PHP_EOL
        .'<?php echo $t; ?>',
        $view
    );
});


//$text = $text." ";
//$text = substr($text,0,$chars);
//$text = substr($text,0,strrpos($text,' '));
//$text = $text."...";
//return $text;