<?php
require_once("database.php");

class CategoryObject
{
    public $id;
    public $category_name;
    public $category_description;
    public $category_value;
    public $is_reward;
    public $for_self;
    public $is_editable = 0;
    public $status_id;


    function __construct($params = array())
    {

        if (count($params) > 0) {
            $this->initialize($params);
        }
    }

    function initialize($params = array())
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (!isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

}
