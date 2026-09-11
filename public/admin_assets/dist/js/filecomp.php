<script>

$(".SingleimageUpload").change(async function () {

    let input = this;

    let file = input.files[0];

    if (!file) return;

    let extension = file.name
        .split('.')
        .pop()
        .toLowerCase();

    let progressBar =
        $("#progressBar");

    let msg =
        $("#compressMsg");

    // RESET
    progressBar.css(
        'width',
        '0%'
    );

    progressBar.text(
        '0%'
    );

    msg.html('');

    let originalSize = (
        file.size / 1024 / 1024
    ).toFixed(2);

    // TIFF BLOCK
    if (
        extension == 'tif' ||
        extension == 'tiff'
    ) {

        progressBar
            .removeClass(
                'bg-success'
            )
            .addClass(
                'bg-danger'
            );

        progressBar.css(
            'width',
            '100%'
        );

        progressBar.text(
            'ERROR'
        );

        msg.html(`
            <span class="text-danger">
                TIFF format not supported
            </span>
        `);

        return;
    }

    try {

        let compressedFile =
            await compressImageS(
                file,
                progressBar
            );

        // UPDATE INPUT FILE
        let dataTransfer =
            new DataTransfer();

        dataTransfer.items.add(
            compressedFile
        );

        input.files =
            dataTransfer.files;

        let compressedSize = (
            compressedFile.size /
            1024 /
            1024
        ).toFixed(2);

        msg.html(`
            <span class="text-success">
                Original:
                ${originalSize} MB
                |
                Compressed:
                ${compressedSize} MB
            </span>
        `);

    } catch (e) {

        console.log(e);

        progressBar
            .removeClass(
                'bg-success'
            )
            .addClass(
                'bg-danger'
            );

        progressBar.css(
            'width',
            '100%'
        );

        progressBar.text(
            'FAILED'
        );

        msg.html(`
            <span class="text-danger">
                Compression failed
            </span>
        `);
    }

});








async function compressImageS(
    file,
    progressBar
) {

    return new Promise((resolve, reject) => {

        let reader =
            new FileReader();

        reader.readAsDataURL(
            file
        );

        reader.onload =
            function (e) {

            let img =
                new Image();

            img.src =
                e.target.result;

            img.onload =
                async function () {

                let canvas =
                    document.createElement(
                        'canvas'
                    );

                let ctx =
                    canvas.getContext(
                        '2d'
                    );

                let width =
                    img.width;

                let height =
                    img.height;

                let maxWidth =
                    1600;

                // RESIZE LARGE IMAGE
                if (
                    width >
                    maxWidth
                ) {

                    height =
                        height *
                        (
                            maxWidth /
                            width
                        );

                    width =
                        maxWidth;
                }

                canvas.width =
                    width;

                canvas.height =
                    height;

                // WHITE BACKGROUND
                ctx.fillStyle =
                    "#ffffff";

                ctx.fillRect(
                    0,
                    0,
                    width,
                    height
                );

                ctx.drawImage(
                    img,
                    0,
                    0,
                    width,
                    height
                );

                let quality =
                    0.9;

                let progress =
                    0;

                async function generateBlob() {

                    return new Promise(
                        (
                            res
                        ) => {

                            canvas.toBlob(
                                function (
                                    blob
                                ) {

                                    res(
                                        blob
                                    );

                                },
                                'image/jpeg',
                                quality
                            );

                        }
                    );

                }

                let blob =
                    await generateBlob();

                while (
                    blob.size >
                        1024 *
                            1024 &&
                    quality >
                        0.1
                ) {

                    quality -=
                        0.1;

                    progress +=
                        10;

                    progressBar.css(
                        'width',
                        progress +
                            '%'
                    );

                    progressBar.text(
                        progress +
                            '%'
                    );

                    blob =
                        await generateBlob();
                }

                progressBar
                    .removeClass(
                        'bg-danger'
                    )
                    .addClass(
                        'bg-success'
                    );

                progressBar.css(
                    'width',
                    '100%'
                );

                progressBar.text(
                    '100%'
                );

                let compressedFile =
                    new File(
                        [blob],
                        file.name.replace(
                            /\.[^/.]+$/,
                            ".jpg"
                        ),
                        {
                            type:
                                'image/jpeg',

                            lastModified:
                                Date.now()
                        }
                    );

                resolve(
                    compressedFile
                );

            };

            img.onerror =
                function () {

                reject(
                    'Invalid image'
                );
            };

        };

        reader.onerror =
            function () {

            reject(
                'File read failed'
            );
        };

    });

}

</script>

<style>

.progress-container{
    width:100%;
    background:#e9ecef;
    border-radius:5px;
    overflow:hidden;
    height:22px;
    margin-top:5px;
}

.progress-bar-custom{
    height:100%;
    width:0%;
    background:#28a745;
    color:#fff;
    text-align:center;
    line-height:22px;
    font-size:12px;
    transition:0.3s;
}

.file-box{
    margin-bottom:15px;
}

</style>



<script>



// IMAGE UPLOAD
$(document).on(
    'change',
    '.image-upload',
    async function () {

    let input = this;

    let files = Array.from(
        input.files
    );

    if (!files.length) return;

    let msgBox = $(input)
        .closest('.col-sm-4')
        .find('.compress-msg');

    msgBox.html('');

    let finalFiles = [];

    for (
        let i = 0;
        i < files.length;
        i++
    ) {

        let file = files[i];

        let originalSize = (
            file.size /
            1024 /
            1024
        ).toFixed(2);

        let extension = file.name
            .split('.')
            .pop()
            .toLowerCase();

        // CREATE UI
        let fileBox = $(`
            <div class="file-box">

                <div>
                    <strong>
                        ${file.name}
                    </strong>
                </div>

                <div>
                    Compressing
                    (${originalSize} MB)
                </div>

                <div class="progress-container">

                    <div class="
                        progress-bar-custom
                    ">
                        0%
                    </div>

                </div>

                <small class="
                    result-text
                "></small>

            </div>
        `);

        msgBox.append(fileBox);

        let progressBar =
            fileBox.find(
                '.progress-bar-custom'
            );

        let resultText =
            fileBox.find(
                '.result-text'
            );

        // TIFF BLOCK
        if (
            extension == 'tif' ||
            extension == 'tiff'
        ) {

            progressBar.css({
                width: '100%',
                background: 'red'
            });

            progressBar.text(
                'ERROR'
            );

            resultText.html(`
                <span style="
                    color:red;
                ">
                    TIFF not supported
                </span>
            `);

            continue;
        }

        try {

            let finalFile = file;

            // COMPRESS ONLY >1MB
            if (
                file.size >
                1024 * 1024
            ) {

                finalFile =
                    await compressImage(
                        file,
                        progressBar
                    );
            }

            else {

                progressBar.css(
                    'width',
                    '100%'
                );

                progressBar.text(
                    '100%'
                );
            }

            finalFiles.push(
                finalFile
            );

            let compressedSize = (
                finalFile.size /
                1024 /
                1024
            ).toFixed(2);

            resultText.html(`
                <span style="
                    color:green;
                ">
                    Original:
                    ${originalSize} MB
                    |
                    Compressed:
                    ${compressedSize} MB
                </span>
            `);

        } catch (e) {

            console.log(e);

            progressBar.css({
                width: '100%',
                background: 'red'
            });

            progressBar.text(
                'FAILED'
            );

            resultText.html(`
                <span style="
                    color:red;
                ">
                    Compression failed
                </span>
            `);
        }

    }

    // UPDATE INPUT FILES
    let dataTransfer =
        new DataTransfer();

    finalFiles.forEach(file => {

        dataTransfer.items.add(
            file
        );

    });

    input.files =
        dataTransfer.files;

});









// IMAGE COMPRESS FUNCTION
async function compressImage(
    file,
    progressBar
) {

    return new Promise((resolve, reject) => {

        let reader =
            new FileReader();

        reader.readAsDataURL(
            file
        );

        reader.onload =
            function (e) {

            let img =
                new Image();

            img.src =
                e.target.result;

            img.onload =
                async function () {

                let canvas =
                    document.createElement(
                        'canvas'
                    );

                let ctx =
                    canvas.getContext(
                        '2d'
                    );

                let width =
                    img.width;

                let height =
                    img.height;

                let maxWidth =
                    1600;

                // RESIZE
                if (
                    width >
                    maxWidth
                ) {

                    height =
                        height *
                        (
                            maxWidth /
                            width
                        );

                    width =
                        maxWidth;
                }

                canvas.width =
                    width;

                canvas.height =
                    height;

                // WHITE BG
                ctx.fillStyle =
                    "#fff";

                ctx.fillRect(
                    0,
                    0,
                    width,
                    height
                );

                ctx.drawImage(
                    img,
                    0,
                    0,
                    width,
                    height
                );

                let quality =
                    0.9;

                let progress =
                    0;

                async function generateBlob() {

                    return new Promise(
                        (res) => {

                        canvas.toBlob(
                            function (
                                blob
                            ) {

                                res(
                                    blob
                                );

                            },
                            'image/jpeg',
                            quality
                        );

                    });

                }

                let blob =
                    await generateBlob();

                while (
                    blob.size >
                        1024 *
                            1024 &&
                    quality >
                        0.1
                ) {

                    quality -=
                        0.1;

                    progress +=
                        10;

                    progressBar.css(
                        'width',
                        progress +
                            '%'
                    );

                    progressBar.text(
                        progress +
                            '%'
                    );

                    blob =
                        await generateBlob();
                }

                progressBar.css(
                    'width',
                    '100%'
                );

                progressBar.text(
                    '100%'
                );

                let compressedFile =
                    new File(
                        [blob],
                        file.name.replace(
                            /\.[^/.]+$/,
                            ".jpg"
                        ),
                        {
                            type:
                                'image/jpeg',

                            lastModified:
                                Date.now()
                        }
                    );

                resolve(
                    compressedFile
                );

            };

            img.onerror =
                function () {

                reject(
                    'Invalid image'
                );
            };

        };

        reader.onerror =
            function () {

            reject(
                'File read failed'
            );
        };

    });

}



// VIDEO UPLOAD
$(document).on('change', '.video-upload', async function () {

    let input = this;

    let file = input.files[0];

    if (!file) return;

    let msgBox = $(input)
        .closest('.col-sm-3')
        .find('.compress-msg');

    let originalSize = (
        file.size / 1024 / 1024
    ).toFixed(2);

    // SHOW PROGRESS BAR
    msgBox.html(`
        <div>
            Compressing Video (${originalSize} MB)
        </div>

        <div class="progress-container">
            <div class="progress-bar-custom">0%</div>
        </div>
    `);

    let progressBar = msgBox.find(
        '.progress-bar-custom'
    );

    try {

        let compressedBlob = await compressVideo(
            file,
            progressBar
        );

        let compressedFile = new File(
            [compressedBlob],
            file.name.replace(
                /\.[^/.]+$/,
                ".webm"
            ),
            {
                type: 'video/webm',
                lastModified: Date.now()
            }
        );

        let dataTransfer = new DataTransfer();

        dataTransfer.items.add(compressedFile);

        input.files = dataTransfer.files;

        let compressedSize = (
            compressedFile.size / 1024 / 1024
        ).toFixed(2);

        progressBar.css('width', '100%');

        progressBar.text('100%');

        setTimeout(function () {

            msgBox.html(`
                <span style="color:green;">
                    Original: ${originalSize} MB |
                    Compressed: ${compressedSize} MB
                </span>
            `);

        }, 500);

    } catch (e) {

        console.log(e);

        msgBox.html(`
            <span style="color:red;">
                Video compression failed
            </span>
        `);
    }

});





// VIDEO COMPRESS FUNCTION
async function compressVideo(
    file,
    progressBar
) {

    return new Promise((resolve, reject) => {

        if (
            typeof MediaRecorder ===
            'undefined'
        ) {

            reject(
                'MediaRecorder not supported'
            );

            return;
        }

        let video =
            document.createElement(
                'video'
            );

        video.preload = 'metadata';

        video.muted = true;

        video.src =
            URL.createObjectURL(file);

        video.onloadedmetadata =
            function () {

            let canvas =
                document.createElement(
                    'canvas'
                );

            let ctx =
                canvas.getContext('2d');

            let width =
                video.videoWidth;

            let height =
                video.videoHeight;

            // REDUCE SIZE
            let maxWidth = 854;

            if (width > maxWidth) {

                height = height * (
                    maxWidth / width
                );

                width = maxWidth;
            }

            canvas.width = width;

            canvas.height = height;

            // LOWER FPS
            let stream =
                canvas.captureStream(15);

            // LOWER BITRATE
            let recorder =
                new MediaRecorder(
                    stream,
                    {
                        mimeType:
                            'video/webm;codecs=vp8',

                        videoBitsPerSecond:
                            250000
                    }
                );

            let chunks = [];

            let duration =
                video.duration;

            recorder.ondataavailable =
                function (e) {

                if (
                    e.data.size > 0
                ) {

                    chunks.push(e.data);
                }
            };

            recorder.onstop =
                function () {

                let blob =
                    new Blob(
                        chunks,
                        {
                            type:
                                'video/webm'
                        }
                    );

                resolve(blob);
            };

            recorder.start();

            video.play();

            function drawFrame() {

                if (
                    video.paused ||
                    video.ended
                ) {

                    recorder.stop();

                    return;
                }

                ctx.drawImage(
                    video,
                    0,
                    0,
                    width,
                    height
                );

                // PROGRESS %
                let progress =
                    Math.min(
                        99,
                        parseInt(
                            (
                                video.currentTime /
                                duration
                            ) * 100
                        )
                    );

                progressBar.css(
                    'width',
                    progress + '%'
                );

                progressBar.text(
                    progress + '%'
                );

                requestAnimationFrame(
                    drawFrame
                );
            }

            drawFrame();

        };

        video.onerror = function () {

            reject(
                'Video load failed'
            );
        };

    });

}

</script>
<style>

.progress-box{
    width:100%;
    height:22px;
    background:#e9ecef;
    border-radius:30px;
    overflow:hidden;
    margin-top:8px;
}

.progress-bar{
    width:0%;
    height:100%;
    background:#28a745;
    color:#fff;
    text-align:center;
    line-height:22px;
    font-size:12px;
    transition:0.3s;
}

</style>


<script>

$(document).on('change', '.media-upload', async function () {

    let input = this;

    let file = input.files[0];

    if (!file) return;

    let msgBox = $(input)
        .parent()
        .find('.compress-msg');

    let originalSize = (
        file.size / 1024 / 1024
    ).toFixed(2);

    // SHOW LOADER
    msgBox.html(`
        <div>
            Compressing File (${originalSize} MB)
        </div>

        <div class="progress-box">
            <div class="progress-bar">0%</div>
        </div>
    `);

    let progressBar = msgBox.find('.progress-bar');

    try {

        let finalFile = file;

        // IMAGE
        if (file.type.startsWith('image/')) {

            let extension = file.name
                .split('.')
                .pop()
                .toLowerCase();

            // TIFF NOT SUPPORTED
            if (
                extension == 'tif' ||
                extension == 'tiff'
            ) {

                msgBox.html(`
                    <span style="color:red;">
                        TIFF format not supported
                    </span>
                `);

                return;
            }

            // COMPRESS ONLY ABOVE 1MB
            if (file.size > 1024 * 1024) {

                finalFile = await compressImage1(
                    file,
                    progressBar
                );
            }
        }

        // VIDEO
        else if (file.type.startsWith('video/')) {

            // COMPRESS ONLY ABOVE 5MB
            if (file.size > 5 * 1024 * 1024) {

                finalFile = await compressVideo1(
                    file,
                    progressBar
                );
            }
        }

        // UPDATE INPUT FILE
        let dataTransfer = new DataTransfer();

        dataTransfer.items.add(finalFile);

        input.files = dataTransfer.files;

        let compressedSize = (
            finalFile.size / 1024 / 1024
        ).toFixed(2);

        progressBar.css('width', '100%');
        progressBar.text('100%');

        setTimeout(function () {

            msgBox.html(`
                <span style="color:green;">
                    Original: ${originalSize} MB |
                    Compressed: ${compressedSize} MB
                </span>
            `);

        }, 500);

    } catch (e) {

        console.log(e);

        msgBox.html(`
            <span style="color:red;">
                Compression failed
            </span>
        `);
    }

});






// IMAGE COMPRESS
async function compressImage1(file, progressBar) {

    return new Promise((resolve, reject) => {

        let reader = new FileReader();

        reader.readAsDataURL(file);

        reader.onload = function (e) {

            let img = new Image();

            img.src = e.target.result;

            img.onload = async function () {

                let canvas = document.createElement('canvas');

                let ctx = canvas.getContext('2d');

                let width = img.width;

                let height = img.height;

                let maxWidth = 1600;

                // RESIZE
                if (width > maxWidth) {

                    height = height * (
                        maxWidth / width
                    );

                    width = maxWidth;
                }

                canvas.width = width;

                canvas.height = height;

                ctx.fillStyle = "#ffffff";

                ctx.fillRect(
                    0,
                    0,
                    width,
                    height
                );

                ctx.drawImage(
                    img,
                    0,
                    0,
                    width,
                    height
                );

                let quality = 0.9;

                let progress = 0;

                async function generateBlob() {

                    return new Promise((res) => {

                        canvas.toBlob(function (blob) {

                            res(blob);

                        }, 'image/jpeg', quality);

                    });

                }

                let blob = await generateBlob();

                while (
                    blob.size > 1024 * 1024 &&
                    quality > 0.1
                ) {

                    quality -= 0.1;

                    progress += 10;

                    progressBar.css(
                        'width',
                        progress + '%'
                    );

                    progressBar.text(
                        progress + '%'
                    );

                    blob = await generateBlob();
                }

                progressBar.css(
                    'width',
                    '100%'
                );

                progressBar.text('100%');

                let compressedFile = new File(
                    [blob],
                    file.name.replace(
                        /\.[^/.]+$/,
                        ".jpg"
                    ),
                    {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    }
                );

                resolve(compressedFile);

            };

            img.onerror = function () {

                reject('Image load failed');
            };

        };

        reader.onerror = function () {

            reject('File read failed');
        };

    });

}






// VIDEO COMPRESS
async function compressVideo1(file, progressBar) {

return new Promise((resolve, reject) => {

    if (typeof MediaRecorder === 'undefined') {

        reject('MediaRecorder not supported');

        return;
    }

    let video = document.createElement('video');

    video.preload = 'metadata';

    video.muted = true;

    video.src = URL.createObjectURL(file);

    video.onloadedmetadata = function () {

        let canvas = document.createElement('canvas');

        let ctx = canvas.getContext('2d');

        let width = video.videoWidth;

        let height = video.videoHeight;

        // REDUCE RESOLUTION
        let maxWidth = 854;

        if (width > maxWidth) {

            height = height * (
                maxWidth / width
            );

            width = maxWidth;
        }

        canvas.width = width;

        canvas.height = height;

        // LOWER FPS
        let stream = canvas.captureStream(15);

        // LOWER BITRATE
        let recorder = new MediaRecorder(
            stream,
            {
                mimeType: 'video/webm;codecs=vp8',
                videoBitsPerSecond: 250000
            }
        );

        let chunks = [];

        let duration = video.duration;

        recorder.ondataavailable = function (e) {

            if (e.data.size > 0) {

                chunks.push(e.data);
            }
        };

        recorder.onstop = function () {

            let blob = new Blob(
                chunks,
                {
                    type: 'video/webm'
                }
            );

            let compressedFile = new File(
                [blob],
                file.name.replace(
                    /\.[^/.]+$/,
                    ".webm"
                ),
                {
                    type: 'video/webm',
                    lastModified: Date.now()
                }
            );

            resolve(compressedFile);
        };

        recorder.start();

        video.play();

        function drawFrame() {

            if (
                video.paused ||
                video.ended
            ) {

                recorder.stop();

                return;
            }

            ctx.drawImage(
                video,
                0,
                0,
                width,
                height
            );

            // PROGRESS %
            let progress = Math.min(
                99,
                parseInt(
                    (
                        video.currentTime /
                        duration
                    ) * 100
                )
            );

            progressBar.css(
                'width',
                progress + '%'
            );

            progressBar.text(
                progress + '%'
            );

            requestAnimationFrame(
                drawFrame
            );
        }

        drawFrame();

    };

    video.onerror = function () {

        reject('Video load failed');
    };

});

}

</script>