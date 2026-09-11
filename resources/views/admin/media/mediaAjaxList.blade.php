@forelse ($mediaData as $mediaItem)

    <div class="col-md-2">

        <div><input type="checkbox" class="mediacheckbox"/>

            <div class="adminMedia" onclick="abc(this)">

                @php
                $extension = strtolower(pathinfo($mediaItem->media, PATHINFO_EXTENSION));
                $mediaUrl = asset('storage/media/' . $mediaItem->media);

                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $videoExtensions = ['mp4', 'webm', 'ogg'];
                @endphp

                @if ($extension == 'pdf')

                <img src="{{ URL::asset('PDFICON.webp') }}"
                data-src="{{ $mediaUrl }}" />

                @elseif (in_array($extension, $videoExtensions))

                <video width="100%" height="250" controls>
                <source src="{{ $mediaUrl }}" type="video/{{ $extension }}">
                Your browser does not support the video tag.
                </video>

                @else

                <img src="{{ $mediaUrl }}"
                data-src="{{ $mediaUrl }}" />

                @endif



                <input type="hidden" id="uploadDate"

                    value="{{ date('M,d Y h:i a', strtotime($mediaItem->created_at)) }}">

                <input type="hidden" id="title" value="{{ $mediaItem->media }}">

                <input type="hidden" id="dbId" value="{{ $mediaItem->id }}">

                <input type="hidden" id="media" value="{{ $mediaItem->media }}">



                {{-- <p>{{ $mediaItem->title }}</p> --}}

            </div>

        </div>

    </div>

@empty

@endforelse

