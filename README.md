# vspahre
simple sdk for working with vsphare automation api.You can use it to manage ESX and vCenter servers. Currently the library supports vSphere API from version 6.7


# Installation
its super easy to use just run command below:
```sh
composer require masoudniki/vcenter
```

# How To Use It
create a php file and add autoload.php 
<p align="left">
<img  src="https://i.ibb.co/3BmmbLX/Screenshot-2020-08-27-18-59-48.png" alt="Screenshot-2020-08-27-18-59-48" border="0">
</p>

then simply create a instance from vmware

```php
$vcenter=new \vsphere\vmware(host,credential,option);
```
# Required Parameter
### host
first parameter you should pass to the vmware class make sure that your url start with http or https and end with **/**
otherwise you get an error with this message 
> host not found


## credential
### with username and password
you can pass username and password in array for getting session id 
```
[
    'username'=>'local@admin',
    'password'=>'123456789'
]
```
### or with Vmware-Api-Session-Id
increasing session timeout in vCenter and pass directly the session id 
```
[
    'Vmware-Api-Session-Id'=>$sessionId
]
```

> for the first time you can pass username and password and then get the session with **getSessionId()** method 
# optional parameter
### option
pass array to set custom options for guzzle client 
if your vcenter web client running with ssl you should pass **ture** otherwise you should pass **false**
```
$option=[
    "verify"=>"false"
]
```
> if you are using self signed certificate pass false to this parameter or pass the path of your certificate

or you want to set timeout for requests
```
$option=[
    'timeout'=>'40'
]

``` 

or you want pass custom headers 
```
[
    'headers'=>[
        "X-My-Custom-Header"=>"some value"
    ]
]
```



