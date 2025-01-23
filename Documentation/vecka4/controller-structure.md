# Controller Structure for the Project

## MovieController
Handles operations related to movies, including listing, displaying details, and search functionality.

### Methods:
- `index()`:
  - Purpose: Display a list of movies (homepage or movies page).
  - Route: `GET /movies`

- `show($id)`:
  - Purpose: Display details of a specific movie.
  - Route: `GET /movies/{id}`

- `search(Request $request)`:
  - Purpose: Handle search queries for movies based on title or genre.
  - Route: `GET /movies/search`
  - Parameters: `query` (search keyword).

- `filterByGenre($genreId)`:
  - Purpose: Display movies filtered by a specific genre.
  - Route: `GET /movies/genre/{genreId}`

---

## ReviewController
Handles CRUD operations for movie reviews.

### Methods:
- `index()`:
  - Purpose: Display all reviews for a specific movie.
  - Route: `GET /reviews?movie_id={id}`
  - Parameters: `movie_id` (ID of the movie).

- `store(Request $request)`:
  - Purpose: Allow a user to submit a new review.
  - Route: `POST /reviews`
  - Parameters: `movie_id`, `rating`, `comment`.

- `update(Request $request, $id)`:
  - Purpose: Update an existing review.
  - Route: `PUT /reviews/{id}`
  - Parameters: `rating`, `comment`.

- `destroy($id)`:
  - Purpose: Delete a review.
  - Route: `DELETE /reviews/{id}`

---

## UserController
Handles user-related functionality for both regular and admin users.

### Methods:
- `index()`:
  - Purpose: Display a list of all users (admin-only feature).
  - Route: `GET /users`

- `show($id)`:
  - Purpose: Display details of a specific user, including their reviews and lists.
  - Route: `GET /users/{id}`

- `update(Request $request, $id)`:
  - Purpose: Allow a user to update their profile information.
  - Route: `PUT /users/{id}`
  - Parameters: `name`, `email`, `password` (optional).

- `destroy($id)`:
  - Purpose: Allow an admin to delete a user.
  - Route: `DELETE /users/{id}`