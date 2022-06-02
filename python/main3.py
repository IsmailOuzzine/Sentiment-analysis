from random import random
import nltk
import sklearn
import csv
import numpy as np
from nltk.classify import NaiveBayesClassifier
from sklearn.model_selection import train_test_split
from nltk.tokenize import word_tokenize
import random

TableRow = []


negative = []
with open("neg_words.csv","r") as file:
    reader = csv.reader(file)
    for row in reader:
        negative.append(({row[0]: False}, 'neg'))
        TableRow.append(row[0])

positive = []
with open("pos_words.csv","r") as file:
    reader = csv.reader(file)
    for row in reader:
        positive.append(({row[0]: False}, 'pos'))
        TableRow.append(row[0])

random.shuffle(TableRow)
data_set = [*positive, *negative]

training_data, testing_data = train_test_split(data_set, test_size=0.1, random_state=25)

# for i in data_set:
print(len(testing_data))

classifier = NaiveBayesClassifier.train(training_data)

#classifier.show_most_informative_features()
print(nltk.classify.accuracy(classifier, testing_data))

#tests={'keys': 'I really like it'}
tests=['terrible', 
       'bad', 
       'good one',
       'hate']

for test in tests:
 t_features = {word: (word in word_tokenize(test.lower())) for word in TableRow}
 print(test," : ", classifier.classify(t_features))

#tests = ['I really like it']


#print(classifier.classify(tests))
#print(classifier)