@php
    $tag = '';
    if (isset($hashtag)) $tag = $hastag;
@endphp

<div class="flex overflow-x-scroll py-4">

@foreach(InstagramBasicFeed::getUserMediasWithHashtag($tag) as $media)

    <div class="mr-4 rounded shadow-lg bg-white">
        <!-- <div class="w-full flex justify-between p-3">
            <div class="flex">
                <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                        <img src="https://avatars0.githubusercontent.com/u/38799309?v=4" alt="profilepic">
                </div> 
                <span class="pt-1 font-bold text-sm">{{ $media->username }}</span>
            </div>
            <span class="px-2 hover:bg-gray-300 cursor-pointer rounded"><i
                        class="fas fa-ellipsis-h pt-2 text-lg"></i>
            </span>
        </div> -->
        <img class="w-40 h-40 object-cover rounded-tl rounded-tr" src="{{ $media->media_url }}">
    
        @if (property_exists($media, 'caption'))
           
        <div class="w-40 px-3">
            <div class="my-3 text-xs truncate">
                <span class="font-medium text-sm mb-2">{{ $media->username }}</span><br><br>
                <span class="font-normal text-xs">{{ $media->caption }}<span>
            </div>
        </div>

        @endif
    </div>

@endforeach

</div>
