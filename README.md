#Setup

This is using sail (docker)  so you can use ./vendor/bin/sail up -d. The setup details are in the .env.example so you can just copy that then composer install.

Run the migrate --seed to seed the roles database. To create a user . /vendor/bin/sail tinker. I've created a console command that will generate 100 post but with the user_id of 1 but you can generate posts with the factories.

localhost:80 = app 
localhost:8025 = mailpit
