import urllib.request
import re
import urllib.parse

urls = [
    'https://shopee.co.id/opaanlp/27747833/50255407752?__mobile__=1',
    'https://shop-id.tokopedia.com/view/product/1734204666931218109'
]

for url in urls:
    try:
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'})
        html = urllib.request.urlopen(req).read().decode('utf-8')
        images = re.findall(r'<meta property="og:image" content="([^"]+)"', html)
        if not images:
            images = re.findall(r'<meta name="twitter:image" content="([^"]+)"', html)
        print(url, "->", images[0] if images else "No image found")
    except Exception as e:
        print(url, "-> Error:", e)
