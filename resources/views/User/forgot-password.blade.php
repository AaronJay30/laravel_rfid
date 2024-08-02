@include('partials.__header')

{{-- @include('partials.__loader') --}}

<style>
    body{
        background-image: url("{{asset('img/background.png')}}");
        background-size: cover; 
        background-repeat: no-repeat; 
        background-position: center;
        font-family: 'Lato', sans-serif;

    }
</style>


<div class="min-h-screen flex items-center justify-center">
    <div class="card p-10 sm:p-14 mx-8 sm:mx-0 bg-black border-4 shadow-xl bg-opacity-30 rounded-2xl" style="border-color: #BC6C25">
        <div class="card-body">
        <h1 class="card-title text-white text-3xl font-bold pb-3 text">Forgot your password?</h1>
        <p class="text-white text-md pb-6">Enter your email and we'll send you a link to reset your password.</p>
    
        <hr class="border-t-2 border-white bg-white">
    
        <!-- Login Form -->
        <form action="{{route('forgot.password.post')}}" method="POST">
            @csrf
            <!-- Email Input -->
            <div class="mb-5 mt-3">
            <label for="input-group-1" class="block mb-2 text-md font-medium text-white">Email Address</label>
            <div class="relative mb-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none" >
                <svg xmlns="http://www.w3.org/2000/svg"  height="1em" viewBox="0 0 512 512"><path fill="#5F6C37" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>            
                </div>
                <input type="email" name="email" value='{{old('email')}}' autocomplete="off" id="input-group-1" style="color: #5F6C37" class="bg-white text-sm rounded-lg border-none focus:ring-2 block w-full pl-10 p-2.5 shadow-lg focus:bg-gray-200 duration-200 focus:ring-green-800 " placeholder="Enter email">
    
            </div>
            @error('email')
                <p class="text-red-500 text-xs pt-1">
                    {{$message}}
                </p>
            @enderror
            </div>
    
            <button type="submit" class="btn block mb-6 p-2 rounded-md bg-white w-full hover:bg-green-600 duration-200" style="color: #344403">Forgot Password</button>
        </form>
    
        <div class="my-4 flex items-center before:mt-0.5 before:flex-1 before:border-t before:border-neutral-300 after:mt-0.5 after:flex-1 after:border-t after:border-neutral-300">
            <p class="mx-4 mb-0 text-center font-medium dark:text-white">Or </p>
        </div>
    
        <h2 class="text-center text-white text-lg hover:text-green-300 duration-200"><a href="{{route('login')}}"><i class="fa fa-angle-left fa-lg mr-3"></i>Return to login</a></h2>
        
        </div>
    </div>
    </div>

    
@include('partials.__footer')