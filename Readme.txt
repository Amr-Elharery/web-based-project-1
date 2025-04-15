
auther: Abdelaziz Saifeldin

Code Flow:

1- when form is submitted the registeruser function call in user.php file
2-the function prepare the query and senetize  all the form field 
3-  execute the sumbition 
4- check if the submition success of fail and call setSessionMessage() function and pass the execution result (status , message );\
5- close the connection , 
6- redirect function call (back to main page = index.php)
7- the result of submition appear in the main page throw sessioon variable display sessioon message 
8- clear the session  message variable unset . 


Instaliation :

- open the phpmyadmin 
- open sql tab 
- copy the content of sql file   and pasted in sql query , click go 
- the database my_project will created  and users table with 9 fielde (id , full_name, user_name, email, phone, whatsapp, address, password, user_image)
