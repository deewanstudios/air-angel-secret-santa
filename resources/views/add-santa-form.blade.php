@extends('layouts.app')
@section('content')



    <div class="">
        <form method="post" action="/secret-santa/process">
            @csrf
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInput">Name</label>
                    <input name="fullname" type="text" class="form-control mb-2"
                           id="inlineFormInput"
                           placeholder="Jane Doe" value="{{old('fullname')}}">
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInputGroup">Email</label>

                    <input name="email" type="email" class="form-control"
                           id="inlineFormInputGroup"
                           placeholder="jane.doe@doemail.com" value="{{old('email')}}">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger flex-column">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @else
        @if(request()->session()->get('success_message'))
            <div class="alert alert-success">
                {{request()->session()->get('success_message')}}
            </div>
        @endif
    @endif

@endsection
