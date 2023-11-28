@extends('frontend.layouts.app')
@section('main')
    <main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        <!-- Newsfeed -->
        <section id="newsfeed" class="space-y-6">
            <!-- Barta Card -->
            <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
                <!-- Barta Card Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full object-cover"
                        src="{{ asset(($post->user->getFirstMediaUrl() ?: 'avatar.jpg')) }}" alt="" />
                </div>
                <!-- /User Avatar -->

                            <!-- User Info -->
                            <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                <a href="{{ url('/profile/user/' . $post->user->uuid) }}" class="hover:underline font-semibold line-clamp-1">
                                    {{ $post->user->name }}
                                </a>

                                <a href="{{ url('/profile/user/' . $post->user->uuid) }}" class="hover:underline text-sm text-gray-500 line-clamp-1">
                                    {{ $post->user->userName }}
                                </a>
                            </div>
                            <!-- /User Info -->
                        </div>


                    </div>
                </header>

                <!-- Content -->
                <div class="py-4 text-gray-700 font-normal">
                    <p>
                        {{ $post->description }}
                    </p>
                </div>

                <!-- Date Created & View Stat -->
                <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                    <span class="">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                    <span class="">•</span>
                    <span>3 comments</span>
                    <span class="">•</span>
                    <span>450 views</span>
                </div>

                <hr class="my-6" />

                <!-- Barta Create Comment Form -->
                <form action="{{route('commentUpdate',$comment->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <!-- Create Comment Card Top -->
                    <div>
                        <div class="flex items-start /space-x-3/">
                            <!-- User Avatar -->
                            <!-- <div class="flex-shrink-0">-->
                            <!--              <img-->
                            <!--                class="h-10 w-10 rounded-full object-cover"-->
                            <!--                src="https://avatars.githubusercontent.com/u/831997"-->
                            <!--                alt="Ahmed Shamim" />-->
                            <!--            </div> -->
                            <!-- /User Avatar -->

                            <!-- Auto Resizing Comment Box -->
                            <div class="text-gray-700 font-normal w-full">
                                <input x-data="{
                                    resize() {
                                        $el.style.height = '0px';
                                        $el.style.height = $el.scrollHeight + 'px'
                                    }
                                }" x-init="resize()" @input="resize()" type="text" name="comment" value="{{ $comment->comment }}"
                                    placeholder="Write a comment..."
                                    class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900">
                            </div>
                        </div>
                    </div>

                    <!-- Create Comment Card Bottom -->
                    <div>
                        <!-- Card Bottom Action Buttons -->
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="mt-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                                Update Comment
                            </button>
                        </div>
                        <!-- /Card Bottom Action Buttons -->
                    </div>
                    <!-- /Create Comment Card Bottom -->
                </form>
                <!-- /Barta Create Comment Form -->

                <!-- /Barta Card Bottom -->
            </article>
            <!-- /Barta Card -->

        </section>
        <!-- /Newsfeed -->
    </main>
@endsection
