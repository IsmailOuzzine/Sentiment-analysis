import sys
from textblob import TextBlob
from newspaper import Article
import os

# url = 'https://en.wikipedia.org/wiki/Mathematics'
# url = 'https://www.positive.news/society/positive-news-stories-from-week-19-of-2022/'
# url = 'https://www.aljazeera.com/news/2022/5/12/analysis-refutes-video-pinning-abu-akleh-death-palestinians'
# url = 'https://www.aljazeera.com/news/2022/5/12/shireen-abu-akleh-who-said-what-in-us-congress-on-slain-journalist'
# url = 'https://www.positive.news/society/heard-the-one-about-comedy-prescriptions-for-trauma-mental-health/'

def fromArticle(link) :
    article = Article(link)

    article.download()
    article.parse()
    article.nlp()

    text = article.summary
    # print(text)

    blob = TextBlob(text)
    sentiment = blob.sentiment.polarity 
    print(sentiment)

def fromText() :
    f = open('python/myText.txt', 'r')
    text = f.read()
    # print(text)

    blob = TextBlob(text)
    sentiment = blob.sentiment.polarity 
    print(sentiment)

if(len(sys.argv) > 1) :
    if sys.argv[1] == '-l' :
        url = sys.argv[2]
        fromArticle(url)
    elif sys.argv[1] == '-f' :
        fromText()