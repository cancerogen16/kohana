<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Main extends Mycontrolleradmin {

    public $template = "basic";
    
    public function action_index() {
        $category = new Model_Category('tree');
        $data['categories'] = $category->getTree();
        
        $btnsubmit = filter_input(INPUT_POST, "btnsubmit", FILTER_SANITIZE_SPECIAL_CHARS);
        if($btnsubmit){
            $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_SPECIAL_CHARS);
            $parentId = filter_input(INPUT_POST, "parentId", FILTER_SANITIZE_SPECIAL_CHARS);
            $url = filter_input(INPUT_POST, "url", FILTER_SANITIZE_SPECIAL_CHARS);
            
            $res = $category->catInsert($parentId, array('name'=>$categoryName, 'url'=>$url));
            if ($res) {
                HTTP::redirect('admin');
            } else {
                $data['errors'] = $category->getErrors();
            }
        }
        
        $this->template->logged = $this->logged;
        $view = View::factory('admin/mainview', $data);
        $this->template->content = $view;
    }
    
    

}

// End Main
