<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin: 50px 40px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            background: #fff;
            line-height: 1.6;
        }

        /* Cover Page */
        .cover-page {
            page-break-after: always;
            text-align: center;
            padding-top: 150px;
        }

        .cover-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cover-icon-text {
            font-size: 14px;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 3px;
            margin-bottom: 20px;
        }

        .cover-title {
            font-size: 32px;
            font-weight: bold;
            color: #1a1a2e;
            margin-bottom: 25px;
            line-height: 1.3;
            padding: 0 30px;
        }

        .cover-subtitle {
            font-size: 16px;
            color: #667eea;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .cover-style {
            font-size: 14px;
            color: #666;
            margin-bottom: 35px;
        }

        .cover-starring {
            font-size: 15px;
            color: #333;
            margin-bottom: 8px;
            font-style: italic;
        }

        .cover-author {
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
        }

        .cover-date {
            font-size: 12px;
            color: #888;
            margin-top: 60px;
        }

        .cover-line {
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, #667eea, #764ba2);
            margin: 25px auto;
        }

        /* Story Section */
        .story-section {
            page-break-after: always;
            padding: 20px 0;
        }

        .section-header {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a2e;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #667eea;
        }

        .story-intro {
            font-size: 12px;
            line-height: 1.9;
            text-align: justify;
            color: #333;
            padding: 0 10px;
        }

        .story-intro p {
            margin-bottom: 18px;
            text-indent: 30px;
        }

        /* Scene Pages - Image with Text */
        .scene-page {
            page-break-after: always;
            padding: 15px 0;
        }

        .scene-header {
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
            text-align: center;
            margin-bottom: 20px;
        }

        .scene-image-container {
            text-align: center;
            margin-bottom: 25px;
        }

        .scene-image {
            max-width: 100%;
            max-height: 320px;
            border: 4px solid #667eea;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .scene-text {
            background: #f8f9ff;
            border-left: 4px solid #667eea;
            padding: 20px 25px;
            margin: 20px 10px;
            border-radius: 0 8px 8px 0;
        }

        .scene-text p {
            font-size: 12px;
            line-height: 1.8;
            color: #333;
            text-align: justify;
            margin: 0;
        }

        .scene-caption {
            font-size: 11px;
            color: #666;
            font-style: italic;
            text-align: center;
            margin-top: 10px;
            padding: 0 20px;
        }

        /* End Page */
        .end-page {
            text-align: center;
            padding-top: 180px;
        }

        .end-title {
            font-size: 36px;
            font-weight: bold;
            color: #1a1a2e;
            margin-bottom: 25px;
        }

        .end-message {
            font-size: 14px;
            color: #555;
            margin-bottom: 12px;
        }

        .end-lesson-box {
            background: #f8f9ff;
            border: 2px solid #667eea;
            border-radius: 10px;
            padding: 20px 30px;
            margin: 35px 40px;
        }

        .end-lesson-label {
            font-size: 11px;
            color: #667eea;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .end-lesson {
            font-size: 13px;
            color: #333;
            font-style: italic;
            line-height: 1.6;
        }

        .end-decoration {
            margin-top: 40px;
        }

        .end-star {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: #667eea;
            margin: 0 10px;
            transform: rotate(45deg);
        }

        .end-footer {
            font-size: 10px;
            color: #999;
            margin-top: 60px;
        }

        /* Page Footer */
        .page-footer {
            position: fixed;
            bottom: 15px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #bbb;
        }
    </style>
</head>

<body>
    <!-- Cover Page -->
    <div class="cover-page">
        <div class="cover-icon-text">* STORY *</div>
        <div class="cover-line"></div>
        <div class="cover-title">{{ $title }}</div>
        @if($story->theme)
            <div class="cover-subtitle">A {{ ucfirst($story->theme) }} Story</div>
            <div class="cover-style">{{ ucfirst($story->style) }} Style</div>
        @endif
        @if(isset($story->settings['child_name']) && $story->settings['child_name'])
            <div class="cover-starring">Starring: {{ $story->settings['child_name'] }}</div>
        @endif
        <div class="cover-line"></div>
        <div class="cover-author">Created by {{ $author }}</div>
        <div class="cover-date">{{ $generatedDate }}</div>
    </div>

    <!-- Story Introduction (First part of text) -->
    <div class="story-section">
        <div class="section-header">The Story</div>
        <div class="story-intro">
            @php
                $paragraphs = array_filter(explode("\n\n", $content), fn($p) => trim($p));
                $paragraphList = array_values($paragraphs);
                $numImages = count($images);
                $paragraphsPerScene = $numImages > 0 ? ceil(count($paragraphList) / $numImages) : count($paragraphList);
            @endphp

            @if($numImages == 0)
                @foreach($paragraphList as $paragraph)
                    @if(trim($paragraph))
                        <p>{{ trim($paragraph) }}</p>
                    @endif
                @endforeach
            @else
                @foreach(array_slice($paragraphList, 0, $paragraphsPerScene) as $paragraph)
                    @if(trim($paragraph))
                        <p>{{ trim($paragraph) }}</p>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    <!-- Scene Pages: Each image with corresponding text -->
    @if(count($images) > 0)
        @foreach($images as $index => $image)
            <div class="scene-page">
                <div class="scene-header">Scene {{ $index + 1 }}</div>

                <div class="scene-image-container">
                    <img class="scene-image" src="{{ $image['src'] }}" alt="Scene {{ $index + 1 }}">
                </div>

                @if(!empty($image['description']))
                    <div class="scene-caption">"{{ $image['description'] }}"</div>
                @endif

                @php
                    $startIdx = ($index + 1) * $paragraphsPerScene;
                    $sceneParagraphs = array_slice($paragraphList, $startIdx, $paragraphsPerScene);
                @endphp

                @if(count($sceneParagraphs) > 0)
                    <div class="scene-text">
                        @foreach($sceneParagraphs as $paragraph)
                            @if(trim($paragraph))
                                <p>{{ trim($paragraph) }}</p>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    @endif

    <!-- End Page -->
    <div class="end-page">
        <div class="end-title">The End</div>
        <div class="end-message">Thank you for reading!</div>
        <div class="end-message">This magical story was created especially for you.</div>

        @if(isset($story->settings['lesson']) && $story->settings['lesson'])
            <div class="end-lesson-box">
                <div class="end-lesson-label">LESSON LEARNED</div>
                <div class="end-lesson">"{{ $story->settings['lesson'] }}"</div>
            </div>
        @endif

        <div class="end-decoration">
            <span class="end-star"></span>
            <span class="end-star"></span>
            <span class="end-star"></span>
        </div>

        <div class="end-footer">
            Generated by AI Story Generator<br>
            {{ $generatedDate }}
        </div>
    </div>

    <!-- Footer -->
    <div class="page-footer">
        AI Story Generator | {{ $generatedDate }}
    </div>
</body>

</html>