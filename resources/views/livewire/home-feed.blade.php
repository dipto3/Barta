{{-- <div> --}}
<section id="newsfeed" class="space-y-6">
    @foreach ($posts as $post)
        <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Barta Card Top -->
            <header>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- User Avatar -->
                        <div class="flex-shrink-0">
                            <img src="{{ asset($post->user->getFirstMediaUrl() ?: 'avatar.jpg') }}"
                                class="h-10 w-10 rounded-full object-cover" alt="" />
                        </div>
                        <!-- /User Avatar -->

                        <!-- User Info -->
                        <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                            <a href="{{ route('profile', $post->user->uuid) }}"
                                class="hover:underline font-semibold line-clamp-1">
                                {{ $post->user->name }}
                            </a>

                            <a href="{{ route('profile', $post->user->uuid) }}"
                                class="hover:underline text-sm text-gray-500 line-clamp-1">
                                {{ $post->user->userName }}
                            </a>
                        </div>
                        <!-- /User Info -->
                    </div>

                    @if (Auth::user()->id == $post->user_id)
                        <!-- Card Action Dropdown -->
                        <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                            <div class="relative inline-block text-left">
                                <div>
                                    <button @click="open = !open" type="button"
                                        class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                        id="menu-0-button">
                                        <span class="sr-only">Open options</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Dropdown menu -->
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <a href="{{ route('postEdit', $post->uuid) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                        tabindex="-1" id="user-menu-item-0">Edit</a>
                                    <form action="{{ route('postRemove', $post->id) }}" method="POST"
                                        class="block  py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" role="menuitem"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 "
                                            id="user-menu-item-1">Delete</button>
                                    </form>
                                </div>
                            </div>
                    @endif
                </div>
                <!-- /Card Action Dropdown -->
                </div>
            </header>

            <!-- Content -->
            <div class="py-4 text-gray-700 font-normal">
                <img src="{{ $post->getFirstMediaUrl() }}"
                    class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72" alt="dd" />
                <p>
                    {{ $post->description }}
                </p>
            </div>

            <!-- Date Created & View Start -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                <span class="">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>

                <span class="">•</span>
                <span>{{ $post->total_views }} views</span>
            </div>

            <!-- Barta Card Bottom -->
            <footer class="border-t border-gray-200 pt-2">
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-between">
                    <div class="flex gap-8 text-gray-600">

                        <form action="{{ route('postLike', $post->id) }}" method="post">
                            @csrf
                            <!-- Heart Button -->
                            <button type="submit"
                                class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                                <span class="sr-only">Like</span>
                                @if(Auth::user()->likes()->where('post_id', $post->id)->exists())
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                                @else
                                <!-- Show this icon when not liked -->
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                @endif
                                <p>{{ $post->likes()->count() }}</p>
                            </button>
                            <!-- /Heart Button -->
                        </form>
                        <!-- Comment Button -->
                        <a href="{{ route('singlePost', $post->uuid) }}" type="button"
                            class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                            <span class="sr-only">Comment</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                            </svg>

                            <p>{{ $post->comments->count() }}</p>
                        </a>
                        <!-- /Comment Button -->
                    </div>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </footer>
            <!-- /Barta Card Bottom -->
        </article>
    @endforeach
    <button wire:click="loadMore"
        class="m-5 m-auto mt-3 flex gap-2 text-xs items-center rounded-full px-16 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
        Show More</button>
</section>
{{-- </div> --}}
