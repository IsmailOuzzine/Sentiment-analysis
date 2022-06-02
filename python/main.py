from textblob import TextBlob
from newspaper import Article

# url = 'https://en.wikipedia.org/wiki/Mathematics'
url = 'https://www.positive.news/society/positive-news-stories-from-week-19-of-2022/'
# url = 'https://www.aljazeera.com/news/2022/5/12/analysis-refutes-video-pinning-abu-akleh-death-palestinians'
#url = 'https://www.positive.news/society/heard-the-one-about-comedy-prescriptions-for-trauma-mental-health/'

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
    with open('text.txt', 'r') as f :
        text = f.read()
        #print(text)

        blob = TextBlob(text)
        sentiment = blob.sentiment.polarity 
        print(sentiment)

fromArticle(url)
# fromText()