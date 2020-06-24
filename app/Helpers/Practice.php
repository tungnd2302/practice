<?php
    namespace App\Helpers;

    class Practice{
        public static function ShowStatusButton($controllerName,$status,$id){
            $xhtml           = '';
            $buttonTemplates = config('myapp.template.buttonChangeStatus');
            $myButton        = (array_key_exists($status,$buttonTemplates)) ? $buttonTemplates[$status] : $buttonTemplates[2];
            $link            = route($controllerName.'changestatus',['status' => $status,'id' => $id]);
            $xhtml .= sprintf('<a href="%s" class="btn %s btn-round">%s</a>',$link,$myButton['class'],$myButton['name']);
            return $xhtml;
        }

        public static function ShowActionButton($controllerName,$id){
            $xhtml                 = '';
            $buttonActionTemplates = config('myapp.template.button');
            $myButton              = (array_key_exists($controllerName,$buttonActionTemplates)) ? $buttonActionTemplates[$controllerName] : $buttonActionTemplates['unknow'];

            $buttonTypeTemplate    = config('myapp.template.buttonType');
            foreach($myButton as $key => $value){
                $actionButton = (array_key_exists($value,$buttonTypeTemplate)) ? $buttonTypeTemplate[$value] : $buttonTypeTemplate['unknow'];
                $link   = route($controllerName . $actionButton['action'] , ['id' => $id]);
                $xhtml .= sprintf('<a href="%s" class="btn %s btn-round ml-1 mr-1">
                                    <i class = "%s"></i>
                                  </a>',$link,$actionButton['class'],$actionButton['icon']);
            }
            return $xhtml;
        }

        public static function countStatus($status){
           $buttonActionTemplates = config('myapp.template.buttonChangeStatus');
           $buttonActionTemplates = array_flip($buttonActionTemplates);
           foreach ($status as $key => $value) {
               $myButton = array_key_exists($key,$buttonActionTemplates) ? $buttonActionTemplates[$key] : $buttonActionTemplates[2];
           }
           echo '<pre>';
           print_r($status);
           echo '<pre>';
        }


    }

?>
