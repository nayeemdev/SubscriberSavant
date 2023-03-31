# Integration Engineer assignment

## Background / Intro

One of the the most basic and key features of MailerLite is managing subscribers. Someone needs to receive your beautiful newsletters created on MailerLite so you need to have a great way to handle that data. There are a few different ways how it can be achieved:

* `Add subscriber` form in our web app
* Public HTTP API endpoint
* Custom and unique web form or landing page 
* Other services which are integrated with MailerLite using our API

All the ways mentioned above are based on using a single service dedicated to the management of subscribers.

## Task: API Integration

Your main task is to create a simple PHP application for managing the subscribers of a MailerLite account via the MailerLite API.

You can find more information about the MailerLite API at https://developers.mailerlite.com

### Features
Your PHP application should have the following features:

Validating and saving an API key:
* Validate an account's API key against the MailerLite API
* Save the valid key in the database.
* Next time the user opens the page, load the key from the database

---
Showing the subscribers of an account:
* Use DataTables (https://datatables.net/) to display all the subscribers of the account. The email, name, country, subscribe date and subscribe time of each subscriber should be displayed on the table (5 fields).
* An account may have millions of subscribers so it is not efficient to load and show all of them at once. For that reason, you should implement pagination and only load a few subscribers for each page. To implement this feature, please use the server side data source of the DataTables library.
* It should be possible to use the search field to search for subscribers by email and to change the number of subscribers displayed per page.
* Do not do any direct calls to the MailerLite API from the frontend. Instead, proxy all requests through the backend of your application.

The subscribe date should be in the day/month/year format while the subscribe time should be in the 24-hour format with leading zeroes.

---
Creating subscribers:
* Create a page with a form that asks the user to type the email, name and country of a subscriber.
* By pressing submit, your backend creates a new subscriber using the MailerLite API.
* API errors are handled gracefully by your application (e.g. subscriber already exists, invalid email, etc.) and an error is shown to the user
* On success, a message is shown to the user.

---
Deleting a subscriber:
* A button should exist next to each subscriber in the DataTable that deletes the subscriber via a MailerLite API call.
* Like before, do not call the MailerLite API from the frontend but proxy the request through your backend.
* No need to show a popup to confirm the delete, just delete the subscriber.
* Optional bonus: handle everything (delete and table refresh) without a page redirect.

---
Editing a subscriber:
* Clicking on a subscriber email in the DataTable opens the a form that allows the editing of the name and country subscriber fields only.
* On save, the subscriber information is saved to MailerLite via an API call.



### General Requirements


* Laravel framework
* HTTP JSON API
* Validating requests
* Instructions how to run a project on local environment running PHP 7.4, MySQL 5.x and the latest Chrome browser
* PSR-2 compliant source code
* Write tests for the backend of your app


## Task II: Finish Line

Create a public repository on GitHub for your application source code, push it and send us the link


### Do not develop:

* User authentication
* CSRF
* Database migrations (just provide the .sql file)
