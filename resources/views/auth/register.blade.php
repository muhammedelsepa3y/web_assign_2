@extends('layouts.app')

@section('title', __('messages.registration'))

@section('content')
<div id="translations" style="display:none;"
     data-please="{{ __('messages.pleaseEnterAnameFirst') }}"
     data-male="{{ __('messages.male') }}"
     data-female="{{ __('messages.female') }}"
        data-not="{{ __('messages.notFound') }}"
        data-gender = "{{ __('messages.gender') }}"
     data-error="{{ __('messages.errorFetchingGender') }}" >
</div>  
    <h1>{{ __('messages.registration') }}</h1>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
    <div class="form-group">
        <label for="full_name">{{ __('messages.full_name') }}</label>
        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="{{ __('messages.full_name') }}" value="{{ old('full_name') }}" required>
        <button type="button" onclick="checkGender()" class="btn btn-info">{{ __('messages.checkGender') }}</button>
        
        <span id="gender_result"></span>
        <span class="error" id="full_name_error">{{ $errors->first('full_name') }}</span>
    </div>
       
        <div class="form-group">
            <label for="user_name">{{ __('messages.user_name') }}</label>
            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="{{ __('messages.user_name') }}" value="{{ old('user_name') }}" required>
            <span class="error" id="user_name_error">{{ $errors->first('user_name') }}</span>
        </div>
        <div class="form-group">
            <label for="birthdate">{{ __('messages.birthdate') }}</label>
            <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="{{ __('messages.birthdate') }}" value="{{ old('birthdate') }}" required>
            <span class="error" id="birthdate_error">{{ $errors->first('birthdate') }}</span>
        </div>
        <div class="form-group">
            <label for="phone">{{ __('messages.phone') }}</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="{{ __('messages.phone') }}" value="{{ old('phone') }}" required>
            <span class="error" id="phone_error">{{ $errors->first('phone') }}</span>
        </div>
        <div class="form-group">
            <label for="address">{{ __('messages.address') }}</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="{{ __('messages.address') }}" value="{{ old('address') }}" required>
            <span class="error" id="address_error">{{ $errors->first('address') }}</span>
        </div>
        <div class="form-group">
            <label for="email">{{ __('messages.email') }}</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('messages.email') }}" value="{{ old('email') }}" required>
            <span class="error" id="email_error">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group">
            <label for="password">{{ __('messages.password') }}</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('messages.password') }}" required>
            <span class="error" id="password_error">{{ $errors->first('password') }}</span>
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('messages.password_confirmation') }}</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('messages.password_confirmation') }}" required>
            <span class="error" id="password_confirmation_error">{{ $errors->first('password_confirmation') }}</span>
        </div>
        <div class="form-group">
            <label for="user_image">{{ __('messages.user_image') }}</label>
            <input type="file" class="form-control" name="user_image" id="user_image"  required>
            <span class="error" id="user_image_error">{{ $errors->first('user_image') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
    </form>
    <script >
        
        // public/js/genderCheck.js
function checkGender()  {
    var name = document.getElementById('full_name').value;
    var translations = document.getElementById('translations').dataset;

    if (name.length == 0) {
        document.getElementById('gender_result').textContent = translations.please;

    } else {
        
        fetch(`https://api.genderize.io/?name=${name}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('gender_result').textContent = translations.gender+ ': '+ (data.gender ? data.gender==='male'?translations.male : translations.female  : translations.not);
            })
            .catch(error => {
                document.getElementById('gender_result').textContent =translations.error ;
            });
    }
}

    </script>

@endsection
