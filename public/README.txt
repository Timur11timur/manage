Пробрасываем avatars - создаем symlink

sudo ln -s ../storage/app/public/avatars ./public/avatars

В APACHE в sites-available должно быть включено FollowSymLinks в public директории
