<?php

namespace mf\router;

class Router extends AbstractRouter {

    public static $routes;
    public static $aliases;
    
    public function __construct() {
        parent::__construct();
    }

    public function addRoute($name, $url, $ctrl, $mth) {
        self::$routes[$url] = [$ctrl, $mth];
        self::$aliases[$name] = $url;
    }

    public function setDefaultRoute($url) {
        self::$aliases['default'] = $url;
    }

    public function run() {
    
        $url = $this->http_req->path_info;
        
        if(array_key_exists($url, self::$routes)) {
            $ctrl_class = self::$routes[$url][0];
            $mth = self::$routes[$url][1];
            
            $ctrl_obj = new $ctrl_class();
            echo $ctrl_obj->$mth();
        } else {
            $default_url = self::$aliases['default'];
            $default_ctrl_class = self::$routes[$default_url][0];
            $default_mth= self::$routes[$default_url][1];;
           
            $default_ctrl_obj = new $default_ctrl_class();
            echo $default_ctrl_obj->$default_mth();
            
        }
    }

    public function urlFor($route_name, $param_list=[]) {
        
        $url = self::$aliases[$route_name];
        $fullUrl = $this->http_req->script_name . $url;
        
        if (count($param_list) > 0) {
            $fullUrl .= "?";

            for ($i=0; $i < count($param_list) ; $i++) { 
                if($i == (count($param_list) - 1)) {
                    $fullUrl .= $param_list[$i][0] . '=' . $param_list[$i][1];

                } else {
                    $fullUrl .= $param_list[$i][0] . '=' . $param_list[$i][1] . '&amp;';
              }

            }   
        }

        return $fullUrl;
    }

    // !! : Gérer erreur/exception toussa toussa
    public static function executeRoute(string $alias) {
        $url = self::$aliases[$alias];
        $ctrl_class = self::$routes[$url][0];
        $mth = self::$routes[$url][1];

        $ctrl_obj = new $ctrl_class();
        echo $ctrl_obj->$mth();
    }

}



