<?php 
/*
FRONT CONTROLLER
PHP v. 7.1
*/

// we'll use this page as a gateway to other pages through queries in address bar
//echo 'Requested URL = "'.$_SERVER['QUERY_STRING'].'"';

//Routing
require "../Core/Router.php";
$router = new Router();
//echo get_class($router);

//add the routes in $router array, with route/params key/value pairs, defined add function:
//home page aka index.php aka nothing in the address bar but the domain
// => is used for associative arrays, -> for methods/properties of objects in PHP
$router->add('',['controller'=>'Home','action'=>'index']);
$router->add('posts',['controller'=>'Posts','action'=>'index']);
//$router->add('posts/new',['controller'=>'Posts','action'=>'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');


/* display the routing table

** we can totally use , with echo, to enchainer expressions;
** faster than . which is just for string concatenation
** also, echo is not a function, and only accepts () for one expression;
** it's a "special language construct"
** the <pre> tag stands for preformatted text, to see our $router array nicely formatted

echo "<pre>", var_dump($router->getRoutes()),"</pre>";
*/

//Match the requested route (from typing in address bar)
$url=$_SERVER['QUERY_STRING'];
if ($router->match($url)){
	echo "<pre>", var_dump($router->getParams()),"</pre>";
} else{
	echo 'No route found for URL ',$url,'<br> Error 404 Page not found stand-in';
	echo '<br>',preg_replace('/\//','\/','{controller}/{action}');
}
