<x-frontend page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}">

    <div class="min-h-screen mx-auto w-5/6">
        <header class="flex justify-center md:justify-between flex-col md:flex-row py-4 items-center">
            <div class="logo w-full text-center md:w-1/2 md:text-left">
                <a href="{{ route('home') }}">
                    <h3 class="text-4xl font-bold">{{ $siteTitle }}</h3>
                </a>
            </div>

            <nav class="w-1/2 gap-8 md:flex md:justify-end mt-5 md:mt-0">
              @guest('admin')
                <a href="{{ route('admin.login') }}" target="__blank" class="py-3 px-3 bg-[#3b7ddd] rounded-md text-white text-center hover:bg-[#3776d4] transition-all ease-in-out delay-100 block w-full md:w-auto">Master Login</a>
              @endguest

              @auth('admin')
                <a href="{{ route('admin.dashboard') }}" target="__blank" class="py-3 px-3 bg-[#3b7ddd] rounded-md text-white text-center hover:bg-[#3776d4] transition-all ease-in-out delay-100">Master Dashboard</a>
              @endauth

            </nav>
        </header>


        <section class="hero py-20 lg:py-52">

            <h1 class="text-6xl md:text-7xl font-bold text-center">
                <span>Guide.</span>
                <span>Learn.</span>
                <span>Grow. </span>
            </h1>

            @guest
            <div class="button-group mt-10 flex justify-center mx-auto w-full md:w-1/2 lg:w-4/12 gap-2 flex-col md:flex-row">
                <a href="{{ route('student.register') }}" class="py-3 px-3 border border-red-500 text-center text-xl rounded-md w-full md:w-2/5 transition-all ease-in-out delay-100 bg-red-500 text-white hover:bg-red-600">Register</a>
                <a href="{{ route('student.login') }}" class="py-3 px-3 bg-[#3b7ddd] text-white text-center text-xl rounded-md w-full md:w-2/5 transition-all ease-in-out delay-100 border-[#3b7ddd] hover:bg-[#3776d4]">Login</a>
            </div>
            @endguest

            @auth
            <div class="button-group mt-10 flex justify-center mx-auto w-full md:w-1/2 lg:w-4/12 gap-2 flex-col md:flex-row">
                <a href="{{ route('student.dashboard') }}" class="py-3 px-3 border border-red-500 text-center text-xl rounded-md w-full md:w-2/5 transition-all ease-in-out delay-100 bg-red-500 text-white hover:bg-red-600">Dashboard</a>

                <form action="{{ route('student.logout') }}" method="POST" class="w-full md:w-2/5">
                    @csrf
                    <button class="py-3 px-3 bg-[#3b7ddd] text-white text-center text-xl w-full rounded-md transition-all ease-in-out delay-100 border border-[#3b7ddd] hover:bg-[#3776d4]" type="submit">
                        Logout
                    </button>
                </form>
            </div>
            @endauth


            <div class="text-center mt-20">
                <p class="bg-white mx-auto w-32">Developed By</p>
            </div>


            <div class="flex justify-center mx-auto w-96 mt-8">
                <img src="{{ asset('assets/frontend/logo/rabbitmaid.png') }}" alt="RabbitMaid Logo" class="w-2/5 md:w-1/2 mx-auto grayscale hover:grayscale-0 transition-all ease-in-out delay-150 hover:cursor-pointer hover:scale-95" style="object-fit: cover">

                <img src="{{ asset('assets/frontend/logo/crestlancing.png') }}" alt="CrestLancing Logo" class="w-2/5 md:w-1/2  mx-auto grayscale hover:grayscale-0 transition-all ease-in-out delay-150 hover:cursor-pointer hover:scale-95" style="object-fit: cover">
            </div>


        </section>
    </div>

</x-frontend>
