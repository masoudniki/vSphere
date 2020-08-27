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
$vcenter=new \vsphere\vmware("https://yourhost.com/","your user name","and your password",false);
```
### host
first parameter you should pass to the vmware class make sure that your url start with http or https and end with **/**
otherwise you get an error with this message 
> host not found

### username and password
the class use this parameter for get session id . after getting sessin id it will use it for authentication

### verifyCE
if your vcenter web client running with ssl you should pass ** ture ** otherwise you should pass ** false **

> if you are using self signed certificate pass false to this parameter or pass the path of your certificate



