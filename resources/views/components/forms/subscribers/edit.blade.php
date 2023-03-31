<form class="form-card text-right mt-2">
    <div class="col-12">
        <div class="form-group mb-2">
            <label for="email">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="email">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="email">Country</label>
            <select name="country" id="" class="form-control form-select @error('country') is-invalid @enderror">
                <option value="">Select Country</option>
                <option value="">Bangladesh</option>
                <option value="">India</option>
                <option value="">Pakistan</option>
            </select>
            @error('country')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary bg-mailerlite border-0 mt-2">Subscribe</button>
        </div>
    </div>
</form>
