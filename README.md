# CommentSold Code Challenge

This is an application for the CommentSold take home code challenge/assignment.

I attempted to demonstrate various different skillsets for this challenge, but there are many things I would have done if this was not code challenge. My overall goal was to show my familiarity with Laravel and Vue.js.

## Setup

 1. Install [Docker](https://www.docker.com/)
 2. Install [PHP](https://formulae.brew.sh/formula/php)
 3. Install [Composer](https://getcomposer.org/)
 4. Clone this repo
 5. Run `composer install && ./vendor/bin/sail install`
 6. Copy the `.env.example` to a new file called `.env`
 7. Run `./vendor/bin/sail up -d && ./vendor/bin/sail artisan key:generate && ./vendor/bin/sail artisan migrate && ./vendor/bin/sail artisan db:seed`
 8. Install [Node](https://nodejs.org/en/)
 9. Run `npm i -g yarn && yarn && yarn dev`
 10. Go to http:://localhost on your browser 
 11. Login with one of the supplied user emails and passwords

What would I have expanded upon or added to:

 - Additional tests
	 - I believe in TDD, but I wanted to show you my overall skills in a timely manor.
	 - Jest testing
 - Finish writing out all the model factories
 - Code cleanup/logic separation
	 - Using a prettier package and manual changes to comply with code standards
 - Complete PSR-2 standards
	 - I did what I could given the time with any custom code that was not Artisan generated
 - Not use Vuetify 3
	 - This includes removing the TailwindCSS Vue 3 boilerplate and replacing it with Vuetify
	 - I have been looking forward to the release of Vuetify 3, but once I realized that it was not yet production ready it was too late.
		 - I would have added the specific searches to each column to the inventory table, but the slots did not exist, so I had to settle with a generic search bar.
