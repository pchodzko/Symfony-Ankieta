# Symfony-Ankieta
=================
1. Pobierz projekt.
2. Uruchom obraz dockera za pomocą polecenia:

> docker-compose up -d --build

Powyższa komenda pozwoli stworzyć środowisko linux z apache, php7.2 i bazą mysql. 

3. Zainstaluj wymagane bilioteki za pomocą polecenia:

>docker-compose exec apache /bin/bash
>
>composer install
>
>yarn install

4. Instalowanie plików lokalizacyjnych

>php bin/console bazinga:js-translation:dump

5. Utowrzyć pliki js i css:

>yarn run build

6. Utworzyć tabele i wczytać przykładowe dane:

>php bin/console doctrine:schema:create 

>php bin/console doctrine:fixture:update

Aplikacja dostępna pod adresem

http://localhost/public/index.php/

