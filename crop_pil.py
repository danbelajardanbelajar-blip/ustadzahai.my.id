from PIL import Image

img_path = r'C:\Users\zenhk\.gemini\antigravity\brain\3dfdfe29-5a25-4764-96cb-60e4ee423129\media__1781272055054.png'
try:
    img = Image.open(img_path)
    width, height = img.size
    print(f"Image size: {width}x{height}")
    
    # The grid is 2 columns. 
    # Left card (4 picis) is roughly in the top-left quadrant
    # Right card (Menstrual pad) is in the top-right quadrant
    
    # We will just save rough crops of the two products.
    # Since it's a screenshot, there might be margins. Let's do a loose crop.
    c_w = width // 2
    c_h = height // 2
    
    # We want to crop out just the inner image, but cropping the top 70% of the card is safe
    img1 = img.crop((0, 0, c_w, c_h))
    img2 = img.crop((c_w, 0, width, c_h))
    
    img1.save('img/pad_shopee_1_orig.png')
    img2.save('img/pad_shopee_2_orig.png')
    print("Saved cropped images.")
except Exception as e:
    print(f"Error: {e}")
