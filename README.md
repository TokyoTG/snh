# Local Deployment Instructions

TOOLS NEEDED
XAMPP or WAMPP
sendmail.exe
mailtrap.io Account
#Deployment Steps Using XAMPP

##CLONING AND SETTING UP XAMPP

*clone this repo using this command: "git clone https://github.com/TokyoTG/snh.git"
*place the cloned repo root folder(snh) containing all files in your XAMPP htdocs folder ("C:\xampp\htdocs\")
*start your XAMPP Apache services and copy this link: http://localhost/snh/ in your browser.

##GETTING MAILTRAP AND SENDMAIL

*Go to https://mailtrap.io/ and login or create a new account
*Copy this link and paste this link https://www.glob.com.au/sendmail/sendmail.zip on your browser to download sendmail.
*Unzip the downloaded file into a folder preferably named "sendmail".
*Move/Copy this folder (folder containing sendmail) to the root folder of your XAMPP ("C:\xampp\")

##SETTING UP MAILTRAP AND SENDMAIL

-Stop your XAMPP services
-locate your php.ini file, it is located in C:\xampp\php\php.ini
-Open this file in your text editor
-Search for the keyword 'smtp' using the find tool (CTRL F) to go to the [Mail Function] section of the php.ini file
-The php.ini uses ";" placed at the start of a statement to comment out the statement. So remove it for the lines you gonna be editting only.
-Now go to your dashboard on the click on th demo inbox link to directed to the messages
-On the inboxes section, locate the SMTP settings tab of the messages page (at the right side)
-Locate the integration section of the SMTP settings tab and set the integration to any PHP framework
-Copy the Host value and got to php.ini file
-Set the SMTP to the copied host name (SMTP should be looking like this "SMTP = smtp.mailtrap.io")
-Copy any of the Port value on the on your SMTP settings tab
-Go to your php.ini file and set the smtp_port value to equal the copied host (smpt_port should be looking like this "smtp_port= 2525" depending on your port value)
-In you php.ini file, set the sendmail_from to any string you mailtrap to see as the mail sender(sendmail_from should be looking like this "sendmail_from = "admin@snh.ng")
-Set your sendmail path to this sendmail_path = "C:\xampp\sendmail\sendmail.exe -t -i"
-Copy the the auth_username and auth_password
-Set them to respectively in your php.ini(They should be looking like this "auth_username= 77f00e762a5920"
"auth_password= a6aa182d8d3501")
-Save your php.ini file
-Go to your sendmail folder and locate the sendmail.ini (should be located here C:\xampp\sendmail\sendmail.ini)
-Open the sendmail.ini file and set the smtp_server tothe Host value on your mailtrap SMTP settings tab ("smtp_server=smtp.mailtrap.io");
-Set the smtp_port in your sendmail.ini file to the same port value for the php.ini ("smtp_port=2525")
-Then set the auth_username and auth_password in the sendmail.ini file as you did for php.ini
-Save the sendmail.ini
-Start XAMPP services, all functions of the page should be working fine.
-Try reseting password to check if you sendmail is working fine.
-Thats all
