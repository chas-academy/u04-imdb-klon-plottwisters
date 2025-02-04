<x-head-layout>
</x-head-layout>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Movie: {{ $movie->title }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
                        </div>

                        <!-- Director -->
                        <div class="mb-3">
                            <label for="director_name" class="form-label">Director</label>
                            <input type="text" name="director_name" id="director_name" class="form-control" value="{{ old('director_name', $movie->director_name) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $movie->description) }}</textarea>
                        </div>

                        <!-- Trailer URL -->
                        <div class="mb-3">
                            <label for="trailer_url" class="form-label">Trailer URL</label>
                            <input type="url" name="trailer_url" id="trailer_url" class="form-control" value="{{ old('trailer_url', $movie->trailer_url) }}">
                        </div>

                        <!-- Image URL -->
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $movie->image_url) }}">
                            @if($movie->image_url)
                                <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="img-fluid mt-2">
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update Movie</button>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


