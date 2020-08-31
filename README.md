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
$vcenter=new \vsphere\vmware("https://yourhost.com/",credential,false);
```
### Host
First parameter you should pass to the VMware class make sure that your URL starts with HTTP or ends with HTTPS **/**
Otherwise, You get the following error message:
> host not found

### Credential
##### Username and password 
so for authentication you can pass vcenter usernme and password as a array like this :
```php
new \vsphere\vmware("https://yourhost.com/",['userernamme'=>"your vcter username","pasword"=>"your vcnter password"],false);
```

##### sessionIdHeader 

or you can easily get the session id from your vcenter and pass it to credential with key **Vmware-Api-Session-Id**
```php
new \vsphere\vmware("https://yourhost.com/",['Vmware-Api-Session-Id'=>"e5560ccba5a622f4325cfcfb1991df0e"],false);
```

i really recommand to use sessionIdHeader for authentication because it much more faster that username-password 

**NOTE** before using sessionIdHeader for authentication you should increase the expiration time in your vcnter
> for more information refer to documentation


when you pass username and password to the vmware class it will use it to get session id from your vcenter and save it in **$session** in connection class







### verifyCE
in case your vCenter web client is running on ssl, You should pass **true**, Otherwise, you should pass **false**

> If you are using self signed certificate then pass false to this parameter or pass the path of your certificate issue.



