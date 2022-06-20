# Symfony Custom Authenticators

Small app implementing Google and Facebook Authentication using OAuth2 Client

## Documentation

[Blog post from dev-web.io](https://www.dev-web.io/2022/03/07/symfony-6-sauthentifier-avec-google-facebook-github/)

## Requirements

* PHP / Sql
* Symfony CLI
* Google App with OAuth2
* Facebook App 

## Install

```bash
# install composer packages
composer install

# start dev server
symfony server:start -d
```

Then you need to configure in your .env.local

* GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET from your google app dev console
* FACEBOOK_CLIENT_ID and FACEBOOK_CLIENT_SECRET from your facebook developer app