# AI-Powered Story Generator for Children

An innovative Laravel-based web application that generates personalized, multimedia stories for children using artificial intelligence. This application creates engaging, educational content combining AI-generated text, images, voice narration, and video, with the option to print as a high-quality magazine.

## 🌟 Features

- **AI-Generated Stories**: Create unique, personalized stories using OpenAI's GPT models
- **Custom Illustrations**: Generate images for each scene using DALL-E 3
- **Voice Narration**: Convert stories to speech with natural-sounding voices
- **Video Compilation**: Combine images and narration into engaging videos
- **PDF Magazine Export**: Print stories as beautiful, gift-quality magazines
- **Photo Integration**: Upload child's photo to make them the story protagonist
- **Multiple Themes & Styles**: Choose from various story themes and visual styles
- **User Roles**: Support for parents, teachers, and administrators
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## 📋 Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Features in Detail](#features-in-detail)
- [API Services](#api-services)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## 🔧 Requirements

- **PHP**: >= 8.2
- **Composer**: Latest version
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **FFmpeg**: Required for video compilation (optional feature)
- **OpenAI API Key**: Required for story and image generation
- **Storage**: At least 10GB free space for generated content

### Optional Requirements
- Redis (for queue management)
- Supervisor (for running queue workers in production)

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd story-generator-ai
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file with your configuration:

```env
APP_NAME="AI Story Generator"
APP_URL=http://localhost

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=story_generator
DB_USERNAME=your_username
DB_PASSWORD=your_password

# OpenAI Configuration (REQUIRED)
OPENAI_API_KEY=your_openai_api_key_here
OPENAI_ORGANIZATION=your_organization_id_here

# Queue Configuration (Recommended: redis for production)
QUEUE_CONNECTION=database

# Mail Configuration (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@storygenerator.com"
MAIL_FROM_NAME="${APP_NAME}"

# File Storage
FILESYSTEM_DISK=public
```

### 5. Database Setup

```bash
# Create database
php artisan migrate

# (Optional) Seed with sample data
php artisan db:seed
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

### 7. Build Frontend Assets

```bash
npm run build

# Or for development
npm run dev
```

### 8. Set Up Queue Worker (Important for Story Generation)

```bash
# Development - run in separate terminal
php artisan queue:work

# Production - use Supervisor (see Production Setup below)
```

### 9. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## ⚙️ Configuration

### OpenAI API Setup

1. Get your API key from [OpenAI Platform](https://platform.openai.com/)
2. Add to `.env`:
   ```env
   OPENAI_API_KEY=sk-...your-key-here
   ```
3. Ensure you have sufficient credits for:
   - GPT-4 (text generation)
   - DALL-E 3 (image generation)
   - TTS (text-to-speech)

### FFmpeg Installation (Optional for Video Features)

#### Windows
```bash
# Using Chocolatey
choco install ffmpeg

# Or download from https://ffmpeg.org/download.html
```

#### Linux (Ubuntu/Debian)
```bash
sudo apt update
sudo apt install ffmpeg
```

#### macOS
```bash
brew install ffmpeg
```

### File Storage Configuration

Create necessary directories:
```bash
mkdir -p storage/app/public/story-images
mkdir -p storage/app/public/story-audio
mkdir -p storage/app/public/story-videos
mkdir -p storage/app/public/story-pdfs
mkdir -p storage/app/public/uploads/photos
```

Set proper permissions:
```bash
# Linux/macOS
chmod -R 775 storage bootstrap/cache

# Ensure web server user has write access
sudo chown -R www-data:www-data storage bootstrap/cache
```

## 📖 Usage

### Creating Your First Story

1. **Register/Login**: Create an account or log in
2. **Navigate to Create Story**: Click "Create New Story"
3. **Fill in Details**:
   - Story Title
   - Choose Theme (Adventure, Fantasy, etc.)
   - Select Visual Style
   - Add Child's Name (optional)
   - Specify Age Range
   - Select Voice for Narration
   - Number of Images (1-10)
4. **Upload Photo** (Optional): Upload child's photo to integrate into story
5. **Generate**: Click "Generate Story"
6. **Wait**: Story generation takes 2-5 minutes
7. **View & Download**: View your story, download PDF or video

### Managing Stories

- **View All Stories**: Dashboard shows all your created stories
- **Edit Story**: Modify story settings
- **Download Options**:
  - PDF Magazine (printable)
  - Video File (MP4)
  - Audio File (MP3)
- **Share**: Share story link with others
- **Delete**: Remove unwanted stories

### User Roles

#### Parent Role
- Create unlimited stories
- Upload child photos
- Download and print stories
- Manage own stories

#### Teacher Role
- Same as Parent role
- Can create stories for classroom use
- Track story usage statistics

#### Admin Role
- All permissions
- Manage all users
- View system statistics
- Moderate content

## 🎨 Features in Detail

### Story Generation Process

1. **Text Generation**: Uses GPT-4 to create engaging, age-appropriate narratives
2. **Scene Description**: AI analyzes story and creates scene descriptions
3. **Image Generation**: DALL-E 3 generates custom illustrations
4. **Voice Synthesis**: OpenAI TTS converts text to natural speech
5. **Video Compilation**: FFmpeg combines images and audio
6. **PDF Creation**: DomPDF generates printable magazine

### Available Themes

- Adventure
- Fantasy
- Science & Learning
- Friendship
- Animals
- Space Exploration
- Nature
- Magic & Wizards
- Pirates
- Dinosaurs
- Underwater World
- Fairy Tale

### Visual Styles

- Colorful & Vibrant
- Cartoon Style
- Watercolor Art
- Digital Art
- Classic Storybook
- Comic Book
- 3D Rendered
- Minimalist

### Voice Options

- **Alloy**: Neutral tone
- **Echo**: Warm voice
- **Fable**: British accent
- **Onyx**: Deep voice
- **Nova**: Youthful (recommended for children)
- **Shimmer**: Bright and cheerful

## 🔌 API Services

### Story Generation Service
```php
use App\Services\StoryGenerationService;

$service = app(StoryGenerationService::class);
$story = $service->generateStory($theme, $style, $params);
```

### Image Generation Service
```php
use App\Services\ImageGenerationService;

$service = app(ImageGenerationService::class);
$imagePath = $service->generateImage($description, $style);
```

### Text-to-Speech Service
```php
use App\Services\TextToSpeechService;

$service = app(TextToSpeechService::class);
$audioPath = $service->convertTextToSpeech($text, $voice);
```

## 🐛 Troubleshooting

### Common Issues

#### 1. "OpenAI API Error"
- Verify API key in `.env`
- Check OpenAI account credits
- Ensure API key has proper permissions

#### 2. "Image Generation Failed"
- Check OpenAI DALL-E 3 access
- Verify sufficient API credits
- Check image size limits

#### 3. "Video Compilation Error"
- Ensure FFmpeg is installed: `ffmpeg -version`
- Check file permissions in storage directory
- Verify sufficient disk space

#### 4. "Queue Jobs Not Processing"
- Start queue worker: `php artisan queue:work`
- Check queue connection in `.env`
- Verify database queue table exists

#### 5. "Storage Link Error"
- Run: `php artisan storage:link`
- Check `public/storage` symlink exists
- Verify file permissions

### Logging

Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Clear Cache

If experiencing issues:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 🚀 Production Setup

### 1. Optimize Application

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### 2. Set Up Supervisor for Queue

Create `/etc/supervisor/conf.d/story-generator-worker.conf`:

```ini
[program:story-generator-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/your/app/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=4
redirect_stderr=true
stdout_logfile=/path/to/your/app/storage/logs/worker.log
stopwaitsecs=3600
```

Reload Supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start story-generator-worker:*
```

### 3. Set Up Cron for Scheduled Tasks

Add to crontab:
```bash
* * * * * cd /path/to/your/app && php artisan schedule:run >> /dev/null 2>&1
```

### 4. Secure Environment

- Set `APP_DEBUG=false`
- Set `APP_ENV=production`
- Use HTTPS
- Implement rate limiting
- Regular backups

## 📊 Cost Estimation

### OpenAI API Costs (Approximate)

Per Story Generation:
- **GPT-4**: ~$0.10 - $0.30 (depending on story length)
- **DALL-E 3**: ~$0.04 - $0.16 (per image, 1-10 images)
- **TTS**: ~$0.015 per 1000 characters

**Average Cost per Story**: $0.20 - $0.60

Monthly costs depend on usage volume. Budget accordingly!

## 📝 License

This project is licensed under the MIT License.

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📧 Support

For support, please contact: support@storygenerator.com

## 🙏 Acknowledgments

- OpenAI for GPT-4, DALL-E 3, and TTS APIs
- Laravel Framework
- All open-source contributors

---

**Built with ❤️ for children's education and creativity**
