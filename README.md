# Made with ❤️ in `IRAN`
# vspahre
a sdk for working with vsphare automation api.You can use it to manage ESX and vCenter servers;

# Supported Versions
| **vCenterApplianceVersion** 	| **status** 	| **description**                                                	|
|-----------------------------	|------------	|----------------------------------------------------------------	|
| `7.0`                       	| supported  	|                                                                	|
| `6.7`                       	| supported  	| some of api like **ConsoleTicket** is not working [more information](https://developer.vmware.com/docs/vsphere-automation/latest/vcenter/) 	|
| 6.5                         	| supported  	|                                                                	|



# Installation
its super easy to use just run command below:
```sh
composer require masoudniki/vcenter
```

# How To Use It
just pass argument to the ```VmwareApiClient``` and create an instace:
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
 ```
# Parametrs
## host
only the domain name without any protocol and slash charcher or ip address is acceptable

## Port
the port of vCenterAppliance application default value is: **443**


## credential
**you have two option for authentication:**

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
> for the first time you can pass username and password and then get the session with **getSessionId()** method on VmwareApiClient
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
## SSL
if you are usign self signed certificate **pass the path of certificate** or set ** true ** otherwise if you dont want to check certificate set **false**

## Protocol
if you are running vCenterAppliance on http protocol set **http** or if you are running it on https set **https**

## BaseUrl
the main path of rest api default value is: **"/rest/vcenter"**
## AuthUrl
the authetication url for creating **Vmware-Api-Session-Id** default value is:"/rest/com/vmware/cis/session"
## Client
you can create your **guzzle http client** and set its configuartion then pass it to **VmwaareApiClient**



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

--------------------

### :raising_hand: Contributing
If you find an issue or have a better way to do something, feel free to open an issue, or a pull request.
If you use VmwareApiClient in your open source project, create a pull request to provide its URL as a sample application in the README.md file.


### :exclamation: Security
If you discover any security-related issues, please email `masoud.niki79@gmail.com` instead of using the issue tracker.




# TODO

- [ ] add other api to sdk
- [ ] write more test 
- [ ] create request class for methods that send options **like createVm**
- [ ] detect bad codes





