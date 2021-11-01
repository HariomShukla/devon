# Manage Soccer Team Laravel Application

Build an application which can be used to manage soccer teams and its players. Read through
requirements below to develop this application.

## Description

1. Should create REST API endpoints to do CRUD operations for teams and Players. Only an user with
admin privileges should be able to do this (create, update and delete) operations. Proper permissions
handling mechanism should be implemented.

2. Each player should be assigned to a team.

3. As an anonymous user [without login], I should be able to fetch teams list. Team information should
have name, logo. Should use the endpoint created in step 1.

4. As an anonymous user [without login], I should be able to fetch a team’s players based on team name
or team identifier. Players list should consist of <image>, <lastName> <firstName>. Should use the
endpoint created in step 1.

5. As an anonymous user [without login], I should be able to fetch a player based on player name or
player identifier. Player list should consist of <image>, <lastName> <firstName> and the team name.
Should use the endpoint created in step 1.

## Getting Started

### Dependencies

* PHP 7.*

### Installing & Executing

* git clone https://github.com/HariomShukla/devon.git
* npm run dev // to adopt fronend changes
* php artisan migrate
* php artisan db:seed // to create admin and generic user in db
* add below keys and values in env
    API_URL= // your vhost domain or ip to access the application
    API_USER=admin@devon.com
    API_PASSWORD=password
* 

## Authors

Hariom Shukla
