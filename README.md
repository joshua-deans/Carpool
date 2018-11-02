# carpool.me Web Application 
carpool.me is a web application intended to make carpool arrangements easier. 
It is built using the following technologies:
* Laravel and PHP
* MySQL on separate DB server
* Apache Server
* Google Maps API
* Google Cloud Platform

## Current Features:
* User authentication (you are able to register, log in, and sign out)
* Able to interact with the Google Maps API in the dashboard
* Able to use the Google Places API to autocomplete your origin and destination
* Able to view and edit profile information

## Starting the server:
* Project Name: CarpoolApplication
* Project ID: carpoolapplication-219320
* Start both webserver3 and mysqlserver1
* Grab external ip
* go to APIs and Services
* Select Credentials
* Click API Key
* add Https://external ip to the "Accept requests from these HTTP referrers (websites)"
* Wait up to 5 minutes for google to update the allowed urls

## Using the site:
* Make sure you are using Https
* go to https://external ip
* accept the dangers of our self-signed certificate
* Site should work