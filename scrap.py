from bs4 import BeautifulSoup
import yaml
from functools import cmp_to_key
import codecs

path = 'index.html'
data = []

with open(path) as f:
    html = f.read()
    soup = BeautifulSoup(html)

    for div in soup.select(".mix"):
        info_video = div.select('.infoVideo')[0]

        data.append({
            'id': div.select('a')[0].attrs['href'].split('/')[1],
            'title': div.select('.videoTitle')[0].text,
            'description': info_video.attrs['data-description'],
            'youtube': info_video.attrs['data-youtube'],
            'tags': (div.attrs['class'][3:]),
        })

data = sorted(data, key=cmp_to_key(lambda a, b: int(a['id']) - int(b['id'])), reverse = True)

with open('_data/videos.yml', 'w') as outfile:
    yaml.dump(data, outfile, default_flow_style=False, indent=4, width=100000)
