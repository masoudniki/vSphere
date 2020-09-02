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

Then simply create an instance of VMware

```php
$vcenter=new \vsphere\vmware("https://yourhost.com/",credential,false);
```
### Host
First parameter you should pass to the VMware class, make sure that your URL starts with HTTP | HTTPS.
Otherwise, You get the following error message:
> Host not found

### Credential
##### Username and password 
For authentication you can pass vCenter username and password as an array like this:
```php
new \vsphere\vmware("https://yourhost.com/",['userernamme'=>"your vcenter username","password"=>"your vcenter password"],false);
```

##### sessionIdHeader 

Or simply get the Session ID from your vCenter then pass it out to the credential by the following parameter: **Vmware-Api-Session-Id**
```php
new \vsphere\vmware("https://yourhost.com/",['Vmware-Api-Session-Id'=>"e5560ccba5a622f4325cfcfb1991df0e"],false);
```

I reccomend you to use sessionIdHeader for authentication purposes, cause it's much faster than username-password auth.

**NOTE** before using sessionIdHeader for authentication you should increase the expiration time in your vcenter
> For more information refer to the documentation.


When you pass username and password to the VMware class, it will use it to get the Session ID from your vCenter and save it in **$session** in connection class.







### verifyCE
in case your vCenter web client is running on ssl, You should pass **true**, Otherwise, you should pass **false**

> If you are using self signed certificate then pass false to this parameter or pass the path of your certificate issue.



