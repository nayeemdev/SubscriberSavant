<form class="form-card text-right mt-2" method="POST" action="{{ route('integration.validate') }}">
    <div class="col-12">
        <div class="form-group mb-2">
            <label for="api_key">API Key</label>
            <textarea name="api_key" id="api_key"
                      class="form-control @error('api_key') is-invalid @enderror"
                      rows="4">{{ old('api_key', getApiKey('mailerlite')) }}</textarea>
            @error('api_key')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary bg-mailerlite border-0 mt-2">
                Validate and Save
            </button>
        </div>
    </div>
</form>
