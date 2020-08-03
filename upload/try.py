import requests
from bs4 import BeautifulSoup
proxies = {
    'http': 'socks5h://localhost:9050',
    'https': 'socks5h://localhost:9050'
}


def try_test(max_page):
    page = 1
    while page <= max_page:
        url = 'http://xmh57jrzrnw6insl.onion/4a1f6b371c/search.cgi?cmd=Search!&np=0&q=cow&s=DRP'
        source_code = requests.get(url, proxies=proxies)
        plain_text = source_code.text
        soup = BeautifulSoup(plain_text)
        for link in soup.findAll('a', {'target': '_blank'}):
            href = link.get('href')
            print(link.string)
        page += 1


try_test(1)
