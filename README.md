<p align="center">
    <h1 align="center">Mid-level PHP Yii2 Developer Task: Build a
Car Store</h1>
    <br>
</p>

This documentation is dedicated to work you through this application from cloning to setting it up and serving it on your local machine.

## Video Walkthrough

For a step-by-step video for the end result of the assignment:

[![Watch the video](https://img.youtube.com/vi/your-video-id/maxresdefault.jpg)](https://drive.google.com/file/d/1pdQXJt6vjjuzfJnG5g65OY5_hugYMa4l/view?usp=sharing)


## Cloning the application
**Using SSH :** `git clone git@github.com:yazanismail1/assignment.git`

## Initializing the application

`composer install`

`php init`

`php yii migrate`

## Serving the application

**Dashboard :** `php yii serve --docroot=dashboard/web`

**Storefront :** `php yii serve --docroot=storefront/web`

## Executing the background tasks

**To execute on demand:** `php yii queue/run`

**To auto listing:** `php yii queue/listen [timeout]`

## Setting up your local DB using docker

`docker run --name mysql-syarah -e MYSQL_ROOT_PASSWORD=root_password -e MYSQL_DATABASE=syarah_project -e MYSQL_USER=yazan -e MYSQL_PASSWORD=password -p 3306:3306 -d mysql:latest`
