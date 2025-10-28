# Images Directory

This directory contains images for various parts of the application.

## 1. Home Page - Kid Background Image

Place your AI-generated kid image here with the filename: **`kid-background.png`** or **`kid-background.jpg`**

### Image Requirements:
- **Filename**: `kid-background.png` (currently used) or `kid-background.jpg`
- **Recommended Size**: 1920x1080 pixels or higher
- **Format**: PNG (preferred for transparency) or JPG/JPEG
- **Subject**: A kid with glasses (matching the reference design)
- **Positioning**: The image will be positioned to the right side of the card
- **Style**: Should work well with a dark overlay (the image will have a dark gradient overlay)

### AI Image Generation Prompts:
You can use these prompts with your AI image generator:

**Option 1:**
```
A cute kid with round glasses, warm lighting, cozy bedroom background, 
storybook illustration style, magical atmosphere, soft focus, 
professional portrait photography
```

**Option 2:**
```
Young child with large round glasses reading a book, warm golden lighting, 
dreamy atmosphere, children's book illustration style, 
high quality, cinematic lighting
```

**Option 3:**
```
Portrait of a happy kid with glasses in a cozy room filled with books and toys, 
magical glowing lights in background, warm colors, 
storybook character style, professional photography
```

### After Generating:
1. Save your AI-generated image as `kid-background.png` (or `.jpg`)
2. Place it in this directory (`public/images/`)
3. Refresh your home page to see the image

### Current Setup:
The image is referenced in the home page as:
```
background: url('/images/kid-background.png')
```

**Image Positioning**: The image is positioned at `70% center` which places the character more to the right side, leaving space for text on the left.

If you want to use a different filename or adjust positioning, you can update it in:
`resources/views/home.blade.php` (line 10)

---

## 2. Auth Carousel Images (Login & Register Pages)

The login and register pages have image carousels on the left side. You need to generate **6 images total**:

### Login Page Images:
- **`login-slide-1.jpg`** - Create Magical Stories (with books theme)
- **`login-slide-2.jpg`** - Beautiful Illustrations (with art theme)
- **`login-slide-3.jpg`** - Voice Narration (with audio/music theme)

### Register Page Images:
- **`auth-slide-1.jpg`** - Join Our Community (with people/characters theme)
- **`auth-slide-2.jpg`** - Personalized Characters (with costumes/transformation theme)
- **`auth-slide-3.jpg`** - Educational & Fun (with learning/education theme)

### Image Specifications:
- **Size**: 1920x1080 pixels (16:9 landscape)
- **Format**: JPG or PNG
- **Style**: 3D animated Pixar style, colorful and magical
- **Colors**: Purple, blue, cyan, pink gradients

📋 **See `AUTH_CAROUSEL_IMAGES.md` in this directory for detailed AI prompts and specifications!**

### Quick Note:
Until you add custom images, the carousel will display beautiful gradient backgrounds with emoji icons. The app works perfectly without custom images, but adding them makes it even more stunning! ✨

