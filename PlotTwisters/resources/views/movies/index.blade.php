
<div>
    <h1>hello</h1>
    <a href="{{ route('movies.create') }}" class="btn btn-primary">Add Movie</a>
    <table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Director</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($listOfmovies as $movie)
            <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->director_name }}</td>
                <td>
                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Edit</a>
               
            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
            </form>    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
</div>
