from PIL import Image, ImageFilter

img_path = r'C:\Users\zenhk\.gemini\antigravity\brain\3dfdfe29-5a25-4764-96cb-60e4ee423129\media__1781273273180.png'
img = Image.open(img_path)
width, height = img.size

# Let's just do a rough crop based on grid structure in the screenshot.
# Card 1 is top left
card1_img = img.crop((40, 100, width//2 - 20, height//2 - 40))
card1_img.save('img/pad_shopee_1_orig.png')

# Card 3 is bottom left
card3_img = img.crop((40, height//2 + 40, width//2 - 20, height - 100))
card3_img.save('img/pad_tokopedia_orig.png')

print("Cropped using PIL")
