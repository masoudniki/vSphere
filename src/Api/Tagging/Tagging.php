<?php

namespace FNDEV\vShpare\Api\Tagging;

use FNDEV\vShpare\Api\Tagging\Assign\Assigning;
use FNDEV\vShpare\Api\Tagging\Category\Category;
use FNDEV\vShpare\Api\Tagging\Tag\Tag;
use FNDEV\vShpare\Api\VM\Abstracts\InitClass;

class Tagging extends InitClass
{
    public function category():Category{
        return new Category($this->HttpClient);
    }
    public function tag():Tag{
        return new Tag($this->HttpClient);
    }
    public function assign():Assigning{
        return new Assigning($this->HttpClient);
    }
}