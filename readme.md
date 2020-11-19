#About project

This is an open source forum

## Installation instructions:

* git clone https://github.com/Timur11timur/manage.git
* cd manage
* composer install
* npm install
* cp .env.example .env

Add necessary params to .env

* php artisan key:generate
* php artisan migrate
* php artisan db:seed

- Visit: project/register and register an account.
- Edit `config/manage.php`, adding the email address of the account you just created.
- Visit: project/admin/channels and add at least one channel. 

##Contributing
Thank you for considering contributing in the project!

##Code of Conduct
In order to ensure that the community is welcoming to all, please review and abide by the Code of Conduct.

##License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
