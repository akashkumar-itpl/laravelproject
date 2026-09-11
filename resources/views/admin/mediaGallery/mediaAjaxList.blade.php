@forelse ($mediaData as $mediaItem)
    <div class="col-md-2">
        <div class="adminMedia" onclick="abc(this)">
            @if (pathinfo($mediaItem->media, PATHINFO_EXTENSION) == 'pdf')
                <img src="{{ URL::asset('front/img/pdf.png') }}"
                    data-src="{{ asset('storage/mediaGallery/' . $mediaItem->media) }}" />
            @else
                <img src="{{ asset('storage/mediaGallery/' . $mediaItem->media) }}"
                    data-src="{{ asset('storage/mediaGallery/' . $mediaItem->media) }}" />
            @endif

            <input type="hidden" id="uploadDate" value="{{ date('M,d Y h:i a', strtotime($mediaItem->created_at)) }}">
            <input type="hidden" id="title" value="{{ $mediaItem->title }}">
            <input type="hidden" id="dbId" value="{{ $mediaItem->id }}">
            <input type="hidden" id="media" value="{{ $mediaItem->media }}">

            {{-- <p>{{ $mediaItem->title }}</p> --}}
        </div>
    </div>
@empty
@endforelse
