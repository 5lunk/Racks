# Racks
**Racks** is a prototype of a space accounting system for telecommunication cabinets and racks.

## Stack:
![](https://img.shields.io/badge/PHP-8.1-%23625c98) ![](https://img.shields.io/badge/Laravel-10-%23c6302b) ![](https://img.shields.io/badge/MySQL-8.0-%23336791)  
![](https://img.shields.io/badge/Vue.js-3.2-%2342b883) ![](https://img.shields.io/badge/TailwindCSS-3.2-%230ea5e9)  
![](https://img.shields.io/badge/Python-3.10-blue)

## Tools:
![](https://img.shields.io/badge/sail-%23c6302b) ![](https://img.shields.io/badge/larastan-%23c6302b) ![](https://img.shields.io/badge/telescope-%23c6302b) ![](https://img.shields.io/badge/pint-%23c6302b)  
![](https://img.shields.io/badge/phpunit-%23625c98) ![](https://img.shields.io/badge/phpMyAdmin-%23625c98) ![](https://img.shields.io/badge/tymon/jwt--auth-%23625c98) ![](https://img.shields.io/badge/darkaonline/l5--swagger-%23625c98)  
![](https://img.shields.io/badge/unittest-blue) ![](https://img.shields.io/badge/selenium-blue) ![](https://img.shields.io/badge/concurrent.futures-blue) ![](https://img.shields.io/badge/html--testRunner-blue) ![](https://img.shields.io/badge/selenium%20grid-blue)    
![](https://img.shields.io/badge/vuelidate-%2342b883) ![](https://img.shields.io/badge/axios-%2342b883) ![](https://img.shields.io/badge/vuex-%2342b883) 

## For dev environment:
Needs `docker` and `laravel/sail` to be installed.
```
./vendor/bin/sail up
```

## build_and_test.sh:

Check `NUMBER_OF_THREADS` and `SHM_SIZE` envs before start!  
HTML-reports and screenshots are stored in relevant docker volumes. Each run logs stored in `./build_logs` directory.

## CLI:
Administrative purpose commands for artisan via sail:
```
./vendor/bin/sail artisan `command` {args}
```
Region:
```
region:create {name : Region name}
region:delete {id : Region ID}
region:update {id : Region ID} {name : Region name}
```
Department:
```
department:create {name : Department name} {region_id : Region ID}
department:delete {id : Department ID}
department:update {id : Department ID} {name : Department name}
```
User:
```
user:create {name : User name} {full_name : User full name} {email : User email} {department_id : Department ID}
user:delete {id : User ID}
user:reset_password {id : User ID}
user:update {id : User ID} {name : User name} {full_name : User full name} {email : User email} {department_id : Department ID}
```

## Docs:
### Swagger:
```
http://localhost:80/api/documentation
```
### Business rules example:
[/app/Domain/Interfaces/RackInterfaces/RackBusinessRules.php](/app/Domain/Interfaces/RackInterfaces/RackBusinessRules.php)

## Models graph:
| ![graph](graph.png) |
|:-------------------:|

## Screenshots:
| ![tree](./screens/tree.png) |
|:--:| 
| *Racks map* |

| ![rack](./screens/rack.png) |
|:--:| 
| *Rack scheme* |

| ![device](./screens/device.png) |
|:--:| 
| *Device card* |



