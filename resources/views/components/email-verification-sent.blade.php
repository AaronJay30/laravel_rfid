@include('partials.__header')

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
    <div class="card p-14 mx-8 sm:mx-0 bg-black border-4 shadow-xl bg-opacity-30 rounded-2xl" style="border-color: #BC6C25">
        <div class="text-center">
            <img src="{{asset('img/email-verify.png')}}" class="sm:w-1/2 w-3/4 mx-auto">
            <h1 class="card-title text-white text-3xl font-bold pb-3 capitalize">Verify your email address!</h1>
            <p class="text-white text-lg pb-6">We have sent a verification link to <span class="font-bold text-green-300">{{ $email }}</span>
            </p>
            <p class="text-white text-lg">Click on the link to complete the verification process.</p>
            <p class="text-white text-lg pb-6">You might need to<span class="font-bold text-green-300"> check your spam folder.</span></p>



        </div>
    </div>
</div>


    
@include('partials.__footer')