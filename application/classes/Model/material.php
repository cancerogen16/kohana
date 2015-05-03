<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material {

    public function getMaterialsByCategory($category_id) {
        $data = DB::select()
            ->from('materials')
            ->where('category_id', '=', $category_id)
            ->execute()
            ->as_array();

        return $data;
    }
    
    public function unique_url($url){
        return !DB::select(array(DB::expr('COUNT(url)'), 'total'))
            ->from($this->tableName)
            ->where('url', '=', $url)
            ->execute()
            ->get('total');
    }
    
    public function getErrors(){
        return $this->errors;
    }
}
