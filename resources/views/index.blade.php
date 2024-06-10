<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/css/hp.css" />
        <noscript><link rel="stylesheet" href="/css/noscript.css" /></noscript>
    </head>
   

    
    <body class="font-sans antialiased">
    <header>
        <div class="logo-container">
     <a href="#section0">         <img src="img/logoh2.png" alt="Logo"></a>
        </div>
        <div class="BUTTONS"> 
            <nav>
                
                <ul>
                
                    <li><a href="#section1">Courses</a></li>
                    <li><a href="#section2">Tests</a></li>
                    <li><a href="#section3">Start generating</a></li>
                    <li><a href="#section4">About us</a></li>  
                    
                    @if (Route::has('login'))
                          
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                   <li> <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                 Login
                                    </a></li>  


                                    @if (Route::has('register'))
                                        <li><a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            Register
                                        </a> </li>
                                    @endif
                                @endauth
                                   </nav>
                        @endif
            
                </ul>
            </nav>
    </div>
                       </header>
<section id="section0">   

</br></br></br></br></br></br></br>
  
 <div class="image"> <img src="img/mainbg.jpg" alt="image"> 
 </div>
 <div class="text">  <h1>Where learning </br> Meets Intelligence </br> Get Smarter Today!</h1> 
 <div class="button-container"></div> <button class="my-button"> <a href="c:\Users\msi\Desktop\PFE\homepage\new\STARTGENERATING.html">GET STARTED </a></button>

 </div> 
 </div>
</section>   
<section id="section1">
   
                <div id="section1" class="section">			
                  <div class="image-container"> <img src="img/bgcourses2.jpg" alt="image"> 
                  <div class="text2"><h1>Review your lessons</h1>
                    </br>
					<ul class="actions special">
						<li><a href="#one" class="button scrolly"> </a><button class="button-COURSES"><a href="new/COURSES.html">COURSES</a></button></li>
					</ul>
				</div>
            </div></div>
			</section>
            <div id="section2" class="section">			
            <div class="image-container"> <img src="img/bgtests.jpg" alt="image"> 
                  <div class="text2"><h1>Take your tests</h1>
                    </br>
					<ul class="actions special">
						<li><a href="#one" class="button scrolly"> </a><button class="button-COURSES"><a href="new/COURSES.html">COURSES</a></button></li>
					</ul>
				</div>
            </div></div>
			</section>
    

            <section id="section3">
                <div id="section3" class="section">			
                <div class="image-container"> <img src="img/bgstartgenerating.jpg" alt="image"> 	
                <div class="text2"><h1>Practice more
                    <div class="text9">Try your own test</h1>
					<ul class="actions special">
						<li><a href="#one" class="button scrolly"></a><button class="button-COURSES"> <a href="new/COURSES.html">START GENERATING</a></button></li>
					</ul>
				</div></div> </div></div>
			</section>
            <section id="section4">
                <div id="section4" class="section">	
                <div class="image-container"> <img src="img/bgaboutus.jpg" alt="image"> 		
                <div class="text2"><h1>Get to know us</h1>
					
					<ul class="actions special">
						<li><a href="#one" class="button scrolly"></a><button class="button-COURSES"> <a href="new/COURSES.html">ABOUT US</a></button></li>
					</ul>
				</div></div> </div>
			</section>
                    <footer class="py-16 text-center text-sm text-black">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
