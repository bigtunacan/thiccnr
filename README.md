## Project Structure
Thiccnr 3 is built on Slim 3, but tries to follow a structured
__MVC__ pattern along with the Front Controller pattern to ensure better
security.

__Front Controller__
The front controller should reside in public/index.php and this should
be the only file directly served by Apache.

The front controller `public/index.php` sets up autoloading and calls
`bootstrap/app.php` which should handle all shared setup such as
  - Slim app configurations
    - Template initialization (Twig/other)
  - Database connections setup
  - Loading of route files
  - etc...

__Views__
Views/Layouts/Templates reside in `resources/views`

__Routes__
  - Directory `routes/`
  - api.php is for JSON endpoints intended to be called via AJAX
    requests
  - web.php is for endpoints that should server-side render a webpage
  - additional route files (for example crons.php) should be added to `bootstrap/app.php`

__App__
  - The bulk of the application logic resides in the `app/`
    sub-directory.
  - Directories
    - Controllers
      - Controllers should logically organize code executed directly
        from routes.
      - Routes can call a Controller method in a manner such as
      - `$app->get('/users', UserController::class . ':index');`
        - Where `:inde` represents a function on the UserController
          class
    - Handlers
      - Custom exception handling
    - Middleware
      - Any custom Slim Middleware classes go here
    - Models
      - Organize database logic here
    - Validation
      - Custom validation classes reside in `Validation/Rules`
      - Corresponding exceptions reside in `Validation/Exceptions`
      - The Respect/Validation package is used for validations
        - https://github.com/Respect/Validation

__Helpers__
  `helpers/helpers.php` holds _global_ helper functions

  If helpers.php starts growing too large then it can be split up into
separate logical files and required in `bootstrap/app.php`

  __If helpers.php starts growing too large__ you may also consider if
you are __doing things wrong__ and look at a better means of
refactoring.
