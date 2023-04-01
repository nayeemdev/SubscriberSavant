<form class="form-card text-right mt-2" action="{{ route('subscribers.store') }}" method="POST">
    <div class="col-12">
        <div class="form-group mb-2">
            <label for="name">Name</label>
            <input required type="text" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror" id="name">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input required type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror" id="email">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="country">Country</label>
            <select required name="country" id="country"
                    class="form-control form-select @error('country') is-invalid @enderror">
                <option value="">Select country</option>
                @foreach($countries as $country)
                    <option
                            {{ old('country') == $country['name'] ? 'selected' : ''}}
                            value="{{ $country['name'] }}">{{ $country['name'] }}
                    </option>
                @endforeach
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
