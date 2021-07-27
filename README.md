

# VMware vSphere SDK

<div align="center">
    
[![Actions Status](https://github.com/masoudniki/vSphere/workflows/CI/badge.svg)](https://github.com/masoudniki/vSphere/actions)
[![Latest Stable Version](http://poser.pugx.org/masoudniki/vcenter/v)](https://packagist.org/packages/masoudniki/vcenter)
[![License](http://poser.pugx.org/masoudniki/vcenter/license)](https://packagist.org/packages/masoudniki/vcenter)    
[![codecov](https://codecov.io/gh/masoudniki/vSphere/branch/master/graph/badge.svg?token=zly1MFGFuU)](https://codecov.io/gh/masoudniki/vSphere)
    
</div>

SDK for working with vSphere automation api. You can use it to manage ESXI and vCenter powered machines.

# Supported Versions
| **vCenterApplianceVersion** 	| **status** 	| **description**                                                	|
|-----------------------------	|------------	|----------------------------------------------------------------	|
| `7.0`                       	| supported  	|                                                                	|
| `6.7`                       	| supported  	| some of api like **ConsoleTicket** is not working [more information](https://developer.vmware.com/docs/vsphere-automation/latest/vcenter/) 	|
| 6.5                         	| supported  	|                                                                	|



# Installation
It's super easy to use, just run the below command:
```sh
composer require masoudniki/vcenter
```

# How to use it
just pass argument to the ```VmwareApiClient``` and create an instace:
```php
    require "vendor/autoload.php";
    $vmware=new \FNDEV\vShpare\VmwareApiClient(
        "127.0.0.1",
        [
            "username"=>"admin",
            "password"=>"admin"
        ],
         "443",
    );
 ```
# Parametrs
## Host
only the domain name without any protocol and slash charcher or ip address is acceptable

## Credentials
**You have two options for authentication:**

### With username and password
you can pass username and password in array for getting session id 
```
[
    'username'=>'local@admin',
    'password'=>'123456789'
]
```
### Or with Vmware-Api-Session-Id
increasing session timeout in vCenter and pass directly the session id 
```
[
    'Vmware-Api-Session-Id'=>$sessionId
]
```
> For the initiation & first time use you can pass username and password and then get the session with **getSessionId()** method on VmwareApiClient
```php
    require "vendor/autoload.php";
    $vmware=new \FNDEV\vShpare\VmwareApiClient(
        "127.0.0.1",
        "443",
        [
            "username"=>"admin",
            "password"=>"admin"
        ],
    );
    $vmware->getSessionId();
```

## Port
the port of vCenterAppliance application default value is: **443**


## SSL
if you are using self signed certificate **pass the path of certificate** or set **true** otherwise if you dont want to check certificate set **false**

## Protocol
if you are running vCenterAppliance on HTTP protocol set **http** or if you are running it on HTTPS set **https**

## BaseUrl
The main path of REST API default value is: **"/rest/vcenter"**
## AuthUrl
The authetication URL for creating **Vmware-Api-Session-Id** default value is:"/rest/com/vmware/cis/session"
## Client
You can create your **guzzle http client** and set its configuartion then pass it to **VmwaareApiClient**



## License
###### Made with ❤️ in `IRAN`
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

--------------------

### :raising_hand: Contributing
If you find an issue or have a better way to do something, feel free to open an issue, or a pull request.
If you use VmwareApiClient in your open source project, create a pull request to provide its URL as a sample application in the README.md file.


### :exclamation: Security
If you discover any security-related issues, please email `masoud.niki79@gmail.com` instead of using the issue tracker.




# TODO

- [ ] add other APIs to the SDK
- [ ] Writing more tests 
- [ ] Creating request class for methods that send options **like createVm**
- [ ] Refactoring bad practice





