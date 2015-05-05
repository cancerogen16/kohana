<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Material extends ORM {

    protected $_created_column = array('column' => 'ctime', 'format' => TRUE);
    protected $_updated_column = array('column' => 'mtime', 'format' => TRUE);
    protected $_belongs_to = array(
        'tree' => array(
            'foreign_key' => 'category_id',
        )
    );
    protected $_has_many = array(
        'tag' => array(
            'through' => 'tags_materials',
        ),
    );

    public function getMaterialsByCategory($category_id) {
        $data = DB::select()
                ->from('materials')
                ->where('category_id', '=', $category_id)
                ->execute()
                ->as_array();

        return $data;
    }

    public function add_material($categoryId, $content) {
        $this->category_id = $categoryId;
        $this->content = Security::xss_clean($content);
        $this->save();
    }

    public function show_material_by_id($content_id) {
        $material = ORM::factory('material', array('id' => $content_id));

        if ($material->loaded()) {
            $res = $material->tag->find_all();
            foreach ($res as $item) {
                $taginfo[] = array('name' => $item->name);
            }
            $result['content'] = $material->content;
            $result['name'] = $material->name;
            $result['category'] = $material->tree->name;
            $result['tag'] = $taginfo;

            return $result;
        } else {
            return FALSE;
        }
    }

    public function unique_url($url) {
        return !DB::select(array(DB::expr('COUNT(url)'), 'total'))
                        ->from($this->tableName)
                        ->where('url', '=', $url)
                        ->execute()
                        ->get('total');
    }

    public function getErrors() {
        return $this->errors;
    }

}
