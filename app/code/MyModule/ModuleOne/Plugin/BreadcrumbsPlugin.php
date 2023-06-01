<?php
 
namespace MyModule\ModuleOne\Plugin;
 
class BreadcrumbsPlugin

{
    public function beforeAddCrumb(\Magento\Theme\Block\Html\Breadcrumbs $breadcrumbs, $crumbName, $crumbInfo)
    {
        
        if (isset($crumbInfo['label'])) {

            $crumbInfo['label'] = ($crumbInfo['label'].' (!)');
        }

        return [$crumbName,$crumbInfo];
    }

    // public function aroundAddCrumb(Breadcrumbs $breadcrumbs, callable $proceed, $crumbName, $crumbInfo)
    // {
    //     if (isset($crumbInfo['label'])) {
   
    //         $crumbInfo['label'] = __($crumbInfo['label'] . ' (!)');
    //     }

    //     $proceed($crumbName, $crumbInfo);
    // }
}