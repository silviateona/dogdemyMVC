<?php
/*
Router
PHP v. 7.1
*/

//associative array of routes aka the routing table
class Router{

	//protected means it is only accessible within the class and classes extending it
	protected $routes = [];
	protected $params = [];

	//add route with params to routing table array
	//params will be controllers, actions
	//@return void
	public function add($route, $params=[]){
		//$params is an optiona array
		//Convert the route to a regular expression: escape forward slashes
		//1st param: wot to look for (a forward slash), must be escaped to take literally
		//2nd param: wot to replace with: an escaped forward slash
		//3rd param: the string to be modified, our route, gotten from the address bar routing table in index.php
		$route=preg_replace('/\//','\/',$route);

		//Convert route sections to regular expression variable, ex. {controller}
		//we use {} to indicate a variable
		//1st param: what we search for: a word (letters and/or -sign) encapsulated in {}
		//2nd param: we replace with the word found written as a reg_ex: (?P<word as key>value)
		// the \1 notation indicates the 1st capture group found, aka ([a-z-]+)
		//3rd param: string we modify
		$route=preg_replace('/\{([a-z-]+)\}/','(?P<\1>[a-z-]+)',$route);

		//Add start and end delimiters and case sensitive flag
		$route='/^'.$route.'$/i';
		
		//current object's routes var declared above, key/value route/params
		$this->routes[$route]=$params;
	}

	//return the $routes array
	//@return array
	public function getRoutes(){
		return $this->routes;
	}

	/*
	* Match the incoming url route to the routes in the routing table
	* if a matchin route is found, set the corresponding params
	* return true if a route is found, false if not
	* @return boolean
	
	public function match($url){
		foreach($this->routes as $route=>$params){
			if($url==$route){
				//set the params variable declared above to params specified in router table
				$this->params=$params;
				return true;
			}
		}
		//if no match for the url to a route was found, return false
		return false;
	}
	*/
	//Match to the fixed url parameter formatted as controller/action/
	public function match($url){
		//start with captured group named controller, contains a to z and - at least once
		//followed by escaped /
		//followed by second captured group named action, contains a to z and -, at least once
		//the P is optional, for legacy PHP version compatibility, probably stands for Perl
		//$reg_exp="/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
			
			//Get named capture group values
			//$params =[];
			//match the regular expression to the provided url
			//store the captured groups, if a match is found, in associative array $matches
			//with controller as the key and action as the value
			//store the findings in $params Router property
		foreach($this->routes as $route=>$params){
			if(preg_match($route,$url,$matches)){
			foreach ($matches as $key=>$match){
							if(is_string($key)){
								$params[$key]=$match;
							}
						}
				$this->params=$params;
				return true;
			}
		}
		return false;
	}

	//get the currently matched parameters
	//@return array
	public function getParams(){
		return $this->params;
	}

}