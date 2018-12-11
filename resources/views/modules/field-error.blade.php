{{-- module for displaying form validation errors on the page --}}
@if($errors->get($field))
    <div class='error'>*{{ $errors->first($field) }}</div>
@endif