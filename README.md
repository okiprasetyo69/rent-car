# rent-car
# How to setup
# 1. Make env file and setup database. Here i enclosed database
# 2. Run php artisan db:seed --class=UsersTableSeeder to create dump data user
# 3. We have 2 roles user. Super Admin and Consumer. For detail check UserTableSeeder class
# 4. By the default login as Super Admin email : superadmin@test.com and password : 12345678 and Consumer email : consumer@test.com and password : 12345678
# 5. Super Admin only can create car available and filter
# 6. Consumer only can borrow and return rent car
# 7. New user register by the default only have consumer role

