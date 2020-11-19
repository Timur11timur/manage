#About project

This is an open source forum

## Installation instructions:

###Step 1.

* git clone https://github.com/Timur11timur/manage.git
* cd manage
* composer install
* npm install
* cp .env.example .env

Add necessary params to .env

* php artisan key:generate
* php artisan migrate
* php artisan db:seed

###Step 2.
- Visit: `project/register` to register a new forum account.
- Edit `config/manage.php`, add any email address that should be marked as an administrator.
- Visit: `project/admin/channels` to seed your forum one or more channels.

##Contributing
Thank you for considering contributing in the project!

##Code of Conduct
In order to ensure that the community is welcoming to all, please review and abide by the Code of Conduct.

##License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
