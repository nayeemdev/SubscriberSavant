## About SubscriberSavant
SubscriberSavant is a tool for managing your email subscribers. It is a web application that allows you to manage your subscribers It is built on the [Laravel](http://laravel.com) PHP framework and uses [Bootstrap](http://getbootstrap.com) for the front-end. And for now its implemented with Mailerlite API.

## Installation
### Requirements
Basic requirements as needed Laravel 8.75.

### Installation
1. Clone the repository `git clone https://github.com/nayeemdev/SubscriberSavant`
2. Install the dependencies `composer install`
3. Copy the `.env.example` file to `.env` and fill in the database credentials
4. Generate application key `php artisan key:generate`
5. Import the database file `database/sql/database.sql` to your database
6. Get your Mailerlite API key from [here - Mailerlite](https://developers.mailerlite.com/)
7. Run the application `php artisan serve`
8. Visit `http://localhost:8000` in your browser
9. Set your Mailerlite API key in the integration page

## Extra Directory Explanation
```
app/DTO/ - Contains the Data Transfer Objects
app/Library/ - Contains the Mailerlite API library
app/Services/ - Contains the service classes
database/sql/ - Contains the database file
```
## Features
- Validating and saving an API key
- Listing all the subscribers
- Adding a new subscriber
- Updating an existing subscriber
- Deleting a subscriber
- Searching a subscriber

## Testing
In order to run the tests, you need to run the following command:
`php artisan test`

There are 2 tests file for Subscriber API and Integration. Subscriber API is unit test and other is feature test.
![TestCase](https://user-images.githubusercontent.com/40033062/229319968-e4c60d1f-8550-4b8b-8e52-ddbcdcfa2d3c.png)


## Screenshots
![List of Subscribers](https://user-images.githubusercontent.com/40033062/229320021-76c552cd-7fb3-4d64-a4bf-5e6a08f757f0.png)
![Api Integration](https://user-images.githubusercontent.com/40033062/229320012-3729edd2-4681-4de3-af0b-cfadbb2851fa.png)
![Create Subscriber](https://user-images.githubusercontent.com/40033062/229320008-7b7f8bd0-7da4-4e89-863e-06ad6148a884.png)
![Subscriber Edit](https://user-images.githubusercontent.com/40033062/229320017-a3e9ec20-345e-477c-b321-7ee18f57bb48.png)





