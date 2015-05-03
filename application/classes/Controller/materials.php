<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Materials extends Mycontroller {

    public $template = "basic";

    public function action_category() {
        $data = array();
        $url = $this->request->param('id');
        $category = new Model_Category('tree');
        $materials = new Model_Material();
        
        $category_id = $category->getCategoryIdByUrl($url);
        if(!$category_id) {
            throw HTTP_Exception::factory(404, 'Запрашиваемая категория не найдена!');
            $this->template->content = View::factory('404view', $data);
        }
        
        $data['materials'] = $materials->getMaterialsByCategory($category_id);
        
        $this->template->logged = $this->logged;
        $this->template->content = View::factory('materialsview', $data);
    }

}

// End Materials
