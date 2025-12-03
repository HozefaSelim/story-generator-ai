<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin: 40px;
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
        }
        
        /* Cover Page */
        .cover-page {
            page-break-after: always;
            text-align: center;
            padding-top: 200px;
        }
        .cover-decoration {
            font-size: 50px;
            margin-bottom: 40px;
        }
        .cover-title {
            font-size: 36px;
            font-weight: bold;
            color: #000;
            margin-bottom: 30px;
            line-height: 1.3;
        }
        .cover-theme {
            font-size: 18px;
            color: #444;
            margin-bottom: 10px;
        }
        .cover-style {
            font-size: 16px;
            color: #666;
            margin-bottom: 40px;
        }
        .cover-starring {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            font-style: italic;
        }
        .cover-author {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }
        .cover-date {
            font-size: 12px;
            color: #777;
            margin-top: 50px;
        }
        
        /* Story Content Page */
        .content-page {
            page-break-after: always;
        }
        .content-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #667eea;
        }
        .story-text {
            font-size: 12px;
            line-height: 1.8;
            text-align: justify;
            color: #333;
        }
        .story-text p {
            margin-bottom: 15px;
            text-indent: 25px;
        }
        
        /* Image Pages */
        .image-page {
            page-break-after: always;
            text-align: center;
            padding-top: 20px;
        }
        .scene-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .scene-image {
            max-width: 100%;
            max-height: 450px;
            border: 3px solid #667eea;
            border-radius: 8px;
        }
        .scene-caption {
            font-size: 11px;
            color: #666;
            font-style: italic;
            margin-top: 15px;
            padding: 0 30px;
        }
        
        /* End Page */
        .end-page {
            text-align: center;
            padding-top: 200px;
        }
        .end-title {
            font-size: 40px;
            font-weight: bold;
            color: #000;
            margin-bottom: 30px;
        }
        .end-message {
            font-size: 16px;
            color: #444;
            margin-bottom: 15px;
        }
        .end-lesson {
            font-size: 14px;
            color: #555;
            font-style: italic;
            margin-top: 40px;
            padding: 0 50px;
        }
        .end-decoration {
            font-size: 40px;
            margin-top: 40px;
        }
        .end-footer {
            font-size: 11px;
            color: #888;
            margin-top: 60px;
        }
        
        /* Page Footer */
        .page-footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Cover Page -->
    <div class="cover-page">
        <div class="cover-decoration">📚 ✨ 📚</div>
        <div class="cover-title">{{ $title }}</div>
        @if($story->theme)
            <div class="cover-theme">A {{ ucfirst($story->theme) }} Story</div>
            <div class="cover-style">{{ ucfirst($story->style) }} Style</div>
        @endif
        @if(isset($story->settings['child_name']) && $story->settings['child_name'])
            <div class="cover-starring">Starring: {{ $story->settings['child_name'] }}</div>
        @endif
        <div class="cover-author">Created by {{ $author }}</div>
        <div class="cover-date">{{ $generatedDate }}</div>
    </div>

    <!-- Story Content -->
    <div class="content-page">
        <div class="content-title">📖 The Story</div>
        <div class="story-text">
            @foreach(explode("\n\n", $content) as $paragraph)
                @if(trim($paragraph))
                    <p>{{ trim($paragraph) }}</p>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Images -->
    @if(count($images) > 0)
        @foreach($images as $index => $image)
            <div class="image-page">
                <div class="scene-title">🎨 Scene {{ $index + 1 }}</div>
                <img class="scene-image" src="{{ $image['src'] }}" alt="Scene {{ $index + 1 }}">
                @if(!empty($image['description']))
                    <div class="scene-caption">"{{ $image['description'] }}"</div>
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
            <div class="end-lesson">"{{ $story->settings['lesson'] }}"</div>
        @endif
        <div class="end-decoration">🌟 📚 🌟</div>
        <div class="end-footer">
            Generated by AI Story Generator<br>
            {{ $generatedDate }}
        </div>
    </div>

    <!-- Footer -->
    <div class="page-footer">
        AI Story Generator • {{ $generatedDate }}
    </div>
</body>
</html>
