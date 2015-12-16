# opencart 2.1.0.1
This module is designed to work with Opencart Version 2.1.0.1.

## Description
This shipping plugin was developed by InPost UK Ltd. for OpenCart.
Once installed the plugin allows customers to opt for delivery of their
purchased items to an InPost locker terminal. 

When checking out, customers can specify a destination locker terminal where
their purchased items will be delivered on the next day after dispatch. Once
the item(s) have been delivered to a locker terminal, the customer will
receive an email containing a QR code as well as a mobile SMS notification
containing a PIN code. They can then go to their selected locker, scan the QR
code or enter the PIN code manually using the onscreen keyboard on the
terminal, in order to collect the parcel. At present, InPost's UK network 
comprises over 1000 locker terminals across the country.

### What is InPost?
InPost is a company that provides customers a means of delivering a parcel to 
one of our lockers for later collection. This removes the need for the 
customer to stay in and wait for a delivery person. All of our lockers are available to visit 24/7.

Customers can also return goods using an InPost locker.

## Installation

### Requirements
You will need to have vQmod installed on the site. This allows changes to the site but without overwritting any of the core code. An XML document describes the changes to the code and on the fly a modified version of the code is created and cached. This is then served to the user. So there is no significant slowdown of the site and you can upgrade without worry.

* vQmod available from [visit the vQmod pages] (https://github.com/vqmod/vqmod/wiki/Installing-vQmod-on-OpenCart)
* This module requires 2.1.0.1 as the lowest possible version of OpenCart.
* PHP cURL must be installed.

#### InPost Account
You will need to talk to a sales representitive to get an InPost Account. This
will allow you to connect to our servers for parcel and label creation.

Please call 033 033 52024 (UK only) or contact our sales team on
ecommerce.team@inpost.co.uk

### Steps
The code of this repository needs to be copied onto the site directory structure. The XML files need to be copied into the <root>\vqmod\xml folder.

Then you will need to enable the InPost module. Go to the main menu and then click on the Modules submenu. Look for the "InPost Shipping" module and install it. Once it has installed edit the attributes for the module. You will need to have an InPost API Key, see above for details. Each of the options has text giving the default values.

Then click on Save to store your option choices.

You will then need to enable the shipping method. Go from the main menu to the Shipping section. You will need to install the "InPost Shipping" method. Once it is installed you will need to edit the options and "enable" the shipping method so that it shows to the clients.

Then you will click on Save to store your option choices.

Once the shipping method is enabled the list of shipping methods will be changed to show that the InPost method is switched on.

You will also have to give the user(s) permisions to view and edit the InPost parcels.

### Updates
Version 1.1 16th December 2015

These are the various changes made to the code:

* The list of parcels filtering options now all work.
* The parcel status on the parcel list is now a select.
* The edit parcel option is only allowed for parcels with the correct status.
* The edit parcel mobile phone number is restricted to the correct number of digits (nine).
* The forms all use modern responsive design styles and layout.
* The edit parcel option is checked so that parcels of the wrong status cannot be edited.
* The parcel list screen allows for multiple filter options.
* The create label action downloads the label to the users computer and saves a copy on the server.
* The user is given the option of producing PDF or EPL2 format labels.
* Unneeded code is removed from all areas.
* The maximum length for the machine ID is increased to fourteen.
* All code modernised to OpenCart 2.x standards.

#### Tested Using
OpenCart version 2.1.0.1 and PHP 5.5.12
