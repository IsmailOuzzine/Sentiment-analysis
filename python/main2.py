from newspaper import Article
import nltk
import csv
import numpy as np

from textblob import TextBlob
from newspaper import Article

#url = 'https://www.positive.news/society/heard-the-one-about-comedy-prescriptions-for-trauma-mental-health/'
#url = 'https://www.aljazeera.com/news/2022/5/12/shireen-abu-akleh-who-said-what-in-us-congress-on-slain-journalist'
url = 'https://www.positive.news/society/positive-news-stories-from-week-19-of-2022/'

negative = []
with open("neg_words.csv","r") as file:
    reader = csv.reader(file)
    for row in reader:
        negative.append(row)

positive = []
with open("pos_words.csv","r") as file:
    reader = csv.reader(file)
    for row in reader:
        positive.append(row)

def sentiment(text):
    temp = []
    text_sent = nltk.sent_tokenize(text)
    n_count = 0
    p_count = 0
    neutre = 0
    for sentence in text_sent:
        sent_words = nltk.word_tokenize(sentence)
        for word in sent_words:
            j = 0
            for item in positive:
                if(word == item[0]):
                    p_count+=1
                    j = 1
            for item in negative:
                if(word == item[0]):
                    n_count+=1
                    j = 1
            if j == 0 :
                neutre += 1
        # if(p_count>0 and n_count==0):
        #     temp.append(1)
        # elif (n_count%2 > 0):
        #     temp.append(-1)
        # elif (n_count%2==0 and n_count >0):
        #     temp.append(1)
        # else:
        #      temp.append(0)
    return (p_count - n_count) / (p_count + n_count)
        
    # return np.average(temp)

def fromArticle(link) :
    article = Article(link)

    article.download()
    article.parse()
    article.nlp()

    text = article.summary
    # print(text)
    
    print(sentiment(text))

def fromText() :
    with open('text.txt', 'r') as f :
        text = f.read()
        print(sentiment(text))

fromArticle(url)
#fromText()