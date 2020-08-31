# vspahre
Simple SDK for working with vSphare automation API. You can use it to manage ESX and vCenter servers. Currently the library supports vSphere API from tbe version 6.7


# Installation
It's super easy to use, Just run the below command:
```sh
composer require masoudniki/vcenter
```

# How To Use It
Create a php file and add the autoload.php 
<p align="left">
<img  src="https://i.ibb.co/3BmmbLX/Screenshot-2020-08-27-18-59-48.png" alt="Screenshot-2020-08-27-18-59-48" border="0">
</p>

Then simply create an instance from vmWare

```php
$vcenter=new \vsphere\vmware("https://yourhost.com/","your user name","and your password",false);
```
### host
First parameter you should pass to the vmWare class make sure that your URL starts with HTTP or ends with HTTPS **/**
Otherwise, You get the following error message:
> host not found

### username and password
The class uses this parameter in order to get the Session ID. Afterwards, Session ID will be used for authentication purposes:

### verifyCE
in case your vCenter web client is running on ssl, You should pass **ture**, Otherwise, you should pass **false**

> If you are using self signed certificate then pass false to this parameter or pass the path of your certificate issue.



