# Simple IP Management System

## Setup Local Environment
1. Run composer install
2. Run docker-compose build && docker-compose up -d
3. Run php artisan migrate
4. Run php artisan db:seed for seeding data
5. Run php artisan passport:install
6. Run php artisan passport:client --password
7. Choose user
8. Add the client id and client secret to the .env file
```dotenv
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=1
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET="Hs7XosqlIgCqnv3vHsEuXRCjJNhuVpnUzpOmdwvo"
PASSPORT_PERSONAL_ACCESS_GRANT_TYPE="password"
```
9. Run php artisan optimize:clear
10. That should be it
11. Note: please make sure you're not using port 80 as docker/sail will use this as default.
12. That should be it. You can now access the API via http://localhost/api
