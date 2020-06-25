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
                $link   = route($controllerName . $value , ['id' => $id]);
                $xhtml .= sprintf('<a href="%s" class="btn %s btn-round ml-1 mr-1">
                                    <i class = "%s"></i>
                                  </a>',$link,$actionButton['class'],$actionButton['icon']);
            }
            return $xhtml;
        }

        public static function countStatus($status,$controllerName,$params){
          $xhtml = '';
          $buttonTemplates = config('myapp.template.buttonChangeStatus');
          $totalCount = 0;
          foreach ($status as $item) {
              $status = array_key_exists($item['status'], $buttonTemplates) ? $buttonTemplates[$item['status']] : $buttonTemplates[2];
              $link   = '?status='.$item['status'];
              if($params['fieldSearch']){
                $link .= '&fieldSearch='.$params['fieldSearch'] .'&contentSearch='.$params['contentSearch'];
              }
              $xhtml .= sprintf('<a href="%s" class="btn %s mr-1">
                                    %s <span class="badge badge-light">%s</span>
                                 </a>',$link,$status['class'],$status['name'],$item['count']);
              $totalCount += $item['count'];
          }
          $link = route($controllerName);
          if($params['fieldSearch']){
            $link .= '?fieldSearch='.$params['fieldSearch'] .'&contentSearch='.$params['contentSearch'];
          }
          $xhtml .= sprintf('<a href="%s" class="btn %s mr-1">
                                    %s <span class="badge badge-light">%s</span>
                                 </a>',$link,'btn-info','Tất cả',$totalCount);
          return $xhtml;
        }


    }

?>
