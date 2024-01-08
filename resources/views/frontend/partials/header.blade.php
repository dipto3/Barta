<header>
    <!-- Navigation -->
    <nav x-data="{ mobileMenuOpen: false, userMenuOpen: false }" class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="{{ url('/home') }}">
                            <h2 class="font-bold text-2xl">Barta</h2>
                        </a>
                    </div>
                    <!--              <div class="hidden sm:ml-6 sm:flex sm:space-x-8">-->
                    <!--                &lt;!&ndash; Current: "border-gray-800 text-gray-900 font-semibold", Default: "border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800" &ndash;&gt;-->
                    <!--                <a-->
                    <!--                  href="#"-->
                    <!--                  class="inline-flex items-center border-b-2 border-gray-800 px-1 pt-1 text-sm font-semibold text-gray-900"-->
                    <!--                  >Discover</a-->
                    <!--                >-->
                    <!--                <a-->
                    <!--                  href="#"-->
                    <!--                  class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-600 hover:border-gray-300 hover:text-gray-800"-->
                    <!--                  >For you</a-->
                    <!--                >-->
                    <!--                <a-->
                    <!--                  href="#"-->
                    <!--                  class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-600 hover:border-gray-300 hover:text-gray-800"-->
                    <!--                  >People</a-->
                    <!--                >-->
                    <!--              </div>-->
                </div>
                <!-- Search input -->
                <form action="{{ route('search') }}" method="get" class="flex items-center">
                    @csrf
                    <input type="text" name="search" placeholder="Search..."
                        class="  @error('search')  border-red-500 @enderror border-2 border-gray-300 bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none">
                    @error('search')
                        <span style="float: left; color:red;">{{ $message }}</span>
                    @enderror
                </form>

                <!-- notification start -->
                <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">

                    <div class="relative ml-3" x-data="{ open: false }">

                        <div>
                            <p style="float: right; color:red;"><b>{{ $totalLikeCount }} </b></p>
                            <button @click="open = !open" type="button"
                                class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                <svg fill="#000000" height="800px" width="800px" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 611.999 611.999" xml:space="preserve" class="w-5 h-5">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M570.107,500.254c-65.037-29.371-67.511-155.441-67.559-158.622v-84.578c0-81.402-49.742-151.399-120.427-181.203
           C381.969,34,347.883,0,306.001,0c-41.883,0-75.968,34.002-76.121,75.849c-70.682,29.804-120.425,99.801-120.425,181.203v84.578
           c-0.046,3.181-2.522,129.251-67.561,158.622c-7.409,3.347-11.481,11.412-9.768,19.36c1.711,7.949,8.74,13.626,16.871,13.626
           h164.88c3.38,18.594,12.172,35.892,25.619,49.903c17.86,18.608,41.479,28.856,66.502,28.856
           c25.025,0,48.644-10.248,66.502-28.856c13.449-14.012,22.241-31.311,25.619-49.903h164.88c8.131,0,15.159-5.676,16.872-13.626
           C581.586,511.664,577.516,503.6,570.107,500.254z M484.434,439.859c6.837,20.728,16.518,41.544,30.246,58.866H97.32
           c13.726-17.32,23.407-38.135,30.244-58.866H484.434z M306.001,34.515c18.945,0,34.963,12.73,39.975,30.082
           c-12.912-2.678-26.282-4.09-39.975-4.09s-27.063,1.411-39.975,4.09C271.039,47.246,287.057,34.515,306.001,34.515z
            M143.97,341.736v-84.685c0-89.343,72.686-162.029,162.031-162.029s162.031,72.686,162.031,162.029v84.826
           c0.023,2.596,0.427,29.879,7.303,63.465H136.663C143.543,371.724,143.949,344.393,143.97,341.736z M306.001,577.485
           c-26.341,0-49.33-18.992-56.709-44.246h113.416C355.329,558.493,332.344,577.485,306.001,577.485z" />
                                                <path d="M306.001,119.235c-74.25,0-134.657,60.405-134.657,134.654c0,9.531,7.727,17.258,17.258,17.258
           c9.531,0,17.258-7.727,17.258-17.258c0-55.217,44.923-100.139,100.142-100.139c9.531,0,17.258-7.727,17.258-17.258
           C323.259,126.96,315.532,119.235,306.001,119.235z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>


                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            @foreach ($user->post as $post)
                                @foreach ($post->likes as $like)
                                    <form action="{{ url("/post/{$post->id}/like/{$like->id}/mark-as-read") }}"
                                        method="post">
                                        @csrf
                                        @if ($like->read_at === null)
                                            <button type="submit"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                role="menuitem" tabindex="-1"
                                                id="user-menu-item-0">{{ $like->user->name }} liked your post
                                            </button>
                                        @endif
                                    </form>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- notification End -->
                <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
                    <!-- This Button Should Be Hidden on Mobile Devices -->
                    <!--              <button-->
                    <!--                type="button"-->
                    <!--                class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block">-->
                    <!--                Create Post-->
                    <!--              </button>-->

                    <!--              <button-->
                    <!--                type="button"-->
                    <!--                class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">-->
                    <!--                <span class="sr-only">View notifications</span>-->
                    <!--                &lt;!&ndash; Heroicon name: outline/bell &ndash;&gt;-->
                    <!--                <svg-->
                    <!--                  class="h-6 w-6"-->
                    <!--                  xmlns="http://www.w3.org/2000/svg"-->
                    <!--                  fill="none"-->
                    <!--                  viewBox="0 0 24 24"-->
                    <!--                  stroke-width="1.5"-->
                    <!--                  stroke="currentColor"-->
                    <!--                  aria-hidden="true">-->
                    <!--                  <path-->
                    <!--                    stroke-linecap="round"-->
                    <!--                    stroke-linejoin="round"-->
                    <!--                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />-->
                    <!--                </svg>-->
                    <!--              </button>-->

                    <!--              <button-->
                    <!--                type="button"-->
                    <!--                class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">-->
                    <!--                <span class="sr-only">Messages</span>-->
                    <!--                <svg-->
                    <!--                  xmlns="http://www.w3.org/2000/svg"-->
                    <!--                  fill="none"-->
                    <!--                  viewBox="0 0 24 24"-->
                    <!--                  stroke-width="1.5"-->
                    <!--                  stroke="currentColor"-->
                    <!--                  class="w-6 h-6">-->
                    <!--                  <path-->
                    <!--                    stroke-linecap="round"-->
                    <!--                    stroke-linejoin="round"-->
                    <!--                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />-->
                    <!--                </svg>-->
                    <!--              </button>-->

                    <!-- Profile dropdown -->
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" type="button"
                                class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="{{ asset(Auth::user()->getFirstMediaUrl() ?: 'avatar.jpg') }}"
                                    alt="profile" />
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <a href="{{ url('/profile/user/' . Auth::user()->uuid) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="{{ url('/profile/' . Auth::user()->uuid) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                tabindex="-1" id="user-menu-item-1">Edit Profile</a>

                            <form action="{{ route('logout') }}" method="post"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @csrf
                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">
                                    {{--
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" --}} Sign out</a>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <!-- Icon when menu is open -->
                        <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- <!-- Mobile menu, show/hide based on menu state. -->
        <!--        <div-->
        <!--          x-show="mobileMenuOpen"-->
        <!--          class="sm:hidden"-->
        <!--          id="mobile-menu">-->
        <!--          <div class="space-y-1 pt-2 pb-3">-->
        <!--            &lt;!&ndash; Current: "bg-gray-50 border-gray-800 text-gray-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" &ndash;&gt;-->
        <!--            <a-->
        <!--              href="#"-->
        <!--              class="block border-l-4 border-gray-800 bg-gray-50 py-2 pl-3 pr-4 text-base font-medium text-gray-700"-->
        <!--              >Discover</a-->
        <!--            >-->
        <!--            <a-->
        <!--              href="#"-->
        <!--              class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"-->
        <!--              >For You</a-->
        <!--            >-->
        <!--            <a-->
        <!--              href="#"-->
        <!--              class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"-->
        <!--              >People</a-->
        <!--            >-->
        <!--          </div>-->
        <!--          <div class="border-t border-gray-200 pt-4 pb-3">-->
        <!--            <div class="flex items-center px-4">-->
        <!--              <div class="flex-shrink-0">-->
        <!--                <img-->
        <!--                  class="h-10 w-10 rounded-full"-->
        <!--                  src="https://avatars.githubusercontent.com/u/831997"-->
        <!--                  alt="Ahmed Shamim Hasan Shaon" />-->
        <!--              </div>-->
        <!--              <div class="ml-3">-->
        <!--                <div class="text-base font-medium text-gray-800">-->
        <!--                  Ahmed Shamim Hasan Shaon-->
        <!--                </div>-->
        <!--                <div class="text-sm font-medium text-gray-500">-->
        <!--                  shaon@shamim.com-->
        <!--                </div>-->
        <!--              </div>-->
        <!--            </div>-->
        <!--            <div class="mt-3 space-y-1">-->
        <!--              <a-->
        <!--                href="#"-->
        <!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
        <!--                >Create New Post</a-->
        <!--              >-->
        <!--              <a-->
        <!--                href="./profile.html"-->
        <!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
        <!--                >Your Profile</a-->
        <!--              >-->
        <!--              <a-->
        <!--                href="./edit-profile.html"-->
        <!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
        <!--                >Edit Profile</a-->
        <!--              >-->
        <!--              <a-->
        <!--                href="#"-->
        <!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
        <!--                >Sign out</a-->
        <!--              >-->
        <!--            </div>-->
        <!--          </div>-->
        <!--        </div>--> --}}
    </nav>
</header>
