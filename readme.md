# Andres-Heredia-Test-Code
CRUD Application Using Laravel, VueJS, Bootstrap-Vue and Axios
## Quickstart
```
# Install Dependencies
composer install

# Run Migrations
php artisan migrate

# Import Articles
php artisan db:seed

# Add virtual host if using Apache  
#Configure the env. file so it fits the database you'll use (or copy it)

# If you get an error about an encryption key
php artisan key:generate

# Install JS Dependencies
npm install

# Install Bootstrap-Vue
npm i bootstrap-vue

# Install Axios
npm install axios

# Watch Files
npm run watch
```

## Endpoints
### List all articles with links and meta

```
GET api/articles
```
### Get single article
```
GET api/article/{id}
```
### Delete article
```
DELETE api/article/{id}
```
### Add article
```
POST api/article
title/body
```
Update article
```
PUT api/article
article_id/title/body
```

```
## App Info

### Author

Andres Heredia Guerra

### Special Thanks

Brad Traversy

```
