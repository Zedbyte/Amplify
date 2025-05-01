<?php

class HtmlHelper
{
    public static function purify($html)
    {
        require_once(Yii::getPathOfAlias('webroot.vendor.ezyang.htmlpurifier.library') . '/HTMLPurifier.auto.php');

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,br,strong,em,ul,ol,li,span,b,i,u,a[href|target],blockquote');
        $config->set('CSS.AllowedProperties', ['color', 'font-weight', 'font-style', 'text-decoration']);
        $config->set('HTML.DefinitionID', 'custom-definition');
        $config->set('HTML.DefinitionRev', 1);
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($html);
    }
}
