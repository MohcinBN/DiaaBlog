<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Diaa Blog</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        <!-- Correct Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>    
<body class="min-h-screen">
    <!-- First Section -->
    <section class="relative w-full h-screen">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-orange-400 text-white flex flex-col justify-center">
            <div class="absolute inset-0">
                <img src="{{ URL::to('/') }}/static/images/bg_1.jpg.webp" 
                     alt="Background" 
                     class="w-full h-full object-cover opacity-20">
            </div>

            <nav id="navbar" class="fixed top-0 w-full flex justify-between items-center px-8 text-white text-xl py-4 z-50 transition-all duration-300">
                <a href="Home.html" class="text-5xl font-bold ml-8">
                    Diaa<span class="text-orange-300" style="font-family: 'Poppins', sans-serif">blg</span>
                </a>
                <div class="flex space-x-6 mr-8">
                    <a href="#" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Home</a>
                    <a href="#" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Articles</a>
                    <a href="#" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Team</a>
                    <a href="#" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Contact</a>
                </div>
            </nav>
            

            <div class="ml-16 mt-10">
                <h1 class="text-3xl font-bold">Hello! Welcome to</h1>
                <h2 class="text-9xl font-extrabold mt-4">Diaa<span class="text-orange-300">blg</span> blog</h2>
                <p class="mt-5 text-lg max-w-2xl">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non ea in rem voluptatibus, fugit quisquam quos facilis repudiandae qui veritatis necessitatibus minus numquam vitae eveniet optio iure fuga eaque vero?
                </p>
                <div class="mt-8 animate-bounce cursor-pointer" onclick="scrollToNextSection()">
                    <i class="fa-solid fa-arrow-down text-4xl"></i>
                </div>                
            </div>
        </div>
    </section>

    <div class="mt-20"></div>

    <!-- Second Section -->
    <section class="relative w-full" id="nextSection">
    <div class="flex justify-center items-center space-x-8 px-4">
        <div class="w-1/2 mb-6">
            <img src="technology-communication-icons-symbols-concept.jpg" alt="cover" class="w-full h-auto object-cover mr-5">
        </div>

        <div class="w-1/2 text-center mt-4 text-lg max-w-2xl">
            <p class="font-bold text-black">
                A blog is a platform where individuals or organizations can share their thoughts, ideas, and expertise on a variety of topics. It serves as a space for creativity, learning, and interaction with a community of readers. Whether it's about technology, lifestyle, education, or entertainment, blogs offer valuable insights and help in building a strong online presence. The beauty of a blog lies in its ability to provide real-time updates, promote discussion, and connect people with similar interests across the globe.
            </p>
            <div class="flex justify-center space-x-5 mt-4">
                <div>
                    <a href="#" class="bg-gray-300 p-3 rounded-full transition duration-300 hover:bg-orange-500">
                        <i class="fa-brands fa-x-twitter text-black text-2xl"></i>
                    </a>
                </div>

                <div>
                    <a href="#" class="bg-gray-300 p-3 rounded-full transition duration-300 hover:bg-orange-500">
                        <i class="fa-brands fa-facebook-f text-black text-2xl"></i>
                    </a>
                </div>

                <div>
                    <a href="#" class="bg-gray-300 p-3 rounded-full transition duration-300 hover:bg-orange-500">
                        <i class="fa-brands fa-instagram text-black text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="mt-20"></div>

@if(isset($latestVideo))
<section class="py-16 ">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">Last youtube video</h2>

        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl font-semibold mb-4">{{ $latestVideo['title'] }}</h3>
            <div class="relative" style="padding-top: 56.25%;">
                <iframe
                    class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg"
                    src="https://www.youtube.com/embed/{{ $latestVideo['videoId'] }}"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</section>
@else
<section class="py-16 bg-gray-100 text-center">
    <p class="text-gray-600 text-lg">Aucune vidéo trouvée.</p>
</section>
@endif

    <div class="mt-20"></div>

    
    <!-- Footer -->
    <footer class="relative bg-gray-800 pt-8 pb-6">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap text-left lg:text-left">
      <div class="w-full lg:w-6/12 px-4">
        <h4 class="text-3xl font-semibold">
          <a href="Home.html" class="text-3xl font-bold ml-8">
            Diaa<span class="text-orange-300" style="font-family: 'Poppins', sans-serif">blg</span>
          </a>
        </h4>
        <h5 class="text-lg mt-0 mb-2 text-gray-400 ml-8 w-1/2">
          Find us on any of these platforms, we respond within 1-2 business days.
        </h5>
        <div class="mt-6 lg:mb-0 mb-6 mr-8 ml-8 flex space-x-2">
          <button class="bg-white text-blue-400 shadow-lg font-normal h-10 w-10 flex items-center justify-center rounded-full">
            <i class="fab fa-twitter"></i>
          </button>
          <button class="bg-white text-blue-600 shadow-lg font-normal h-10 w-10 flex items-center justify-center rounded-full">
            <i class="fab fa-facebook-square"></i>
          </button>
          <button class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 flex items-center justify-center rounded-full">
            <i class="fab fa-instagram"></i>
          </button>
          <button class="bg-white text-gray-800 shadow-lg font-normal h-10 w-10 flex items-center justify-center rounded-full">
            <i class="fab fa-github"></i>
          </button>
        </div>
      </div>

      <div class="w-full lg:w-6/12 px-4">
        <div class="flex flex-wrap items-top mb-6">
          <div class="w-full lg:w-4/12 px-4 ml-auto">
            <span class="block uppercase text-gray-300 text-sm font-semibold mb-2">Useful Links</span>
            <ul class="list-unstyled">
              <li>
                <a href="About.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">About Us</a>
              </li>
              <li>
                <a href="blog.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Blog</a>
              </li>
              <li>
                <a href="Contact.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Contact</a>
              </li>
              <li>
                <a href="Menu.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Menu</a>
              </li>
            </ul>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <span class="block uppercase text-gray-300 text-sm font-semibold mb-2">Other Resources</span>
            <ul class="list-unstyled">
              <li>
                <a href="#" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Privacy Policy</a>
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Terms & Conditions</a>
              </li>
              <li>
                <a href="#" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Support</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <hr class="my-6 border-gray-700" />

    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-4/12 px-4 mx-auto text-center">
        <div class="text-sm text-gray-400 font-semibold py-1">
          © 2025 DiaaBlog. All rights reserved.
        </div>
      </div>
    </div>
  </div>
</footer>

    <script>
    window.addEventListener("scroll", function () {
        let navbar = document.getElementById("navbar");
        let navbarLinks = document.querySelectorAll("#navbar a"); // Get all links in the navbar
        let sectionOne = document.querySelector("section"); // First section

        // Check if the scroll is past the first section
        if (window.scrollY > sectionOne.offsetHeight - 50) {
            // Change background color, shadow, and text color of navbar and links
            navbar.classList.add("bg-white", "shadow-md");
            navbar.classList.remove("text-white");
            navbar.classList.add("text-black");

            // Change text color of each navbar link
            navbarLinks.forEach(link => {
                link.classList.remove("text-white");
                link.classList.add("text-black");
            });
        } else {
            // Reset to original state before scrolling past the section
            navbar.classList.remove("bg-white", "bg-opacity-90", "shadow-md", "text-black");
            navbar.classList.add("text-white");

            // Reset text color of each navbar link
            navbarLinks.forEach(link => {
                link.classList.remove("text-black");
                link.classList.add("text-white");
            });
        }
    });
</script>

<!-- Script to scroll to the next section by the rowe icon-->

<script>
    // Function to scroll to the next section
    function scrollToNextSection() {
        // Get the next section by its ID
        const nextSection = document.getElementById('nextSection');
        
        // Scroll to the next section with smooth behavior
        nextSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
</script>
</body>
</html>