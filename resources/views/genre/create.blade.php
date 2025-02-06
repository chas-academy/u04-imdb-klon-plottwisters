<div>
<form action="{{route('genre-storing-route')}}" method="POST">
     @csrf
     <div class="mb-3">
         <label for="name" class="form-label">Name</label>
         <input type="text" name="name" class="form-control" required>

         <button type="submit" class="btn btn-primary">Save Genre</button>

     </div>
 
    
</div>
