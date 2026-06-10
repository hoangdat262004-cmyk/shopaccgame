import os
from PIL import Image

brain_dir = r"C:\Users\thanh\.gemini\antigravity\brain\2d8f076f-a74c-4fee-83c8-7bba1fb1bb11"
dest_path = r"d:\XAmpp\htdocs\shopaccgame\public\uploads\news_shopmcuong.png"

# We know media__1779332842870.png or media__1779333074361.png is the 1024x208 mockup image.
src_image = os.path.join(brain_dir, "media__1779332842870.png")
if not os.path.exists(src_image):
    src_image = os.path.join(brain_dir, "media__1779333074361.png")

print(f"Using source image: {src_image}")

try:
    img = Image.open(src_image).convert("RGB")
    w, h = img.size
    
    # Scanning y from 70 to 200, x from 100 to 400
    # Let's find pixels that are NOT light-gray/white background (r,g,b > 240)
    # and NOT black/dark text (r,g,b < 50)
    # These represent the colorful thumbnail.
    min_x, max_x = w, 0
    min_y, max_y = h, 0
    
    for y in range(70, h):
        for x in range(100, 400):
            r, g, b = img.getpixel((x, y))
            # Check if pixel has a highly saturated/colorful game graphic
            is_background = r > 240 and g > 240 and b > 240
            is_text = r < 50 and g < 50 and b < 50
            if not is_background and not is_text:
                if x < min_x: min_x = x
                if x > max_x: max_x = x
                if y < min_y: min_y = y
                if y > max_y: max_y = y
                
    print(f"Detected bounding box: X: {min_x} to {max_x}, Y: {min_y} to {max_y}")
    
    # Check if detection is reasonable, else use hardcoded fallback
    if max_x - min_x < 50 or max_y - min_y < 50:
        print("Detection failed, using fallback coordinates")
        min_x, min_y, max_x, max_y = 138, 80, 288, 180
        
    # Crop and save
    cropped = img.crop((min_x, min_y, max_x + 1, max_y + 1))
    cropped.save(dest_path)
    print(f"Successfully saved cropped news thumbnail to: {dest_path}")
    
except Exception as e:
    print(f"Error: {e}")
