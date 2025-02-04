
<x-head-layout>
    <div>
        <h1>make movie entry</h1>
    
        <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
    
        <div class="mb-3">
            <label for="trailer_url" class="form-label">Trailer URL</label>
            <input type="url" name="trailer_url" class="form-control">
        </div>
    
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="url" name="image_url" class="form-control">
        </div>
    
        <div class="mb-3">
            <label for="director_name" class="form-label">Director</label>
            <input type="text" name="director_name" class="form-control">
        </div>
    
        <button type="submit" class="btn btn-primary">Save Movie</button>
    </form>
    </div>
</x-head-layout>

