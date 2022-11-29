<?php

namespace FNDEV\vShpare\Api\Tagging\Tag;

use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;

class Tag
{
    public Client $HttpClient;
    public function __construct(Client $HttpClient)
    {
        $this->HttpClient=$HttpClient;
    }
    public function all(){
        return ApiResponse::BodyResponse($this->HttpClient->get("com/vmware/cis/tagging/tag"));
    }
    public function get($tag_id){
        return ApiResponse::BodyResponse($this->HttpClient->get("com/vmware/cis/tagging/tag/id:$tag_id"));
    }
    public function delete($tag_id){
        return ApiResponse::BodyResponse($this->HttpClient->delete("com/vmware/cis/tagging/tag/id:$tag_id"));
    }
    public function update($tag_id,array $config){
        return ApiResponse::BodyResponse($this->HttpClient->patch("com/vmware/cis/tagging/tag/id:$tag_id",[
            "json"=>$config
        ]));
    }
    public function allTagsForCategory($category_id){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag/id:$category_id?~action=list-tags-for-category"));
    }
    public function addToUsedBy($tag_id,$entity){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag/id:$tag_id?~action=add-to-used-by",
            [
                "json"=>
                    [
                        "used_by_entity"=>$entity
                    ]
            ]
        ));
    }
    public function removeUsedToBy($tag_id,$entity){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag/id:$tag_id?~action=remove-from-used-by",
            [
                "json"=>
                    [
                        "used_by_entity"=>$entity
                    ]
            ]
        ));
    }
    public function revokePropagatingPermissions($tag_id){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag/id:$tag_id?~action=revoke-propagating-permissions"));
    }
}