<?php 

namespace MyModule\ModuleDashRouter\Router;

use Magento\Framework\App\Router\Base;

class DashRouter extends Base
{
    protected function parseRequest(\Magento\Framework\App\RequestInterface $request){
        $output = parent::parseRequest($request);

        // dd($output);

        // $output['actionPath'] = isset($output['actionPath'])
        // ? str_replace('-', 'dash', $output['actionPath'])
        // : null;

        // $output['actionName'] = isset($output['actionName'])
        // ? str_replace('-', 'dash', $output['actionName'])
        // : null;
        $path = trim($request->getPathInfo(), '/');

        $params = explode('-', strlen($path) ? $path : $this->pathConfig->getDefaultPath());
 
        foreach ($this->_requiredParams as $paramName) {
            $output[$paramName] = array_shift($params);
        }

        for ($i = 0, $l = count($params); $i < $l; $i += 2) {
            $output['variables'][$params[$i]] = isset($params[$i + 1]) ? urldecode($params[$i + 1]) : '';
        }
        // dd($output);

        return $output;
    }
}