from bs4 import BeautifulSoup
import yaml
from functools import cmp_to_key
import codecs
import glob
import shutil

path = 'index.html'
data = []

with open(path) as f:
    html = f.read()
    soup = BeautifulSoup(html)

    for div in soup.select(".mix"):
        info_video = div.select('.infoVideo')[0]
        id = div.select('a')[0].attrs['href'].split('/')[1]
        img_to_move = glob.glob(f'img/videos/{id}/*.jpg')[0]
        shutil.copyfile(img_to_move, f'img/videos/{id}.jpg')

        data.append({
            'id': id,
            'title': div.select('.videoTitle')[0].text,
            'description': info_video.attrs['data-description'],
            'youtube': info_video.attrs['data-youtube'],
            'tags': (div.attrs['class'][3:]),
        })

data = sorted(data, key=cmp_to_key(lambda a, b: int(a['id']) - int(b['id'])), reverse = True)

with open('_data/videos.yml', 'w') as outfile:
    yaml.dump(data, outfile, default_flow_style=False, indent=4, width=100000)
