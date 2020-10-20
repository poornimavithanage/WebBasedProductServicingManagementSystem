# Web Based Product Servicing Management System  [MVC Architecture]
> Project represents Web Based Product Servicing Management System for Swedish Trading Audio Visual (Pvt) Ltd; 

## Introduction

This application undertakes following functionalities,
        login form    
        Customer Registration
        Supplier Registration
        Customer web portal
        Manage Job Cards
        Manage Technicians
	Manage purchasing
	Report Management


## Requirements

* Install relevant software packages according to their user manuals. (Steps of installing WampServer and a web browser is described in next section)
* After installing the relevant software, copy the “ psms ” folder given in the supplementary CD and paste it inside “ www ” folder in the path –C:\wamp\www	

## Installing WampServer (Apache server, PHP, MYSQL)

* Download WampServer for Windows from http://www.wampserver.com/en/ (make sure to select the correct installer file for your version of Windows)  
links :
    [wampserver](http://www.wampserver.com/en/) 
* To start the installation process, open the folder where you saved the installer file   ,and double click it. A security warning window will open, asking if you are sure you want to run this file. Click ‘Run’ to start the installation process.   
* Next is the ‘WampServer Setup Wizard’ screen as shown. Click ‘Next’ to continue the installation

## WampServer Setup
![Ait text](src/screenShots/wampserver_setup.png)

* The next screen presented is the ‘License Agreement’. Read the agreement, click the radio button next to ‘I accept the agreement’ and then click ‘Next’ to continue the installation.
* Next is the ‘Select Destination Location’ screen. Unless you would like to install WampServer on another drive, you should not need to change anything. Click ‘Next’ to continue.
* The next screen is the ‘Select Additional Tasks’ screen. Select weather you would like a quick launch icon added to the taskbar or a desktop icon created once installation is complete. Make the selections, then click ‘Next’ to continue.
* Next is the ‘Install’ screen. You can review your setup choices, and change any of them by clicking ‘Back’ to the appropriate screen.Once you have reviewed your choices, click ‘Install’ to continue.

## Install Screen
![Ait text](src/screenShots/InstallScreen.png)

* WampServer will begin extracting files to the location you selected.
* Once the installation is done, select your default web browser for WampServer among the following.
> Crome | 
> Firefox |	
> Safari

* After selection the web browser, the ‘PHP Mail Parameters’ screen will appear. Leave the SMTP server as localhost, and change the email address to one of your choosing.
* When the configuration is done the ‘Installation Complete’ screen will appear. Check the ‘Launch WampServer Now’ then click ‘Finish’ to complete the installation.
* Once all installations and configurations are done, the WampServer icon appear in the system tray on the right side of the taskbar. If the icon is green WampServer is working properly, if the icon is orange then there is some issue with the services of WampServer, if the icon is red that means the both Apache and MYSQL services are in offline. 


## Technologies
> PHP | 
> CodeIniter | 
> MVC Architecture |

## Contributors

name  : Poornima Vithanage 
         
e-mail : vithanagepurnima@gmail.com

[Github] (https://github.com/poornimavithanage)

## Login Form
![Ait text](src/screenShots/LoginPage.png)

## Customer Registration
![Ait text](src/screenShots/customerRegistration.png)

## Supplier Registration
![Ait text](src/screenShots/supplierRegistration.png)

## Supplier Detail View
![Ait text](src/screenShots/supplierDetailView.png)

## Job Card
![Ait text](src/screenShots/job_card.png)

## Manage Technicians
![Ait text](src/screenShots/TechnicalAssignQueue.png)

## Customer Web Portal
![Ait text](src/screenShots/webportalStack.png)

## SMS 
![Ait text](src/screenShots/SMS.png)

## File Structure
![Ait text](src/screenShots/filestructure.png)

## License

This project is licensed under the MIT License - see the [LICENSE.txt](LICENSE.txt) file for details.


# CodeIgniter 2
Open Source PHP Framework (originally from EllisLab)

For more info, please refer to the user-guide at http://www.codeigniter.com/userguide2/  
(also available within the download package for offline use)

**WARNING:** *CodeIgniter 2.x is no longer under development and only receives security patches until October 31st, 2015.
Please update your installation to the latest CodeIgniter 3.x version available
(upgrade instructions [here](http://www.codeigniter.com/userguide3/installation/upgrade_300.html)).*

