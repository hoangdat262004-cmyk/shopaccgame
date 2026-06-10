import os
from PIL import Image

brain_dir = r"C:\Users\thanh\.gemini\antigravity\brain\2d8f076f-a74c-4fee-83c8-7bba1fb1bb11"
dest_dir = r"d:\XAmpp\htdocs\shopaccgame\public\uploads"
os.makedirs(dest_dir, exist_ok=True)

# Let's search all png files in the brain directory
files = [f for f in os.listdir(brain_dir) if f.endswith('.png')]
print(f"Found files: {files}")

for filename in files:
    filepath = os.path.join(brain_dir, filename)
    try:
        with Image.open(filepath) as img:
            w, h = img.size
            print(f"File {filename}: dimensions {w}x{h}")
            
            # The news thumbnail is in one of the images.
            # Image 2 has a news list with a search bar and a sidebar.
            # Let's see if we can find the one with height around 150-250 and width around 800-1000, 
            # or width around 1000 and height around 200, which matches the news list mockup.
            # Let's crop the actual thumbnail from it.
            # In the news image, the thumbnail is at the left side of the news card.
            # Let's crop it based on coordinates if we can identify it.
            # The news mockup is about 1000x200 or similar.
            # Let's detect if it contains the thumbnail.
            # If width is large and height is moderate, e.g. 1000x200, the thumbnail is around x=135 to x=285 (approx), y=75 to y=175.
            # Let's check dimensions of files first to be precise.
    except Exception as e:
        print(f"Error opening {filename}: {e}")
