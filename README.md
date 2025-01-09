# Overview
## Tables
* Users
* Profiles
* Roles
* Categories
* Books
* Authors

## Relations
* User [One-to-One] Profile
* Role [One-to-Many] Users
* Category [One-to-Many] Books
* Book [Many-to-Many] Authors

## Features
* Login/Logout
* Get Authenticated User
* CRUD Books