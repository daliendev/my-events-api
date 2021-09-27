<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About API ( you can also open the main page of the api > http://localhost:8000/ )     
|   MODEL     | Routes              | Method | Response ( Success )          | Response ( Failure ) |        
|-------------|---------------------|--------|-------------------------------|----------------------|            
| **User**    | /api/register       | POST   | 200 + message + token         | error + message      |              
| **User**    | /api/login          | POST   | 200 + message + token         | error + message      |    
| **User**    | /api/google/sign-in | POST   | 200 + message + token         | error + message      |     
| **User**    | /api/users/me       | GET    | 200 + message + user          | error + message      |     
| **User**    | /api/users/{id}     | GET    | 200 + message + user          | error + message      |   
| **User**    | /api/users          | GET    | 200 + message + users         | error + message      |
| **User**    | /api/users/{id}     | PUT    | 200 + message + user          | error + message      |     
| **User**    | /api/users/{id}     | DELETE | 200 + message                 | error + message      |     
|-------------|---------------------|--------|-------------------------------|----------------------|        
| **Event**   | /api/events         | POST   | 200 + message + data(event)   | error + message      |                       
| **Event**   | /api/events/{id}    | GET    | 200 + message + data(event)   | error + message      |             
| **Event**   | /api/events/        | GET    | 200 + message + data(events)  | error + message      |                
| **Event**   | /api/events/{id}    | PUT    | 200 + message + data(event)   | error + message      |         
| **Event**   | /api/events/{id}    | DELETE | 200 + message                 | error + message      |        
|-------------|---------------------|--------|-------------------------------|----------------------|           
| **Hangout** | /api/hangouts       | POST   | 200 + message + data(hangout) | error + message      |                         
| **Hangout** | /api/hangouts/{id}  | GET    | 200 + message + data(hangout) | error + message      |                
| **Hangout** | /api/hangouts       | GET    | 200 + message + data(hangouts)| error + message      |                  
| **Hangout** | /api/hangouts/{id}  | PUT    | 200 + message + data(hangout) | error + message      |           
| **Hangout** | /api/hangouts/{id}  | DELETE | 200 + message                 | error + message      |      
|-------------|---------------------|--------|-------------------------------|----------------------|           
| **Chat**    | /api/chats          | POST   | 200 + message + data(chat)    | error + message      |                         
| **Chat**    | /api/chats/{id}     | GET    | 200 + message + data(chat)    | error + message      |               
| **Chat**    | /api/chats          | GET    | 200 + message + data(chats)   | error + message      |                  
| **Chat**    | /api/chats/{id}     | PUT    | 200 + message + data(chat)    | error + message      |           
| **Chat**    | /api/chats/{id}     | DELETE | 200 + message                 | error + message      |      