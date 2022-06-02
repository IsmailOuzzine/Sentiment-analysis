from newspaper import Article
from textblob import TextBlob
import nltk
import csv
import numpy as np
import sys


#nltk.download('punkt')


negative = []
with open("python/neg_words.csv","r") as file:
    reader = csv.reader(file)
    for row in reader:
        negative.append(row)

positive = []
with open("python/pos_words.csv","r") as file:
    reader = csv.reader(file)
    for row in reader:
        positive.append(row)

def sentiment1(text):
    text_sent = nltk.sent_tokenize(text)
    for sentence in text_sent:
        n_count =0
        p_count= 0
        sent_words = nltk.word_tokenize(sentence)
        for word in sent_words:
            for item in positive:
                if(word == item[0]):
                    p_count+=1
            for item in negative:
                if(word == item[0]):
                    n_count+=1
        # if(p_count> n_count):
            # print ("+ : " + sentence)
        # elif (p_count < n_count):
            # print ("- : " + sentence)
        # else:
            #  print ("? : " + sentence) 


def fromArticle(link) :
    article = Article(link)

    article.download()
    article.parse()
    article.nlp()

    text = article.summary
    # print(text)
    
    print(sentiment(text))


def fromText() :
    with open('python/myText.txt', 'r') as f :
        text = f.read()
        print(sentiment(text))



comment = [""]
def sentiment(text):
    temp = []
    text_sent = nltk.sent_tokenize(text)
    n_count =0
    p_count= 0
    for sentence in text_sent:
        sent_words = nltk.word_tokenize(sentence)
        for word in sent_words:
            for item in positive:
                if(word == item[0]):
                    p_count+=1
            for item in negative:
                if(word == item[0]):
                    n_count+=1
        # print(p_count," | ",n_count)
        if(p_count > n_count):
            temp.append(1)
        elif (n_count >  p_count):
            temp.append(-1)
        else:
             temp.append(0)
    # print(temp)
    #return np.average(temp)
    return (p_count - n_count) / (p_count + n_count)


if(len(sys.argv) > 1) :
    if sys.argv[1] == '-l' :
        url = sys.argv[2]
        fromArticle(url)
    elif sys.argv[1] == '-f' :
        fromText()
# fromArticle("https://www.mayoclinic.org/healthy-lifestyle/tween-and-teen-health/in-depth/teens-and-social-media-use/art-20474437")