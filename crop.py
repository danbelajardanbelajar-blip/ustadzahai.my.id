import cv2
import numpy as np

# Load the image
img_path = r'C:\Users\zenhk\.gemini\antigravity\brain\3dfdfe29-5a25-4764-96cb-60e4ee423129\media__1781273273180.png'
img = cv2.imread(img_path)

# Convert to grayscale
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

# Threshold to find white cards (assuming background is light but cards are white)
_, thresh = cv2.threshold(gray, 240, 255, cv2.THRESH_BINARY)

# Find contours
contours, _ = cv2.findContours(thresh, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

cards = []
for cnt in contours:
    x, y, w, h = cv2.boundingRect(cnt)
    if w > 100 and h > 100: # Filter small noisy contours
        cards.append((x, y, w, h))

# Sort cards by y, then x
cards.sort(key=lambda b: (b[1]//100, b[0]))

print(f"Found {len(cards)} cards:")
for i, (x, y, w, h) in enumerate(cards):
    print(f"Card {i+1}: x={x}, y={y}, w={w}, h={h}")
    # Extract the image part (assuming the image is at the top of the card)
    # The image usually takes up the top 60-70% of the card
    # Let's just save the card itself first to inspect
    card_img = img[y:y+h, x:x+w]
    cv2.imwrite(f'img/extracted_card_{i+1}.png', card_img)
    
    # Also try to crop just the image part. Looking at the screenshot, 
    # there is a border. The image starts slightly below the top border.
    product_img = img[y+5:y+int(h*0.7), x+5:x+w-5]
    cv2.imwrite(f'img/extracted_product_{i+1}.png', product_img)

print("Extraction complete.")
