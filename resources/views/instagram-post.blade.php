@php
    $tag = '';
    if (isset($hashtag)) $tag = $hastag;
@endphp

@foreach(InstagramBasicFeed::getUserMediasWithHashtag($tag) as $media)
    <div class="rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
        <div class="w-full flex justify-between p-3">
            <div class="flex">
                {{-- <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                        <img src="https://avatars0.githubusercontent.com/u/38799309?v=4" alt="profilepic">
                    </div> --}}
                <span class="pt-1 font-bold text-sm">{{ $media->username }}</span>
            </div>
            {{-- <span class="px-2 hover:bg-gray-300 cursor-pointer rounded"><i
                        class="fas fa-ellipsis-h pt-2 text-lg"></i></span> --}}
        </div>
        <img class="w-full bg-cover" src="{{ $media->media_url }}">
    
        @if (property_exists($media, 'caption'))
            <div class="px-3">
                <div class="my-3 text-sm">
                    {{-- <span class="font-medium mr-2">{{ $media->username }}</span> --}}
                    {{ $media->caption }}
                </div>
            </div>
        @endif
    </div>
@endforeach