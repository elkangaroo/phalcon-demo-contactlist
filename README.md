# DEMO application using the php framework [phalcon](https://phalcon.io/)

A simple web page where we can manage a contact list of our customers which are stored in the database.  
The contact list has the following fields:
- first name
- last name
- email address
- creation date

## Setup
In your favourite terminal run the following commands:  
`$ docker-compose up -d`  
`$ docker-compose exec php-phalcon composer install`  

Now you should be able to open the application in you browser via `http://localhost:8765/`

