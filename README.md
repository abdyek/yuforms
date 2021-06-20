# Yuforms
Yuforms is an open source improvable form web application like google forms. This application is my final project to graduate from Suleyman Demirel University computer engineering/computer science. Not completed, under development..

## Notice!
I will remove all front-end codes in this repository. I have started coding again with VueJs on another repository for UI as **SPA**
The repository [here](https://github.com/abdyek/yuforms-web)

## Installation on Localhost

clone this repository

`git clone https://github.com/abdyek/yuforms`

move it xampp or other php server

`mv ./yuforms /opt/lampp/htdocs/yuforms`

change directory

`cd /opt/lampp/htdocs/yuforms`

installation dependency

`composer install`

create database called "yuforms" and import the sql file on mysql server

## Requirement Analysis
if the requirements look like poor for you don't worry. There is more idea in my mind to add in the project. I only want hold minimal the scale of this project for now.

| Period | Exam | Requirement | Description | API |
| ----------- | :---------: | :---------: | :---------: | ----------- |
| Autumn | Midterm | Signup | Signup to use all functions of the web application | :heavy_check_mark: |
| Autumn | Midterm | Confirm Email | Confirm email to finish sign up | :heavy_check_mark: |
| Autumn | Midterm | Login | Login with account to use all functions | :heavy_check_mark: |
| Autumn | Midterm | Forgot My Password | Reset my password by email | :heavy_check_mark: |
| Autumn | Midterm | Change Password | Change password for any reason | :heavy_check_mark: |
| Autumn | Midterm | Change Email | Change email for any reason | :heavy_check_mark: |
| Autumn | Midterm | Log out | Log out account | :heavy_check_mark: | 
| Autumn | Final | Create Form | Create form to share | :heavy_check_mark: | 
| Autumn | Final | List My Forms | List my forms created by myself | :heavy_check_mark: | 
| Autumn | Final | Share Form | Share form for other users to submit it | :heavy_check_mark: | 
| Autumn | Final | Edit Form | Edit form if didn't share it | :heavy_check_mark: | 
| Autumn | Final | Delete Form | Delete form | :heavy_check_mark: | 
| Autumn | Final | Submit Form | Submit form to transfer info by form inputs | :heavy_check_mark: | 
| Autumn | Final | Manage Options of Form Access | Manage options of form access. It means which user types can access the form. | :heavy_check_mark: | 
| Spring | Midterm | Save as Template | Save form as template to share again anytime | :heavy_check_mark: | 
| Spring | Midterm | 2FA | Two factor authentication for account security | :heavy_check_mark: | 
| Spring | Midterm | Edit Template | Edit template | :heavy_check_mark: | 
| Spring | Midterm | Delete Template | Delete template | :heavy_check_mark: | 
| Spring | Midterm | Share Template | Share template other people | :heavy_check_mark: | 
| Spring | Midterm | Edit Answer | Edit answer submitted | :heavy_check_mark: | 
| Spring | Midterm | Freeze Account | Freeze account | :x: | 
| Spring | Final | Delete Answer | Delete answer by admin | :x: | 
| Spring | Final | Form Component Dimension Management | it means form inputs be more flexible | :x: | 
| Spring | Final | Free Form Design | It means form tools can float in the page | :x: | 
| Spring | Final | Set Color Palette to Form | Set color palette to form for customize | :x: | 
| Spring | Final | Show Statistical Chart | Show statistical chart to analyze submits | :x: | 
| Spring | Final | Show Answers | Show answers that come from form | :x: | 
| Spring | Final | Log in with Socail Media | Log in  with socail media. google etc. | :x: | 

## Project Plan
![project plan](https://github.com/abdyek/yuforms/blob/master/assets/readme/plan.png?raw=true)
