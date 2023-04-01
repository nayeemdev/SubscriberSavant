<form class="form-card text-right mt-2" action="{{ route('subscribers.update', $subscriber->id) }}" method="POST">
    @method('PUT')
    <div class="col-12">
        <div class="form-group mb-2">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name', $subscriber->name) }}"
                   class="form-control @error('name') is-invalid @enderror" id="name">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" readonly value="{{ $subscriber->email }}"
                   class="form-control" id="email">
        </div>
        <div class="form-group mb-2">
            <label for="country">Country</label>
            <select name="country" id="country" class="form-control form-select @error('country') is-invalid @enderror">
                @foreach($countries as $country)
                    <option
{{--                            {{ old('country', $subscriber->$country) == $country['name'] ? 'selected' : ''}}--}}
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
