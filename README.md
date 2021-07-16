# Yuforms
Yuforms is an open source improvable form web application like google forms. This application is my final project to graduate from Suleyman Demirel University computer engineering/computer science. Not completed, under development..

## Notice!
Front-end of this project is [here](https://github.com/abdyek/yuforms-web)

## Installation on local with yuforms-web

### API

clone this repository

`git clone https://github.com/abdyek/yuforms`

move it xampp or other php server

`mv ./yuforms /opt/lampp/htdocs/yuforms`

change directory

`cd /opt/lampp/htdocs/yuforms`

install dependency

`composer install`

create database called "yuforms" and import **yuforms.sql** file in generated-sql directory and **form_components.sql** in assets directory

### Front-end

change directory

`cd ~`

clone yuforms-web

`git clone https://github.com/abdyek/yuforms-web`

change directory

`cd yuforms-web`

install dependency

`npm install`

set proxy to recognize yuforms api

You must edit vue.config.js in root directory of project

start nodejs development server

`npm run serve`
