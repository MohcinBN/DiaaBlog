<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diaa Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
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
          <a href="" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Articles</a>
          <a href="#" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Videos</a>
          <a href="#" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Galeries</a>
          <a href="#" class="opacity-100 hover:opacity-75 transition duration-200 font-bold">Contact</a>
        </div>
      </nav>

      <div class="ml-16 mt-10">
        <h1 class="text-3xl font-bold">Hello! Welcome to</h1>
        <h2 class="text-9xl font-extrabold mt-4">Diaa<span class="text-orange-300">blg</span> blog</h2>
        <p class="mt-5 text-lg max-w-2xl">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Non ea in rem voluptatibus...
        </p>
        <div class="mt-8 animate-bounce cursor-pointer" onclick="scrollToNextSection()">
          <i class="fa-solid fa-arrow-down text-4xl"></i>
        </div>
      </div>
    </div>
  </section>

  <div class="mt-20"></div>

  <!-- Articles Section -->
  <section class="relative w-full py-16 bg-gray-100" id="nextSection">
    <div class="container mx-auto px-6">
      <h2 class="text-4xl font-bold text-center mb-12">Our Articles</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($posts as $post)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          @if($post->featured_image)
          <img src="{{ asset('storage/' . $post->featured_image) }}"
            alt="{{ $post->title }}"
            class="w-full h-56 object-cover">
          @else
          <img src="{{ asset('images/default-post.jpg') }}"
            alt="Image par défaut"
            class="w-full h-56 object-cover">
          @endif

          <div class="p-6">
            <h3 class="text-2xl font-bold mb-2">{{ $post->title }}</h3>
            <p class="text-gray-700 mb-4">
              {{ \Illuminate\Support\Str::limit($post->content, 150, '...') }}
            </p>
            <a href="{{ route('posts.show', $post->slug) }}" class="text-orange-500 font-semibold hover:underline">
              Read more
            </a>
          </div>
        </div>
        @if(!isset($post))
        <p class="text-center col-span-3 text-gray-600 text-lg">Aucun article disponible pour le moment.</p>
        @endif
      @endforeach
      </div>
    </div>
  </section>

  <div class="mt-20"></div>

  <!-- Gallery Section -->
  <section class="relative w-full py-16 bg-gray-100" id="nextSection">
    <div class="container mx-auto px-6">
      <h2 class="text-4xl font-bold text-center mb-12">Our Galeries</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($photos as $photo)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          @if($photo->image)
          <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-64 object-cover">
          @endif
          <div class="p-6">
            <h3 class="text-2xl font-bold mb-2">{{ $photo->title }}</h3>

            <p class="text-gray-700 mb-4">
              {{ \Illuminate\Support\Str::limit($photo->caption, 150, '...') }}
            </p>
            {{-- Remplace avec une route vers les détails si tu en as une --}}
            <a href="{{ route('photos.show', $photo->slug) }}" class="text-orange-500 font-semibold hover:underline">
              See more
            </a>
          </div>
        </div>
        @if(!isset($photos))
        <p class="text-center col-span-3 text-gray-600 text-lg">Aucune image disponible pour le moment.</p>
        @endif
      @endforeach
      </div>
    </div>
  </section>


  <div class="mt-20"></div>

  @if(isset($latestVideos) && $latestVideos->count())
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-4xl font-bold mb-6">Lasts YouTube Video</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($latestVideos as $video)
        <div class="bg-gray-100 p-4 rounded-lg shadow">
          <h3 class="text-xl font-semibold mb-2">{{ $video['title'] }}</h3>
          <div class="relative" style="padding-top: 56.25%;">
            <iframe
              class="absolute top-0 left-0 w-full h-full rounded-lg"
              src="https://www.youtube.com/embed/{{ $video['videoId'] }}"
              frameborder="0"
              allowfullscreen>
            </iframe>
          </div>
        </div>
        @endforeach
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
                  <a href="Home.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Home</a>
                </li>
                <li>
                  <a href="Articl.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Articles</a>
                </li>
                <li>
                  <a href="Team.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Team</a>
                </li>
                <li>
                  <a href="Contact.html" class="text-gray-400 hover:text-gray-100 font-semibold block pb-2 text-sm">Contact</a>
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

  <!-- Navbar Scroll Script -->
  <script>
    window.addEventListener("scroll", function() {
      let navbar = document.getElementById("navbar");
      let navbarLinks = document.querySelectorAll("#navbar a");
      let sectionOne = document.querySelector("section");

      if (window.scrollY > sectionOne.offsetHeight - 50) {
        navbar.classList.add("bg-white", "shadow-md");
        navbar.classList.remove("text-white");
        navbar.classList.add("text-black");

        navbarLinks.forEach(link => {
          link.classList.remove("text-white");
          link.classList.add("text-black");
        });
      } else {
        navbar.classList.remove("bg-white", "shadow-md", "text-black");
        navbar.classList.add("text-white");

        navbarLinks.forEach(link => {
          link.classList.remove("text-black");
          link.classList.add("text-white");
        });
      }
    });
  </script>

  <!-- Scroll to next section -->
  <script>
    function scrollToNextSection() {
      const nextSection = document.getElementById('nextSection');
      nextSection.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  </script>

</body>

</html>