# Racks
**Racks** is a prototype of a space accounting system for telecommunication cabinets and racks.  

![](https://img.shields.io/badge/PHP-8.1-%23625c98) ![](https://img.shields.io/badge/Laravel-10-%23c6302b) ![](https://img.shields.io/badge/MySQL-8.0-%23336791)  
![](https://img.shields.io/badge/Vue.js-3.2-%2342b883) ![](https://img.shields.io/badge/TailwindCSS-3.2-%230ea5e9)  
![](https://img.shields.io/badge/Python-3.10-blue)


![](https://img.shields.io/badge/sail-grey) ![](https://img.shields.io/badge/larastan-grey) ![](https://img.shields.io/badge/telescope-grey) ![](https://img.shields.io/badge/pint-grey)  
![](https://img.shields.io/badge/phpunit-grey) ![](https://img.shields.io/badge/phpMyAdmin-grey) ![](https://img.shields.io/badge/tymon/jwt--auth-grey) ![](https://img.shields.io/badge/darkaonline/l5--swagger-grey)  
![](https://img.shields.io/badge/unittest-grey) ![](https://img.shields.io/badge/selenium-grey) ![](https://img.shields.io/badge/concurrent.futures-grey) ![](https://img.shields.io/badge/html--testRunner-grey) ![](https://img.shields.io/badge/selenium%20grid-grey)    
![](https://img.shields.io/badge/vuelidate-grey) ![](https://img.shields.io/badge/axios-grey) ![](https://img.shields.io/badge/vuex-grey) 

```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
 Language            Files        Lines         Code     Comments       Blanks
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
 PHP                   589        48808        25764        17103         5941
 Python                 11          859          753            8           98
───────────────────────────────────────────────────────────────────────────────
 Vue                    37          929          882            0           47
 |- CSS                 10          107          107            0            0
 |- HTML                37         1339         1339            0            0
 |- JavaScript          37         1652         1502          116           34
 (Total)                           4027         3830          116           81
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
 Total                 637        53694        30347        17227         6120
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
 377 tests, 1008 assertions
```

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



