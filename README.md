# vSphere
Simple SDK for working with vSphere automation API. You can use it to manage ESX and vCenter servers. Currently the library supports vSphere API from tbe version 6.7


# Installation
It's super easy to use, Just run the below command:
```sh
composer require masoudniki/vcenter
```

# How to use it?
Create a php file and add the autoload.php 
<p align="left">
<img  src="https://i.ibb.co/3BmmbLX/Screenshot-2020-08-27-18-59-48.png" alt="Screenshot-2020-08-27-18-59-48" border="0">
</p>

Then simply create an instance from VMware

```php
$vcenter=new \vsphere\vmware("https://yourhost.com/","your user name","and your password",false);
```
### Host
First parameter you should pass to the VMware class make sure that your URL starts with HTTP or ends with HTTPS **/**
Otherwise, You get the following error message:
> host not found

### Username and Password
The class uses this parameter in order to get the Session ID. Afterwards, Session ID will be used for authentication purposes:

### verifyCE
in case your vCenter web client is running on ssl, You should pass **true**, Otherwise, you should pass **false**

> If you are using self signed certificate then pass false to this parameter or pass the path of your certificate issue.



