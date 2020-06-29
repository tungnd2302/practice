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

        public static function addPermission(){
          $xhtml = '';
          $configs = [
            'user' => 'Quản lý người dùng',
            'role' => 'Quản lý chức vụ',
            'permission' => 'Quản lý phân quyền',
            'post' => 'Quản lý bài viết',
            'test' => 'Quản lý bộ đề',
            'account' => 'Quản lý tài khoản người dùng',
            'system' => 'Quản lý hệ thống'
          ];

          $actions = [
            'user' => ['edit','view','form','delete'],
            'role' => ['edit','view','form','delete'],
            'permission' => ['edit','view','form','delete'],
            'post' => ['edit','view','form','delete'],
            'test' => ['edit','view','form','delete'],
            'account' => ['edit','view','form','delete'],
            'system' => ['edit','view','form','delete'],
          ];

          $titleAction = [
            'edit' => 'Cho phép người dùng sửa nội dung',
            'view' => 'Cho phép người dùng xem nội dung',
            'form' => 'Cho phép người dùng thêm nội dung',
            'delete' => 'Cho phép người dùng xóa nội dung',
          ];

          foreach($configs as $key => $value ){
            $actionView = '';
            foreach($actions[$key] as $action){
              $actionView .= sprintf('<input type="checkbox" name="%s[]" class="mr-2" id="" value="%s">%s<br/>
                                    ','permission_'.$key,$action,$titleAction[$action]);
            }
            $xhtml .= sprintf('<div class="card collapsed-card">
                                  <div class="card-header bg-dark">
                                      <span>%s</span>
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                          <i class="fas fa-plus"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                          <i class="fas fa-times"></i></button>
                                      </div>
                                  </div>
                                
                                <div class="card-body" style="display:none">%s</div></div>
                                ',$value,$actionView);
          }
          return $xhtml;
        }
    }

?>
