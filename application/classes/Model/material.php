<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material extends ORM {

    protected $_created_column = array('column' => 'ctime', 'format' => TRUE);
    protected $_updated_column = array('column' => 'mtime', 'format' => TRUE);
    
    public function getMaterialsByCategory($category_id) {
        $data = DB::select()
            ->from('materials')
            ->where('category_id', '=', $category_id)
            ->execute()
            ->as_array();

        return $data;
    }
    
    public function add_material($categoryId, $content)
    {
        $this->category_id = $categoryId;
        $this->content = Security::xss_clean($content) ;
        $this->save();
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
