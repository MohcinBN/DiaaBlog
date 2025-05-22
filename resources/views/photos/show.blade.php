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
<body class="bg-gray-100 text-gray-900">
    <!-- Navbar -->
    <nav class="fixed top-0 w-full flex justify-between items-center px-8 py-4 z-50 bg-white shadow">
        <a href="{{ url('/') }}" class="text-5xl font-bold text-black" style="font-family: 'Poppins', sans-serif">
            Diaa<span class="text-orange-300">blg</span>
        </a>
        <div class="flex space-x-6">
            <a href="#" class="hover:opacity-75 font-bold">Home</a>
            <a href="#" class="hover:opacity-75 font-bold">Articles</a>
            <a href="#" class="hover:opacity-75 font-bold">Videos</a>
            <a href="#" class="hover:opacity-75 font-bold">Galeries</a>
            <a href="#" class="hover:opacity-75 font-bold">Contact</a>
        </div>
    </nav>

    <div class="mt-24"></div>

    <div class="border-t pt-10 mt-10 text-center ms-[550px]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow rounded p-4 hover:shadow-md transition">
                @if($photo->image)
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-40 object-cover rounded mb-4">
                @endif

                <h3 class="text-xl font-bold mb-2">
                    <span class="hover:text-orange-400 transition">
                        {{ $photo->title }}
                    </span>
                </h3>

                <h3 class="text-xl font-bold mb-2">
                    <span class="hover:text-orange-400 transition">
                        {{ $photo->caption }}
                    </span>
                </h3>

                <p class="text-gray-600 mb-4">
                    {{ Str::limit($photo->content, 100) }}
                </p>
            </div>
        </div>
    </div>


    <div class="mt-24"></div>

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

</body>
</html>
