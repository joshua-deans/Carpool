# carpool.me Web Application 
carpool.me is a web application intended to make carpool arrangements easier. 
It is built using the following technologies:
* Laravel and PHP
* MySQL on separate DB server
* Apache Server
* Google Maps API
* Google Cloud Platform

* https://csil-git1.cs.surrey.sfu.ca/ewtempes/Carpool/
* Project Name: CarpoolApplication - ID: carpoolapplication-219320

## Features:
* Admin Authentication for preregistered accounts - use username: eric@admin.ca password: eric to test
* As admin you are able to see current users and carpool sessions
* As admin you are able to delete users and carpool sessions
* User registration and authentication (you are able to register, log in, and sign out)
* Able to interact with the Google Maps API in the dashboard
* Able to use the Google Places API to autocomplete your origin and destination
* Able to view and edit profile information, including adding pictures to your account
* Register as a driver by registering your license and vehicle information
* Create routes as a driver from your preferred start and end location
* Users may browse routes that are within range of their starting/ending location
* Users may sign up for routes based on the returned results

## Starting the server:
* Project Name: CarpoolApplication
* Project ID: carpoolapplication-219320
* Project Host: Eric Tempest - EricTempest@gmail.com - ewtempes@sfu.ca
* If server is on, just use external ip with https, otherwise:
* Start both webserver3 and mysqlserver1
* Grab external ip
* go to APIs and Services
* Select Credentials
* Click API Key
* add Https://external ip to the "Accept requests from these HTTP referrers (websites)"
* Wait up to 5 minutes for google to update the allowed urls

## Using the site:
* Make sure you are using Https
* go to https://external ip of webserver3
* accept the dangers of our self-signed certificate