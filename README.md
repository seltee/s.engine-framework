# s.engine framework
That framework designed for fast developing of SPA and multipage web pages. 
It's related to the design patterns, but not strictly. I mind loose coupling, but prefer speed of developing with a sufficient degree of modifiability.

To work with it you only need to know the base PHP and JS, and React if you want to create single page applications.

Framework based on the idea of using packages and easily switching, deleting and doing modifications of them.

From the scratch by now you will get:
- Users and 3 security levels (unregistered, user, administrator)
- Centralized image gallery, that can be used with another modules. Easy loading with js FileReader.
- News module
- Sliders module
- React + webpack customized for immediate start of SPA developing after cloning repo. If not just delete React folder and www/bundle.js
- Automatic generation if API for SPA. Like this: 
http://dev5.moonsitecrew.ru/?api

Check the futures on the example site, that you will get from this repo:
http://dev5.moonsitecrew.ru/

# Landing with s.engine
Go to DataLayer/Templates/Templates. 
Here are two main files - base.php and main.php. 
Idea is, that all pages included inside base template, like it done with main page, that will load if other not requested.
Your css files is in www/media/css. Look at the examples of pages to get to know, how to request backend functions with ajax.

That's all.


# Landing with s.engine and React
You need just modify app.js in React/app, as your root React component. Delete index.php and rename index-react.html.

For adding necessary function check DataLayer/Main/Package.php. This is the package, that you can use as your main project package.
All of the functions there (except "getFunctions") is your functions that can be called. 
"getFunctions" returns array with possible functions and requests for them. Request class contains data, that your frontend will send to it.
That's all. For more information check 
http://dev5.moonsitecrew.ru/ 
or run cloned repo on your ngynx php7 server with www as root folder.
