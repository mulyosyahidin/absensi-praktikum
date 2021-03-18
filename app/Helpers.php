<?php
if (!function_exists('getController')) {
    /**
     * Mendapatkan nama controller
     * 
     * Mendapatkan nama controller yang sedang diakses
     * 
     * @since   1.0.0
     * @author  mulyosyahidin95
     * 
     * @return String   nama controller
     */
    function getController()
    {
        $action = app('request')->route()->getAction();
        $route = class_basename($action['controller']);

        list($controller, $action) = explode('@', $route);

        return $controller;
    }
}

if (!function_exists('getAction')) {
    /**
     * Mendapatkan nama method
     * 
     * Mendapatkan nama method yang sedang diakses
     * 
     * @since   1.0.0
     * @author  mulyosyahidin95
     * 
     * @return  String  nama method
     */
    function getAction()
    {
        $action = app('request')->route()->getAction();
        $route = class_basename($action['controller']);

        list($controller, $action) = explode('@', $route);

        return $action;
    }
}

if (!function_exists('isController')) {
    /**
     * Memeriksa controller
     * 
     * Memeriksa apakah controller yang sedang diakses adalah
     * controller `$controller`
     * 
     * @param mixed $controller
     * 
     * @since   1.0.0
     * @author  mulyosyahidin95
     * 
     * @return Bool hasil pemeriksaan
     */
    function isController($controller)
    {
        return ($controller === getController());
    }
}

if (!function_exists('isAction')) {
    /**
     * Memeriksa method
     * 
     * Memeriksa apakah method yang sedang diakses adalah
     * method `$action`
     * 
     * @param mixed $action
     * 
     * @since   1.0.0
     * @author  mulyosyahidin95
     * 
     * @return  Bool hasil pemeriksaan
     */
    function isAction($action)
    {
        return ($action === getAction());
    }
}

if (!function_exists('__active')) {
    /**
     * Membuat class `.active`
     * 
     * Membuat class `.active` jika controller dan method
     * yang sedang diakses sesuai dengan
     * kondisi yang diberikan
     * 
     * @param string $controller
     * @param string $action
     * @param string $param
     * 
     * @since   1.0.0
     * @author  mulyosyahidin95
     * 
     * @return String   html class .active
     */
    function __active($controller = '', $action = '', $param = '')
    {
        $phpSelf = $_SERVER['PHP_SELF'];

        if ($controller === '' && $action === '') {
            return ' active';
        } else if ($param !== '') {
            if (isController($controller) && isAction($action)) {
                if (strpos($phpSelf, $param) !== FALSE) {
                    return ' active';
                }
            }
        } else if (is_array($controller) && count($controller)) {
            foreach ($controller as $c) {
                if (isController($c)) {
                    return ' active';
                    break;
                }
            }
        } else if (is_array($action) && count($action) > 0) {
            foreach ($action as $method) {
                if (isController($controller) && isAction($method)) {
                    return ' active';
                    break;
                }
            }
        } else if (isController($controller) && isAction($action)) {
            return ' active';
        } else if ($controller !== '' && $action === '') {
            return isController($controller) ? ' active' : '';
        }
    }
}
