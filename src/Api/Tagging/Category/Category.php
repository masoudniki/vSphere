<?php

namespace FNDEV\vShpare\Api\Tagging\Category;

use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;

class Category
{
    public Client $HttpClient;
    public function __construct(Client $HttpClient)
    {
        $this->HttpClient=$HttpClient;
    }
    public function all(){
        return ApiResponse::BodyResponse($this->HttpClient->get("com/vmware/cis/tagging/category"));
    }
    public function get($category_id){
        return ApiResponse::BodyResponse($this->HttpClient->get("com/vmware/cis/tagging/category/id:$category_id"));
    }
    public function delete($category_id){
        return ApiResponse::BodyResponse($this->HttpClient->delete("com/vmware/cis/tagging/category/id:$category_id"));
    }
    public function update($category_id,array $config){
        return ApiResponse::BodyResponse($this->HttpClient->patch("com/vmware/cis/tagging/category/id:$category_id",[
            "json"=>$config
        ]));
    }
    public function addToUsedBy($category_id,$entity){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/category/id:$category_id?~action=add-to-used-by",
            [
                "json"=>
                    [
                        "used_by_entity"=>$entity
                    ]
            ]
        ));
    }
    public function removeUsedToBy($category_id,$entity){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/category/id:$category_id?~action=remove-from-used-by",
            [
                "json"=>
                    [
                        "used_by_entity"=>$entity
                    ]
            ]
        ));
    }
    public function revokePropagatingPermissions($category_id){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/category/id:$category_id?~action=revoke-propagating-permissions"));
    }
}