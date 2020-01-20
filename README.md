MVC-OOP-PHP
Custom mvc model without composer This is mvc with only porposes to test my skills and some new php functionallity in future.

I decide do not use Composer or other tool for archeture . The only it will be used libraries with help functionallity
where don`t affect to core of project.

Its standart MVC framework

Routing: currently it work only with GET and POST request TODO: to add other type of requests. The route file is in directory route.
(webRoutes.php) Exampe for routing: routes\RouteClass::get('home/gtr/{a}/gt/{f}', "SecondController@indexPage"); 
this is very basic routing rule based ot pretty URL. You can pass variable via url with this sintaksis: gtr/{a} where "gtr"
is variable name and {a} is value . "SecondController@indexPage" is the controller name and function name where call when user
access this routing where SecondController is name of controller and indexPage is name of function. TODO: add auth routing rules
