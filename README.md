# Setup

This is using sail so you can use ./vendor/bin/sail up -d. I've added add the setup details into the .env.example so you can just copy that then composer install.

Run the migrate --seed to seed the roles database. I had the user create a factory but it caused issues with the test to use /vendor/bin/sail tinker to create a user. I've created a console command that wil generate 100 post but with the user_id of 1 but you can generate posts with the factories.

localhost:80 = app
localhost:8025 = mailpit
