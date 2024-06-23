# Simple IP Management System

## Setup Local Environment
1. Run composer install
2. Run docker-compose build && docker-compose up -d
   - If you're using sail, you can run ./vendor/bin/sail up -d
   - If you're using docker-compose, you can run docker-compose up -d
   - You can run docker-compose exec laravel.test php artisan migrate --seed
   - Mostly what I do is do docker-compose exec laravel.test bash
3. Run docker-compose exec laravel.test php artisan migrate
4. Run docker-compose exec laravel.test php artisan db:seed for seeding data
5. Run docker-compose exec laravel.test php artisan passport:install
6. Run docker-compose exec laravel.test php artisan passport:client --password
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
13. Once you fully run cli command above. 
14. You can run php artisan test to run the test cases.
15. It should have 7 passed test cases
```shell
    PASS  Tests\Feature\IpManagementTest
      ✓ test_can_create_ip (0.07s)
      ✓ test_can_get_all_ips (0.06s)
      ✓ test_can_get_ip (0.06s)
      ✓ test_can_update_ip (0.06s)
      ✓ test_can_delete_ip (0.06s)
      ✓ test_can_search_ip (0.06s)
      ✓ test_can_filter_ip (0.06s)
```
