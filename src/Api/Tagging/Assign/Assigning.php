<?php

namespace FNDEV\vShpare\Api\Tagging\Assign;

use FNDEV\vShpare\Api\VM\Abstracts\InitClass;
use FNDEV\vShpare\Api\VM\Traits\MOID;
use FNDEV\vShpare\Api\VM\VmSource;
use FNDEV\vShpare\ApiResponse;
use GuzzleHttp\Client;

class Assigning extends InitClass
{
    use MOID;
    public function attachToVirtualMachine($tag_id,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag-association/id:$tag_id?~action=attach",
            [
                "json"=>
                [
                    "object_id"=>
                        [
                            "id"=>$this->getMoid($moid),
                            "type"=>"VirtualMachine"
                        ]
                ]
            ]
        ));
    }
    public function detachFromVirtualMachine($tag_id,$moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag-association/id:$tag_id?~action=attach",
            [
                "json"=>
                    [
                        "object_id"=>
                            [
                                "id"=>$this->getMoid($moid),
                                "type"=>"VirtualMachine"
                            ]
                    ]
            ]
        ));
    }
    public function listAttachedTagsToVirtualMachine($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag-association?~action=list-attached-tags",
            [
                "json"=>
                    [
                        "object_id"=>
                            [
                                "id"=>$this->getMoid($moid),
                                "type"=>"VirtualMachine"
                            ]
                    ]
            ]
        ));
    }
    public function listAttachableTagsToVirtualMachine($moid=null){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag-association?~action=list-attachable-tags",
            [
                "json"=>
                    [
                        "object_id"=>
                            [
                                "id"=>$this->getMoid($moid),
                                "type"=>"VirtualMachine"
                            ]
                    ]
            ]
        ));
    }
    public function listAttachedObjectsToATag($tag_id){
        return ApiResponse::BodyResponse($this->HttpClient->post("com/vmware/cis/tagging/tag-association/id:$tag_id?~action=list-attached-objects"));
    }
}