
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
  <div class="bg-black w-full lg:w-1/2 mx-6 lg:mx-0 my-3 lg:my-2 border-4 max-lg:p-7 p-10  shadow-xl bg-opacity-30 rounded-2xl" style="border-color: #BC6C25">
    <div class="">
      <h1 class="text-white text-3xl font-bold pb-3">Register an account</h1>
      <p class="text-white text-sm md:text-md pb-6">Register for seamless livestock management with our RFID-based system.</p>

      <hr class="border-t-2 border-white bg-white">

      <!-- Login Form -->
      <form action="{{route('register.store')}}" method="POST">
        @csrf
        {{-- Input Groups for name --}}
        <div class="flex-col xl:flex gap-0 xl:gap-14 w-full lg:flex-row">
            <div class="mb-1 mt-5 w-1/2 max-xl:w-full">
                <label for="first_name" class="block mb-2 text-md font-medium text-white">First Name</label>
                <input type="text"  value='{{old('first_name')}}' name="first_name" autocomplete="off" id="first_name" style="color: #5F6C37" class="bg-white text-sm rounded-lg border-none focus:ring-2 block w-full pl-4 p-2.5 shadow-lg focus:bg-gray-200 duration-200 focus:ring-green-800 " placeholder="Enter first name">
                @error('first_name')
                        <p class="text-red-700 text-xs p-1">
                            {{$message}}
                        </p>
                @enderror
            </div>
            <div class="mb-1 mt-5 max-xl:mt-1 w-1/2 max-xl:w-full">
                <label for="last_name" class="block mb-2 text-md font-medium text-white">Last Name</label>
                <input type="text" name="last_name"  value='{{old('last_name')}}' autocomplete="off" id="last_name" style="color: #5F6C37" class="bg-white text-sm rounded-lg border-none focus:ring-2 block w-full pl-4 p-2.5 shadow-lg focus:bg-gray-200 duration-200 focus:ring-green-800 " placeholder="Enter last name">
                @error('last_name')
                        <p class="text-red-700 text-xs p-1">
                            {{$message}}
                        </p>
                @enderror
            </div>
        </div>

        {{-- Farm Name --}}
        <div class="mb-1 mt-1">
            <label for="farm_name" class="block mb-2 text-md font-medium text-white">Farm Name</label>
            <input type="text" name="farm_name" autocomplete="off"  value='{{old('farm_name')}}' id="farm_name" style="color: #5F6C37" class="bg-white text-sm rounded-lg border-none focus:ring-2 block w-full pl-4 p-2.5 shadow-lg focus:bg-gray-200 duration-200 focus:ring-green-800 " placeholder="Enter farm name">
            @error('farm_name')
                        <p class="text-red-700 text-xs p-1">
                            {{$message}}
                        </p>
            @enderror
        </div>

        {{-- Input Groups for email and username --}}
        <div class="flex-col xl:flex gap-0 xl:gap-14 w-full lg:flex-row">
            <div class="mb-1 mt-1 w-1/2 max-xl:w-full">
                <label for="email" class="block mb-2 text-md font-medium text-white">Email address</label>
                <input type="email" name="email" autocomplete="off"  value='{{old('email')}}' id="email" style="color: #5F6C37" class="bg-white text-sm rounded-lg border-none focus:ring-2 block w-full pl-4 p-2.5 shadow-lg focus:bg-gray-200 duration-200 focus:ring-green-800 " placeholder="youremail@gmail.com ">
                @error('email')
                        <p class="text-red-700 text-xs p-1">
                            {{$message}}
                        </p>
                @enderror
            </div>
            <div class="mb-1 mt-1 w-1/2 max-xl:w-full">
                <label for="username" class="block mb-2 text-md font-medium text-white">Username</label>
                <input type="text" name="username" autocomplete="off"  value='{{old('username')}}' id="username" style="color: #5F6C37" class="bg-white text-sm rounded-lg border-none focus:ring-2 block w-full pl-4 p-2.5 shadow-lg focus:bg-gray-200 duration-200 focus:ring-green-800 " placeholder="Enter username">
                @error('username')
                        <p class="text-red-700 text-xs p-1">
                            {{$message}}
                        </p>
                @enderror
            </div>
        </div>

        {{-- Input Groups for password--}}
        <div class="flex-col xl:flex gap-0 xl:gap-14 w-full lg:flex-row">
            <div class="mb-1 mt-1 w-1/2 max-xl:w-full">
                <label for="password" class="block mb-2 text-md font-medium text-white">Password</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path fill="#5F6C37" d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                    </div>
                    <input autocomplete="off" name="password" type="password" id="password" style="color: #5F6C37" class="bg-white text-sm rounded-lg focus:border-green-400 focus:ring-2 block w-full pl-10 p-2.5 z-0 shadow-lg border-none focus:bg-gray-200 duration-200 focus:ring-green-800" placeholder="Enter password">
                    
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3" >
                        <i class="fa fa-eye-slash cursor-pointer" id="toggle-eye" style="color: #5F6C37" onclick="togglePasswordVisibility()"></i>
                    </div>
                    @error('password')
                        <p class="text-red-700 text-xs pt-1">
                            {{$message}}
                        </p>
                   @enderror
                </div>
                
            </div>
            <div class="mb-1 mt-1 w-1/2 max-xl:w-full">
                <label for="password" class="block mb-2 text-md font-medium text-white">Confirm Password</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path fill="#5F6C37" d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                    </div>
                    <input autocomplete="off" name="password_confirmation" type="password" id="password-conf" style="color: #5F6C37" class="bg-white text-sm rounded-lg focus:border-green-400 focus:ring-2 block w-full pl-10 p-2.5 z-0 shadow-lg border-none focus:bg-gray-200 duration-200 focus:ring-green-800" placeholder="Confirm password">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3" >
                        <i class="fa fa-eye-slash cursor-pointer" id="toggle-eye-conf" style="color: #5F6C37" onclick="toggleCPasswordVisibility()"></i>
                    </div>
                    
                </div>
            </div>
        </div>

        {{-- For terms and condition --}}
        <div class="mb-3 pb-2">
            <input type="checkbox"  name="terms" class="bg-white border-white text-green-500 focus:ring-0 duration-200 mb-1" id="terms" disabled>
            <label class=" text-white pl-4" for="terms">Please confirm that you agree to our </label>
            <span class="text-green-400 hover:font-bold duration-400 cursor-pointer font-medium" onclick="termsModal.showModal()">terms & condition </span>
            @error('terms')
                        <p class="text-red-500 text-xs pt-1">
                            {{$message}}
                        </p>
            @enderror
            
            <dialog id="termsModal" class="w-1/3 max-lg:w-2/3 max-sm:w-full backdrop:bg-black backdrop:bg-opacity-40 px-10 rounded-xl shadow-lg border-4" style="border-color: #BC6C25"> 
              
              <div class="flex items-start justify-between pt-3">
                  <h3 class="text-2xl font-bold text-gray-600">
                    Terms of Service
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent duration-200 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="termsModal.close()">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              
              <p class="text-gray-400 text-md font-light pb-2">Last update November 09, 2023</p>
              <hr>

              <div class="overflow-y-scroll h-80 my-5 px-6 overflow-x-hidden flex flex-col text-justify" id="scrollTerm">   
                <b class="text-xl">Welcome to TagMyHerd!</b>
                <br>
                <span class="">These terms and conditions outline the rules and regulations for the use of Tag My Herd's Website, located at tagmyherd.com.</span>
                <br>
                <span class="">By accessing this website we assume you accept these terms and conditions. Do not continue to use TagMyHerd if you do not agree to take all of the terms and conditions stated on this page.</span>
                <br>
                <span class="">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company's terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client's needs in respect of provision of the Company's stated services, in accordance with and subject to, prevailing law of ph. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</span>

                <br>
                <b class="text-lg">Cookies</b>
                <br>

                <span>We employ the use of cookies. By accessing TagMyHerd, you agreed to use cookies in agreement with the Tag My Herd's Privacy Policy.</span>
                
                <br>
                
                <span>Most interactive websites use cookies to let us retrieve the user's details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</span>
                <br>
                <b class="text-lg">License</b>
                <br>
                <span>Unless otherwise stated, Tag My Herd and/or its licensors own the intellectual property rights for all material on TagMyHerd. All intellectual property rights are reserved. You may access this from TagMyHerd for your own personal use subjected to restrictions set in these terms and conditions.</span>

                <br>
                <span class="text-md">You must not:</span>
                
                <br>
                
                <ul style="list-style-type: disc; margin-left: 3rem;">
                  <li>Republish material from TagMyHerd</li>
                  <li>Sell, rent, or sub-license material from TagMyHerd</li>
                  <li>Reproduce, duplicate, or copy material from TagMyHerd</li>
                  <li>Redistribute content from TagMyHerd</li>
                </ul>

                <br>

                <span>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Tag My Herd does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Tag My Herd,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Tag My Herd shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</span>

                <br>

                <span>
                  Tag My Herd reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.
                </span>

                <br>
                <span class="text-md">You warrant and represent that:</span>
                
                <br>
                
                <ul style="list-style-type: disc; margin-left: 3rem;">
                  <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
                  <li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
                  <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
                  <li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
                </ul>

                <br>

                <span>
                  You hereby grant Tag My Herd a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.
                </span>

                <br>

                <b class="text-lg">Hyperlinking to our Content</b>

                <br>

                <span class="text-md">The following organizations may link to our Website without prior written approval:</span>
                
                <br>
                
                <ul style="list-style-type: disc; margin-left: 3rem;">
                  <li>Government agencies;</li>
                  <li>Search engines;</li>
                  <li>News organizations;</li>
                  <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
                  <li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
                </ul>

                <br>

                <span>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party's site.</span>
                
                <br>
                
                <span class="text-md">We may consider and approve other link requests from the commonly-known consumer and/or business information sources;following types of organizations:</span>
                
                <br>
                
                <ul style="list-style-type: disc; margin-left: 3rem;">
                  <li>commonly-known consumer and/or business information sources;</li>
                  <li>dot.com community sites;</li>
                  <li>associations or other groups representing charities;</li>
                  <li>online directory distributors;</li>
                  <li>internet portals;</li>
                  <li>accounting, law and consulting firms; and</li>
                  <li>educational institutions and trade associations.</li>
                </ul>

                <br>

                <span>
                  We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Tag My Herd; and (d) the link is in the context of general resource information.
                </span>

                <br>

                <span>
                  These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party's site.
                </span>

                <br>

                <span>
                  If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Tag My Herd. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.
                </span>

                <br>

                <span class="text-md">Approved organizations may hyperlink to our Website as follows:</span>
                
                <br>
                
                <ul style="list-style-type: disc; margin-left: 3rem;">
                  <li>By use of our corporate name; or</li>
                  <li>By use of the uniform resource locator being linked to; or</li>
                  <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party's site.</li>
                </ul>

                <br>

                <span>
                  No use of Tag My Herd's logo or other artwork will be allowed for linking absent a trademark license agreement.
                </span>

                <br>

                <b class="text-lg">iFrames</b>

                <br>

                <span>
                  Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.
                </span>

                <br>

                <b class="text-lg">Content Liability</b>

                <br>

                <span>
                  We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights
                </span>

                <br>

                <b class="text-lg">Reservation of Rights</b>

                <br>

                <span>
                  We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it's linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.
                </span>

                <br>

                <b class="text-lg">Removal of links from our website</b>

                <br>

                <span>
                  If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.
                </span>

                <br>

                <span>
                  We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.
                </span>

                <br>
                
                <b class="text-lg">Disclaimer</b>

                <br>

                <span class="text-md">To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</span>
                
                <br>
                
                <ul style="list-style-type: disc; margin-left: 3rem;">
                  <li>limit or exclude our or your liability for death or personal injury;</li>
                  <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
                  <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
                  <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
                </ul>

                <br>

                <span>
                  The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.
                </span>

                <br>

                <span>
                  As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.
                </span>


              </div>

              <div class="flex flex-col md:flex-row gap-4 mb-3">
                <button class="flex items-center justify-center flex-col bg-transparent  hover:bg-orange-500 duration-200 text-orange-700 font-semibold hover:text-white py-2 px-10 border border-orange-500 hover:border-transparent rounded text-center" type="button" onclick="disagreeTerms()">
                  Decline
                </button>
              
                <button disabled class="flex items-center justify-center flex-col disabled:bg-gray-400 disabled:text-gray-300 disabled:border-0 bg-orange-500 hover:bg-orange-600 duration-200 text-white font-semibold hover:text-white py-2 px-10 border border-orange-500 hover:border-transparent rounded text-center" type="button" id="agreeBtn" onclick="agreeTerms()">
                  Accept
                </button>
              </div>
              
              
              


            </dialog>
            
        </div>

        <button type="submit" class="btn block mb-6 p-2 rounded-md bg-white w-full hover:bg-green-600 duration-200" style="color: #344403">Register</button>
      </form>

      <div class="my-4 flex items-center before:mt-0.5 before:flex-1 before:border-t before:border-neutral-300 after:mt-0.5 after:flex-1 after:border-t after:border-neutral-300">
        <p class="mx-4 mb-0 text-center font-medium dark:text-white">Or </p>
      </div>

      <h2 class="text-center text-white text-lg hover:text-green-300 duration-200"><a href="{{route('login')}}">Already have an account?</a></h2>
   
    </div>
  </div>
</div>


<script>
  const scrollableDiv = document.getElementById('scrollTerm');
  const agreeBtn = document.getElementById('agreeBtn');

  function isScrolledToTheEnd() {
    return scrollableDiv.scrollTop === scrollableDiv.scrollHeight - scrollableDiv.clientHeight;
  }
  
  function handleScrollEvent() {
    if (isScrolledToTheEnd()) {
        agreeBtn.disabled = false;
    }
  }

  scrollableDiv.addEventListener('scroll', handleScrollEvent);
</script>

<script>

    function agreeTerms(){
      const checkbox = document.getElementById('terms');
      const terms = document.getElementById('termsModal');

      checkbox.checked = true;
      checkbox.disabled = false;
      terms.close();

    }

    function disagreeTerms(){
      const checkbox = document.getElementById('terms');
      const terms = document.getElementById('termsModal');

      checkbox.checked = false;
      checkbox.disabled = true;
      terms.close();

    }

   function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('#toggle-eye');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.add('fa-eye');
      eyeIcon.classList.remove('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      eyeIcon.classList.add('fa-eye-slash');
      eyeIcon.classList.remove('fa-eye');
    }
  }
  function toggleCPasswordVisibility() {
    const passwordInput = document.getElementById('password-conf');
    const eyeIcon = document.querySelector('#toggle-eye-conf');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.add('fa-eye');
      eyeIcon.classList.remove('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      eyeIcon.classList.add('fa-eye-slash');
      eyeIcon.classList.remove('fa-eye');
    }
  }
</script>


@include('partials.__footer')