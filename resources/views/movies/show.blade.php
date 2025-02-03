
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $movie->title }}</h1>
                </div>
                <div class="card-body">
                    @if($movie->image_url)
                        <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="img-fluid mb-3">
                    @endif
                    
                    <p><strong>Director:</strong> {{ $movie->director_name }}</p>
                    <p><strong>Description:</strong> {{ $movie->description }}</p>

                    @if($movie->trailer_url)
                        <div class="embed-responsive embed-responsive-16by9 mb-3">
                            <iframe class="embed-responsive-item" src="{{ $movie->trailer_url }}" allowfullscreen></iframe>
                        </div>
                    @endif

                    <h3>Genres</h3>
                    <ul>
                        @foreach($movie->genres as $genre)
                            <li>{{ $genre->name }}</li>
                        @endforeach
                    </ul>

                    <h3>Ratings</h3>
                    @if($movie->ratings->count() > 0)
                        <p>Average Rating: {{ number_format($movie->ratings->avg('rating'), 1) }} / 5</p>
                    @else
                        <p>No ratings yet.</p>
                    @endif

                    <h3>Reviews</h3>
                    @if($movie->reviews->count() > 0)
                        <ul>
                            @foreach($movie->reviews as $review)
                                <li><strong>{{ $review->user->name }}:</strong> {{ $review->content }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No reviews yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('movies.edit', $movie->id) }}" >Edit Movie</a>
</div>