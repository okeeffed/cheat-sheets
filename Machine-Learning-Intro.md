# Intro to Machine Learning

## Table of Contents

<!-- TOC -->

*   [Intro to Machine Learning](#intro-to-machine-learning)
    *   [Table of Contents](#table-of-contents)
    *   [What is Machine Learning?](#what-is-machine-learning)
        *   [---- Basic Model Prediction](#-----basic-model-prediction)
    *   [Classification, Regression, Clustering](#classification-regression-clustering)
        *   [---- Classification Example: Filtering Spam](#-----classification-example-filtering-spam)
        *   [---- Regression Example: LinkedIn Views](#-----regression-example-linkedin-views)
        *   [---- Clustering Example: Separating the Iris Species](#-----clustering-example-separating-the-iris-species)
        *   [---- Supervised vs. Unsupervised](#-----supervised-vs-unsupervised)
        *   [---- Getting practical with supervised learning](#-----getting-practical-with-supervised-learning)
        *   [---- Getting practical with unsupervised learning](#-----getting-practical-with-unsupervised-learning)
    *   [Performance Measures](#performance-measures)
        *   [---- Confusion Matrix](#-----confusion-matrix)
        *   [---- Calculating the RMSE of air data](#-----calculating-the-rmse-of-air-data)
        *   [---- Clustering dataset example](#-----clustering-dataset-example)
        *   [---- Training Set and Test Set](#-----training-set-and-test-set)
        *   [---- Split the Sets](#-----split-the-sets)
        *   [---- Using Cross Validation](#-----using-cross-validation)
        *   [---- Bias and Variance](#-----bias-and-variance)
        *   [---- Overfitting the Spam](#-----overfitting-the-spam)
    *   [Classification](#classification)
        *   [---- Learn a Decision Tree](#-----learn-a-decision-tree)
        *   [---- Classify with the Decision Tree](#-----classify-with-the-decision-tree)
        *   [---- Pruning the Tree](#-----pruning-the-tree)
        *   [---- Gini Criterion](#-----gini-criterion)
        *   [---- k-Nearest Neighbors](#-----k-nearest-neighbors)
        *   [---- Scaling Example](#-----scaling-example)
        *   [---- Interpreting a Voronoi Diagram](#-----interpreting-a-voronoi-diagram)

<!-- /TOC -->

---

## What is Machine Learning?

Construction/use of algorithms that learn from data.

We decide that it can learn when it has higher performance after learning more information.

Example: label squares based on size and edge.

If some squares were, however, solved by people - then these instances can be used to give an informed reply.

For input knowledge, we can use pre-labeled squares that may give us an indication of which way to go.

We can make ground on this by constructing a data frame.

```
These can be used in R to get more information.

dim()
str()
summary()
```

The goal is to build models for prediction.

We can use things like regression to help predict these things.

_Formulation_

Input -> _Estimated Function_ -> Output

```
# Reveal number of observations and variables in two different ways
> str(iris)
'data.frame':	150 obs. of  5 variables:
 $ Sepal.Length: num  5.1 4.9 4.7 4.6 5 5.4 4.6 5 4.4 4.9 ...
 $ Sepal.Width : num  3.5 3 3.2 3.1 3.6 3.9 3.4 3.4 2.9 3.1 ...
 $ Petal.Length: num  1.4 1.4 1.3 1.5 1.4 1.7 1.4 1.5 1.4 1.5 ...
 $ Petal.Width : num  0.2 0.2 0.2 0.2 0.2 0.4 0.3 0.2 0.2 0.1 ...
 $ Species     : Factor w/ 3 levels "setosa","versicolor",..: 1 1 1 1 1 1 1 1 1 1 ...
> dim(iris)
[1] 150   5
>
>
# Show first and last observations in the iris data set
> head(iris)
  Sepal.Length Sepal.Width Petal.Length Petal.Width Species
1          5.1         3.5          1.4         0.2  setosa
2          4.9         3.0          1.4         0.2  setosa
3          4.7         3.2          1.3         0.2  setosa
4          4.6         3.1          1.5         0.2  setosa
5          5.0         3.6          1.4         0.2  setosa
6          5.4         3.9          1.7         0.4  setosa
> tail(iris)
    Sepal.Length Sepal.Width Petal.Length Petal.Width   Species
145          6.7         3.3          5.7         2.5 virginica
146          6.7         3.0          5.2         2.3 virginica
147          6.3         2.5          5.0         1.9 virginica
148          6.5         3.0          5.2         2.0 virginica
149          6.2         3.4          5.4         2.3 virginica
150          5.9         3.0          5.1         1.8 virginica
>
>
# Summarize the iris data set
> summary(iris)
  Sepal.Length    Sepal.Width     Petal.Length    Petal.Width
 Min.   :4.300   Min.   :2.000   Min.   :1.000   Min.   :0.100  
 1st Qu.:5.100   1st Qu.:2.800   1st Qu.:1.600   1st Qu.:0.300  
 Median :5.800   Median :3.000   Median :4.350   Median :1.300  
 Mean   :5.843   Mean   :3.057   Mean   :3.758   Mean   :1.199  
 3rd Qu.:6.400   3rd Qu.:3.300   3rd Qu.:5.100   3rd Qu.:1.800  
 Max.   :7.900   Max.   :4.400   Max.   :6.900   Max.   :2.500  
       Species  
 setosa    :50  
 versicolor:50  
 virginica :50  
```

<div id="subsection"></div>

### ---- Basic Model Prediction

You'll be working with the Wage dataset. It contains the wage and some general information for workers in the mid-Atlantic region of the US.

As we briefly discussed in the video, there could be a relationship between a worker's age and his wage. Older workers tend to have more experience on average than their younger counterparts, hence you could expect an increasing trend in wage as workers age. So we built a linear regression model for you, using lm(): lm_wage. This model predicts the wage of a worker based only on the worker's age.

With this linear model lm_wage, which is built with data that contain information on workers' age and their corresponding wage, you can predict the wage of a worker given the age of that worker. For example, suppose you want to predict the wage of a 60 year old worker. You can use the predict() function for this. This generic function takes a model as the first argument. The second argument should be some unseen observations as a data frame. predict() is then able to predict outcomes for these observations.

```
> str(Wage)
'data.frame':	3000 obs. of  12 variables:
 $ year      : int  2006 2004 2003 2003 2005 2008 2009 2008 2006 2004 ...
 $ age       : int  18 24 45 43 50 54 44 30 41 52 ...
 $ sex       : Factor w/ 2 levels "1. Male","2. Female": 1 1 1 1 1 1 1 1 1 1 ...
 $ maritl    : Factor w/ 5 levels "1. Never Married",..: 1 1 2 2 4 2 2 1 1 2 ...
 $ race      : Factor w/ 4 levels "1. White","2. Black",..: 1 1 1 3 1 1 4 3 2 1 ...
 $ education : Factor w/ 5 levels "1. < HS Grad",..: 1 4 3 4 2 4 3 3 3 2 ...
 $ region    : Factor w/ 9 levels "1. New England",..: 2 2 2 2 2 2 2 2 2 2 ...
 $ jobclass  : Factor w/ 2 levels "1. Industrial",..: 1 2 1 2 2 2 1 2 2 2 ...
 $ health    : Factor w/ 2 levels "1. <=Good","2. >=Very Good": 1 2 1 2 1 2 2 1 2 2 ...
 $ health_ins: Factor w/ 2 levels "1. Yes","2. No": 2 2 1 1 1 1 1 1 1 1 ...
 $ logwage   : num  4.32 4.26 4.88 5.04 4.32 ...
 $ wage      : num  75 70.5 131 154.7 75 ...
>
# Build Linear Model: lm_wage (coded already)
> lm_wage <- lm(wage ~ age, data = Wage)
>
# Define data.frame: unseen (coded already)
> unseen <- data.frame(age = 60)
>
# Predict the wage for a 60-year old worker
> predict(lm_wage, unseen)
       1
124.1413
```

<div id="newSection"></div>

---

## Classification, Regression, Clustering

These are the three common types of ML Problems.

**Classification**

Predicting category through historical classifying.

`Earlier Observations` -> _estimate_ -> `CLASSIFIER`

`Unseen Data` -> _CLASSIFIER_ -> `Class`

Application: Medical Diagnosis, Animal Recognition

Important: Qualitative Output, Predefined Classes

**Regression**

We are trying to estimate a function that will render the correct response.

Eg. knowing height and weight, is there a relationship? Is it linear? Can we predict a height given a weight?

`PREDICTORS` -> _Regression Function_ -> `RESPONSE`

Application: Modelling Payments for Credit Scores, YouTube Subscriptions over time, Job dependent on Grades.

Important: Quantitative Output, previous input-output observations

**Clustering**

Grouping objects that are `similar` in clusters and `dissimilar` between clusters. It's like classification without saying which class an object need to relate to.

Eg. Grouping similar animal photos

There `no labels, no right or wrong, and plenty of possible clusterings`

Another example is k-Means can do things like cluster in similar groups.

<div id="spam"></div>

### ---- Classification Example: Filtering Spam

In the following exercise you'll work with the dataset emails, which is loaded in your workspace (Source: UCI Machine Learning Repository). Here, several emails have been labeled by humans as spam (1) or not spam (0) and the results are found in the column spam. The considered feature in emails to predict whether it was spam or not is avgCapitalSeq. It is the average amount of sequential capital letters found in each email.

In the code, you'll find a crude spam filter we built for you, spamClassifier() that uses avgCapitalSeq to predict whether an email is spam or not. In the function definition, it's important to realize that x refers to avgCapitalSeq. So where the avgCapitalSeq is greater than 4, spamClassifier() predicts the email is spam (1), if avgCapitalSeq is inclusively between 3 and 4, it predicts not spam (0), and so on. This classifier's methodology of predicting whether an email is spam or not seems pretty random, but let's see how it does anyways!

Your job is to inspect the emails dataset, apply spamClassifier to it, and compare the predicted labels with the true labels.

```
# Show the dimensions of emails
> dim(emails)
[1] 13  2
>
# Inspect definition of spam_classifier()
> spam_classifier <- function(x){
    prediction <- rep(NA, length(x)) # initialize prediction vector
    prediction[x > 4] <- 1
    prediction[x >= 3 & x <= 4] <- 0
    prediction[x >= 2.2 & x < 3] <- 1
    prediction[x >= 1.4 & x < 2.2] <- 0
    prediction[x > 1.25 & x < 1.4] <- 1
    prediction[x <= 1.25] <- 0
    return(prediction) # prediction is either 0 or 1
  }
>
# Apply the classifier to the avgCapitalSeq column: spam_pred
> spamPred <- sapply(emails$avgCapitalSeq, spamClassifier)
>
# Compare spam_pred to emails$spam. Use ==
> spam_pred == emails$spam
 [1] TRUE TRUE TRUE TRUE TRUE TRUE TRUE TRUE TRUE TRUE TRUE TRUE TRUE
```

<div id="linkedinviews"></div>

### ---- Regression Example: LinkedIn Views

It's time for you to make another prediction with regression! More precisely, you'll analyze the number of views of your LinkedIn profile. With your growing network and your data science skills improving daily, you wonder if you can predict how often your profile will be visited in the future based on the number of days it's been since you created your LinkedIn account.

The instructions will help you predict the number of profile views for the next 3 days, based on the views for the past 3 weeks. The linkedin vector, which contains this information, is already available in your workspace.

```
# linkedin is already available in your workspace
>
# Create the days vector
> days <- c(seq(1:21))
>
# Fit a linear model called on the linkedin views per day: linkedin_lm
> linkedin_lm <- lm(linkedin ~ days)
>
# Predict the number of views for the next three days: linkedin_pred
> future_days <- data.frame(days = 22:24)
> linkedin_pred <- predict(linkedin_lm, future_days)
>
# Plot historical data and predictions
> plot(linkedin ~ days, xlim = c(1, 24))
> points(22:24, linkedin_pred, col = "green")
```

<div id="clusteriris"></div>

### ---- Clustering Example: Separating the Iris Species

Last but not least, there's clustering. This technique tries to group your objects. It does this without any prior knowledge of what these groups could or should look like. For clustering, the concepts of prior knowledge and unseen observations are less meaningful than for classification and regression.

In this exercise, you'll group irises in 3 distinct clusters, based on several flower characteristics in the iris dataset. It has already been chopped up in a data frame my_iris and a vector species, as shown in the sample code on the right.

The clustering itself will be done with the kmeans() function. How the algorithm actually works, will be explained in the last chapter. For now, just try it out to gain some intuition!

Note: In problems that have a random aspect (like this problem with kmeans()), the set.seed() function will be used to enforce reproducibility. If you fix the seed, the random numbers that are generated (e.g. in kmeans()) are always the same.

```
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Chop up iris in my_iris and species
> my_iris <- iris[-5]
> species <- iris$Species
>
# Perform k-means clustering on my_iris: kmeans_iris
> kmeans_iris <- kmeans(my_iris, 3)
>
# Compare the actual Species to the clustering using table()
> table(species, kmeans_iris$cluster)

species       1  2  3
  setosa     50  0  0
  versicolor  0  2 48
  virginica   0 36 14
>
# Plot Petal.Width against Petal.Length, coloring by cluster
> plot(Petal.Length ~ Petal.Width, data = my_iris, col = kmeans_iris$cluster)
```

<div id="super"></div>

### ---- Supervised vs. Unsupervised

Classification and Regression have similar traits.

If we can `find` function f which can be used to assign a class or value to unseen observations `given` a set of labeled observations, we call this `Supervised Learning`.

`Labelling` can be tedious and are normally done by humans. Those that don't require labels is known as `Unsupervised Learning` - example being the clustering that we did before. Clustering will find group observations that are similar.

**Performance of the model**

*   Supervised learning - `Compare` real labels with `predicted` labels
*   Unsupervised Learning - No real labels to compare - Techniques will be explained later down the track - Things aren't always black and white
*   Semi-Supervised Learning - Mixed of unlabeled and labeled observationed - Eg clustering information and classes of labeled observations to assign a class to unlabeled observations - More labeled observations for `supervised learning`

<div id="superPrac"></div>

### ---- Getting practical with supervised learning

In this exercise, you will use the same dataset. But instead of dropping the Species labels, you will use them do some supervised learning using recursive partitioning! Don't worry if you don't know what that is yet. Recursive partitioning (a.k.a. decision trees) will be explained in Chapter 3.

Take a look at the iris dataset, using str() and summary().

The code that builds a supervised learning model with the rpart() function from the rpart package is already provided for you. This model trains a decision tree on the iris dataset.

Use the predict() function with the tree model as the first argument. The second argument should be a data frame containing observations of which you want to predict the label. In this case, you can use the predefined unseen data frame. The third argument should be type = "class".

Simply print out the result of this prediction step.

```
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Take a look at the iris dataset
> str(iris)
'data.frame':	150 obs. of  5 variables:
 $ Sepal.Length: num  5.1 4.9 4.7 4.6 5 5.4 4.6 5 4.4 4.9 ...
 $ Sepal.Width : num  3.5 3 3.2 3.1 3.6 3.9 3.4 3.4 2.9 3.1 ...
 $ Petal.Length: num  1.4 1.4 1.3 1.5 1.4 1.7 1.4 1.5 1.4 1.5 ...
 $ Petal.Width : num  0.2 0.2 0.2 0.2 0.2 0.4 0.3 0.2 0.2 0.1 ...
 $ Species     : Factor w/ 3 levels "setosa","versicolor",..: 1 1 1 1 1 1 1 1 1 1 ...
> summary(iris)
  Sepal.Length    Sepal.Width     Petal.Length    Petal.Width
 Min.   :4.300   Min.   :2.000   Min.   :1.000   Min.   :0.100  
 1st Qu.:5.100   1st Qu.:2.800   1st Qu.:1.600   1st Qu.:0.300  
 Median :5.800   Median :3.000   Median :4.350   Median :1.300  
 Mean   :5.843   Mean   :3.057   Mean   :3.758   Mean   :1.199  
 3rd Qu.:6.400   3rd Qu.:3.300   3rd Qu.:5.100   3rd Qu.:1.800  
 Max.   :7.900   Max.   :4.400   Max.   :6.900   Max.   :2.500  
       Species  
 setosa    :50  
 versicolor:50  
 virginica :50
>
# A decision tree model has been built for you
> tree <- rpart(Species ~ Sepal.Length + Sepal.Width + Petal.Length + Petal.Width,
                data = iris, method = "class")
>
# A dataframe containing unseen observations
> unseen <- data.frame(Sepal.Length = c(5.3, 7.2),
                       Sepal.Width = c(2.9, 3.9),
                       Petal.Length = c(1.7, 5.4),
                       Petal.Width = c(0.8, 2.3))
>
# Predict the label of the unseen observations. Print out the result.
> predict(tree, unseen, type="class")
        1         2
   setosa virginica
Levels: setosa versicolor virginica
```

<div id="unsuperPrac"></div>

### ---- Getting practical with unsupervised learning

```
> head(cars)
                     wt  hp
Mazda RX4         2.620 110
Mazda RX4 Wag     2.875 110
Datsun 710        2.320  93
Hornet 4 Drive    3.215 110
Hornet Sportabout 3.440 175
Valiant           3.460 105
> # The cars data frame is pre-loaded
>
> # Set random seed. Don't remove this line.
> set.seed(1)
>
> # Explore the cars dataset
>
> str(cars)
'data.frame':	32 obs. of  2 variables:
 $ wt: num  2.62 2.88 2.32 3.21 3.44 ...
 $ hp: num  110 110 93 110 175 105 245 62 95 123 ...
> summary(cars)
       wt              hp
 Min.   :1.513   Min.   : 52.0  
 1st Qu.:2.581   1st Qu.: 96.5  
 Median :3.325   Median :123.0  
 Mean   :3.217   Mean   :146.7  
 3rd Qu.:3.610   3rd Qu.:180.0  
 Max.   :5.424   Max.   :335.0  
>
> # Group the dataset into two clusters: km_cars
> km_cars <- kmeans(cars, 2)
>
> # Print out the contents of each cluster
> km_cars$cluster
          Mazda RX4       Mazda RX4 Wag          Datsun 710      Hornet 4 Drive
                  1                   1                   1                   1
  Hornet Sportabout             Valiant          Duster 360           Merc 240D
                  2                   1                   2                   1
           Merc 230            Merc 280           Merc 280C          Merc 450SE
                  1                   1                   1                   2
         Merc 450SL         Merc 450SLC  Cadillac Fleetwood Lincoln Continental
                  2                   2                   2                   2
  Chrysler Imperial            Fiat 128         Honda Civic      Toyota Corolla
                  2                   1                   1                   1
      Toyota Corona    Dodge Challenger         AMC Javelin          Camaro Z28
                  1                   1                   1                   2
   Pontiac Firebird           Fiat X1-9       Porsche 914-2        Lotus Europa
                  2                   1                   1                   1
     Ford Pantera L        Ferrari Dino       Maserati Bora          Volvo 142E
                  2                   2                   2                   1

# see km_cars in general
> km_cars
K-means clustering with 2 clusters of sizes 19, 13

Cluster means:
        wt        hp
1 2.692000  99.47368
2 3.984923 215.69231

Clustering vector:
          Mazda RX4       Mazda RX4 Wag          Datsun 710      Hornet 4 Drive
                  1                   1                   1                   1
  Hornet Sportabout             Valiant          Duster 360           Merc 240D
                  2                   1                   2                   1
           Merc 230            Merc 280           Merc 280C          Merc 450SE
                  1                   1                   1                   2
         Merc 450SL         Merc 450SLC  Cadillac Fleetwood Lincoln Continental
                  2                   2                   2                   2
  Chrysler Imperial            Fiat 128         Honda Civic      Toyota Corolla
                  2                   1                   1                   1
      Toyota Corona    Dodge Challenger         AMC Javelin          Camaro Z28
                  1                   1                   1                   2
   Pontiac Firebird           Fiat X1-9       Porsche 914-2        Lotus Europa
                  2                   1                   1                   1
     Ford Pantera L        Ferrari Dino       Maserati Bora          Volvo 142E
                  2                   2                   2                   1

Within cluster sum of squares by cluster:
[1] 14085.06 27403.23
 (between_SS / total_SS =  71.5 %)

Available components:

[1] "cluster"      "centers"      "totss"        "withinss"     "tot.withinss"
[6] "betweenss"    "size"         "iter"         "ifault"
```

An important part in machine learning is understanding your results. In the case of clustering, visualization is key to interpretation! One way to achieve this is by plotting the features of the cars and coloring the points based on their corresponding cluster.

In this exercise you'll summarize your results in a comprehensive figure. The dataset cars is already available in your workspace; the code to perform the clustering is already available.

```
# The cars data frame is pre-loaded
>
# Set random seed. Don't remove this line
> set.seed(1)
>
# Group the dataset into two clusters: km_cars
> km_cars <- kmeans(cars, 2)
>
# Add code: color the points in the plot based on the clusters
> plot(cars, col=km_cars$cluster)
>
# Print out the cluster centroids
> km_cars$centers
        wt        hp
1 2.692000  99.47368
2 3.984923 215.69231
>
# Replace the ___ part: add the centroids to the plot
> points(km_cars$centers, pch = 22, bg = c(1, 2), cex = 2)
```

<div id="performance"></div>

---

## Performance Measures

How is our model any good? It depends on how you define performance. This could be...

*   Accuracy
*   Computation Time
*   Interpretability

**Classification Testing**

Accuray and Error are how we can help define classification performance.

`Accuray = corrct / total`

Eg. Square with 2 features. If each square can be coloured/not coloured (binary classification problem)

If the model only classifies 3/5 correct, then that is our accuracy (60%).

_Limits of accuracy_

Confusion matrix: rows and columns with each available labels.

Each cell contains frequency of instances that are classified in a certain way.

For a binary classifier, we have positive or negative in this case (1 or 0). Our matrix then becomes a square table of Truth vs. Prediction. TP, FN, FP, TN.

From this we can calculation `Precision as TP/(TP+FP)` and `Recall is TP/(TP+FN)`. Back on the square example, we can talk about which were correctly classified.

Accuracy calculation then becomes `(TP+TN)/sum(all squares)`.

This means for the `rare heart disease` example, we could be looking at a recall of 0% and other results that are `undefined`.

**Regression Testing**

RMSE: Root Mean Squared Error.

**Clustering Testing**

Here, we have no label info, so we need to go with distance metrics between points.

Performance measure consists of 2 elements.

1.  Similarity within each cluster - we want this to be high
2.  Similarity between clusters - we want this to be low

There are a number techniques.

Within clusters:

*   Within sum of squares(WSS)
*   Diameter
*   Minimize

Between clusters:

*   Between cluster sum of squares (BSS)
*   Intercluster distance
*   Maximise

A popular index for comparing is the Dunn's index: `minimal intercluster distance/maximal diameter`

<div id="perf2"></div>

### ---- Confusion Matrix

In this exercise, a decision tree is learned on this dataset. The tree aims to predict whether a person would have survived the accident based on the variables Age, Sex and Pclass (travel class). The decision the tree makes can be deemed correct or incorrect if we know what the person's true outcome was. That is, if it's a supervised learning problem.

Since the true fate of the passengers, Survived, is also provided in titanic, you can compare it to the prediction made by the tree. As you've seen in the video, the results can be summarized in a confusion matrix. In R, you can use the table() function for this.

In this exercise, you will only focus on assessing the performance of the decision tree. In chapter 3, you will learn how to actually build a decision tree yourself.

Note: As in the previous chapter, there are functions that have a random aspect. The set.seed() function is used to enforce reproducibility. Don't worry about it, just don't remove it!

```
# The titanic dataset is already loaded into your workspace
>
# Set random seed. Don't remove this line
> set.seed(1)
>
# Have a look at the structure of titanic
> str(titanic)
'data.frame':	714 obs. of  4 variables:
 $ Survived: Factor w/ 2 levels "1","0": 2 1 1 1 2 2 2 1 1 1 ...
 $ Pclass  : int  3 1 3 1 3 1 3 3 2 3 ...
 $ Sex     : Factor w/ 2 levels "female","male": 2 1 1 1 2 2 2 1 1 1 ...
 $ Age     : num  22 38 26 35 35 54 2 27 14 4 ...
>
# A decision tree classification model is built on the data
> tree <- rpart(Survived ~ ., data = titanic, method = "class")
>
# Use the predict() method to make predictions, assign to pred
> pred <- predict(tree, titanic, type="class")
>
# Use the table() method to make the confusion matrix
> table(titanic$Survived, pred)
   pred
      1   0
  1 212  78
  0  53 371
```

The confusion matrix from the last exercise provides you with the raw performance of the decision tree:

The survivors correctly predicted to have survived: true positives (TP)
The deceased who were wrongly predicted to have survived: false positives (FP)
The survivors who were wrongly predicted to have perished: false negatives (FN)
The deceased who were correctly predicted to have perished: true negatives (TN)

```
> conf

      1   0
  1 212  78
  0  53 371
# The confusion matrix is available in your workspace as conf
>
# Assign TP, FN, FP and TN using conf
> TP <- conf[1, 1] # this will be 212
> FN <- conf[1, 2] # this will be 78
> FP <- conf[2, 1] # fill in
> TN <- conf[2, 2] # fill in
>
# Calculate and print the accuracy: acc
> acc <- (TP + TN) / (TP + FN + FP + TN)
> acc
[1] 0.8165266
>
# Calculate and print out the precision: prec
> prec <- TP/(TP+FP)
> prec
[1] 0.8
>
# Calculate and print out the recall: rec
> rec <- TP/(TP+FN)
> rec
[1] 0.7310345
```

### ---- Calculating the RMSE of air data

```
# The air dataset is already loaded into your workspace
>
# Take a look at the structure of air
> str(air)
'data.frame':	1503 obs. of  6 variables:
 $ freq     : int  800 1000 1250 1600 2000 2500 3150 4000 5000 6300 ...
 $ angle    : num  0 0 0 0 0 0 0 0 0 0 ...
 $ ch_length: num  0.305 0.305 0.305 0.305 0.305 ...
 $ velocity : num  71.3 71.3 71.3 71.3 71.3 71.3 71.3 71.3 71.3 71.3 ...
 $ thickness: num  0.00266 0.00266 0.00266 0.00266 0.00266 ...
 $ dec      : num  126 125 126 128 127 ...
>
# Inspect your colleague's code to build the model
> fit <- lm(dec ~ freq + angle + ch_length, data = air)
>
# Use the model to predict for all values: pred
> pred <- predict(fit)
>
# Use air$dec and pred to calculate the RMSE
> rmse <- sqrt((1/nrow(air)) * sum( (air$dec - pred) ^ 2))
>
# Print out rmse
> rmse
[1] 5.215778
```

Using the `rmse` result for comparison with another result

```
# Previous model
> fit <- lm(dec ~ freq + angle + ch_length, data = air)
> pred <- predict(fit)
> rmse <- sqrt(sum( (air$dec - pred) ^ 2) / nrow(air))
> rmse
[1] 5.215778
>
# Your colleague's more complex model
> fit2 <- lm(dec ~ freq + angle + ch_length + velocity + thickness, data = air)
>
# Use the model to predict for all values: pred2
> pred2 <- predict(fit2)
>
# Calculate rmse2
> rmse2 <- sqrt(sum( (air$dec - pred2) ^ 2) / nrow(air))
>
# Print out rmse2
> rmse2
[1] 4.799244
```

Adding complexity seems to have caused the RMSE to decrease, from 5.216 to 4.799. But there's more going on here; perhaps adding more variables to a regression always leads to a decrease of your RMSE? There will be more on this later.

### ---- Clustering dataset example

In the dataset seeds you can find various metrics such as area, perimeter and compactness for 210 seeds. (Source: UCIMLR). However, the seeds' labels were lost. Hence, we don't know which metrics belong to which type of seed. What we do know, is that there were three types of seeds.

The code on the right groups the seeds into three clusters (km_seeds), but is it likely that these three clusters represent our seed types? Let's find out.

There are two initial steps you could take:

1.  Visualize the distribution of cluster assignments among two variables, for example length and compactness.

2.  Verify if the clusters are well separated and compact. To do this, you can calculate the between and within cluster sum of squares respectively.

```
# The seeds dataset is already loaded into your workspace
>
# Set random seed. Don't remove this line
> set.seed(1)
>
# Explore the structure of the dataset
> str(seeds)
'data.frame':	210 obs. of  7 variables:
 $ area         : num  15.3 14.9 14.3 13.8 16.1 ...
 $ perimeter    : num  14.8 14.6 14.1 13.9 15 ...
 $ compactness  : num  0.871 0.881 0.905 0.895 0.903 ...
 $ length       : num  5.76 5.55 5.29 5.32 5.66 ...
 $ width        : num  3.31 3.33 3.34 3.38 3.56 ...
 $ asymmetry    : num  2.22 1.02 2.7 2.26 1.35 ...
 $ groove_length: num  5.22 4.96 4.83 4.8 5.17 ...
>
# Group the seeds in three clusters
> km_seeds <- kmeans(seeds, 3)
>
# Color the points in the plot based on the clusters
> plot(length ~ compactness, data = seeds, col = km_seeds$cluster)
>
# Print out the ratio of the WSS to the BSS
> km_seeds$tot.withinss / km_seeds$betweenss
[1] 0.2762846
```

The within sum of squares is far lower than the between sum of squares. Indicating the clusters are well seperated and overall compact. This is further strengthened by the plot you made, where the clusters you made were visually distinct for these two variables. It's likely that these three clusters represent the three seed types well, even if there's no way to truly verify this.

<div id="sets"></div>

### ---- Training Set and Test Set

Looking at the different between supervised learning, Machine learning and other data models.

Supervised learning will have a strong predictive power. - unseen observations

Classical statistics: model must fit data - explain or describe data

Predictive Model - Training - `not` on complete dataset - training set - `Test set` to evaluate performance of model - Sets are `disjoint` - NO OVERLAP - Model testing on `unseen` observations - Generalization!

**Split the dataset**

Assume you have a dataset with N observations: x, K features: F and Class labels: y.

We can break this down into a training set and a test set.

The test set are used for the observations from x(r+1).

**When do we use this?**

Only important for supervised learning set. It would not be relevant to things like clustering where the data itself isn't labelled.

**How to split the sets?**

The `training set` should be larger than the `test set`. Typically a ratio of 3:1 - although this is arbitrary. The more data you use to train, the better the model. Although, we still don't want the `test set` to be too small!

Wisely choose which elements you put into these sets. They should have similar distributions. Avoid a class not being in a set.

_Regression and Classification_ - it is always a smart idea to shuffle the data set before splitting it.

_Effect of smapling_ - sampling can affect performance measures. Add `robustness` to these measures with `cross-validation`.

_Cross-validation_ - Eg. 4-folds validation. This means the splitting the data set and doing this for 4-folds. - n-fold validation means doing this n times with each test set being 1/n large.

<div id="split"></div>

### ---- Split the Sets

In exercises 2 and 3 you calculated a confusion matrix to assess the tree's performance. However, the tree was built using the entire set of observations. Therefore, the confusion matrix doesn't assess the predictive power of the tree. The training set and the test set were one and the same thing: this can be improved!

First, you'll want to split the dataset into train and test sets. You'll notice that the titanic dataset is sorted on titanic$Survived , so you'll need to first shuffle the dataset in order to have a fair distribution of the output variable in each set.

For example, you could use the following commands to shuffle a data frame df and divide it into training and test sets with a 60/40 split between the two.

```
n <- nrow(df)
shuffled_df <- df[sample(n), ]
train_indices <- 1:round(0.6 * n)
train <- shuffled_df[train_indices, ]
test_indices <- (round(0.6 * n) + 1):n
test <- shuffled_df[test_indices, ]
```

```
# The titanic dataset is already loaded into your workspace
>
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Shuffle the dataset, call the result shuffled
> n <- nrow(titanic)
> shuffled <- titanic[sample(n),]
>
# Split the data in train and test
> train_indices <- 1:round(0.7 * n)
> train <- shuffled[train_indices, ]
> test_indices <- (round(0.7 * n) + 1):n
> test <- shuffled[test_indices, ]
>
# Print the structure of train and test
> str(train)
'data.frame':	500 obs. of  4 variables:
 $ Survived: Factor w/ 2 levels "1","0": 2 2 2 1 2 1 1 1 1 2 ...
 $ Pclass  : int  3 3 2 1 3 1 2 3 2 3 ...
 $ Sex     : Factor w/ 2 levels "female","male": 2 2 1 2 2 2 1 2 1 2 ...
 $ Age     : num  32 19 44 27 7 56 48 9 29 26 ...
> str(test)
'data.frame':	214 obs. of  4 variables:
 $ Survived: Factor w/ 2 levels "1","0": 1 2 2 1 2 2 2 2 2 2 ...
 $ Pclass  : int  2 3 2 2 1 1 3 3 2 3 ...
 $ Sex     : Factor w/ 2 levels "female","male": 1 2 2 1 2 2 2 2 2 1 ...
 $ Age     : num  18 16 36 45 61 31 40.5 28 30 2 ...
```

Time to redo the model training from before. The titanic data frame is again available in your workspace. This time, however, you'll want to build a decision tree on the training set, and next assess its predictive power on a set that has not been used for training: the test set.

On the right, the code that splits titanic up in train and test has already been included. Also, the old code that builds a decision tree on the entire set is included. Up to you to correct it and connect the dots to get a good estimate of the model's predictive ability.

```
# The titanic dataset is already loaded into your workspace
>
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Shuffle the dataset; build train and test
> n <- nrow(titanic)
> shuffled <- titanic[sample(n),]
> train <- shuffled[1:round(0.7 * n),]
> test <- shuffled[(round(0.7 * n) + 1):n,]
>
# Fill in the model that has been learned.
> tree <- rpart(Survived ~ ., train, method = "class")
>
# Predict the outcome on the test set with tree: pred
> pred <- predict(tree, test, type="class")
>
# Calculate the confusion matrix: conf
> conf <- table(test$Survived, pred)
>
# Print this confusion matrix
> conf
   pred
      1   0
  1  58  31
  0  23 102
```

<div id="xvalid"></div>

### ---- Using Cross Validation

In this exercise, you will fold the dataset 6 times and calculate the accuracy for each fold. The mean of these accuracies forms a more robust estimation of the model's true accuracy of predicting unseen data, because it is less dependent on the choice of training and test sets.

Note: Other performance measures, such as recall or precision, could also be used here.

```
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Initialize the accs vector
> accs <- rep(0,6)
>
> for (i in 1:6) {
    # These indices indicate the interval of the test set
    indices <- (((i-1) * round((1/6)*nrow(shuffled))) + 1):((i*round((1/6) * nrow(shuffled))))

    # Exclude them from the train set
    train <- shuffled[-indices,]

    # Include them in the test set
    test <- shuffled[indices,]

    # A model is learned using each training set
    tree <- rpart(Survived ~ ., train, method = "class")

    # Make a prediction on the test set using tree
    pred <- predict(tree, test, type="class")

    # Assign the confusion matrix to conf
    conf <- table(test$Survived, pred)

    # Assign the accuracy of this model to the ith index in accs
    accs[i] <- sum(diag(conf))/sum(conf)
  }
>
> accs
[1] 0.7983193 0.7983193 0.7899160 0.8067227 0.8235294 0.7899160
# Print out the mean of accs
> mean(accs)
[1] 0.8011204
```

This estimate will be a more robust measure of your accuracy. It will be less susceptible to the randomness of splitting the dataset.

<div id="bias"></div>

### ---- Bias and Variance

How does splitting affect the accuracy?

We use `Bias` and `Variance` as our keys.

The main goal of course is `prediction`. The `prediction error` can be split into the `reducible error` and the `irreducible error`.

Irreducible: noise - don't minimize!
Reducible: error due to unfit model - this we want to minimize!

_Bias Error_

Error due to bias: wrong assumptions.
Difference in predictions and truth. - using models trained by specific `learning algorithm`

Eg. suppose you have points on a x/y map that can be fit by quadratic data. If you decide to use linear regression here, you will have a high error since you are restricting your model.

_Variance Error_

Error due to variance: error due to the sampling of the `training set`
Model with high variance fits training set closely!

Example: quadratic data.

It may fit the model well - there will be few restrictions but high variance. If you change the training set, the model will change completely.

_Bias/Variance Tradeoff_

```
Low bias = high variance
Low variance = high bias
```

**Overfitting and Underfitting**

`Accuracy` will depend on dataset split (train/test)
High variance will heavily depend on split.

Overfitting = model fits training set a lot better than test set

`The model is too specific`

Underfitting = restricting the model too much

Eg. if you need to decide if email is spam.

Email Training set - exception with 50 capital letters and 30 exclamation marks.
-> capital letters
-> exclamation marks

Our trust set has yes to both of the above data sets are spam and not if no.

An `underfit` model may mark spam if more than 10 capital letters. This is `too general`.

<div id="overfit"></div>

### ---- Overfitting the Spam

```
# The spam filter that has been 'learned' for you
> spam_classifier <- function(x){
    prediction <- rep(NA, length(x)) # initialize prediction vector
    prediction[x > 4] <- 1
    prediction[x >= 3 & x <= 4] <- 0
    prediction[x >= 2.2 & x < 3] <- 1
    prediction[x >= 1.4 & x < 2.2] <- 0
    prediction[x > 1.25 & x < 1.4] <- 1
    prediction[x <= 1.25] <- 0
    return(factor(prediction, levels = c("1", "0"))) # prediction is either 0 or 1
  }
>
# Apply spam_classifier to emails_full: pred_full
> pred_full <- spam_classifier(emails_full$avg_capital_seq)
>
# Build confusion matrix for emails_full: conf_full
> conf_full <- table(emails_full$spam, pred_full)
>
# Calculate the accuracy with conf_full: acc_full
> acc_full <- sum(diag(conf_full))/sum(conf_full)
>
# Print acc_full
> acc_full
[1] 0.6561617
```

This hard-coded classifier gave you an accuracy of around 65% on the full dataset, which is way worse than the 100% you had on the small dataset back in chapter 1. Hence, the classifier does not generalize well at all!

It's official now, the spamClassifier() from chapter 1 is bogus. It simply overfits on the emailsSmall set and, as a result, doesn't generalize to larger datasets such as emailsFull.

So let's try something else. On average, emails with a high frequency of sequential capital letters are spam. What if you simply filtered spam based on one threshold for avgCapitalSeq?

For example, you could filter all emails with avgCapitalSeq > 4 as spam. By doing this, you increase the interpretability of the classifier and restrict its complexity. However, this increases the bias, i.e. the error due to restricting your model.

Your job is to simplify the rules of spamClassifier and calculate the accuracy for the full set emailsFull. Next, compare it to that of the small set emailsSmall, which is coded for you. Does the model generalize now?

```
# The all-knowing classifier that has been learned for you
# You should change the code of the classifier, simplifying it
> spam_classifier <- function(x){
    prediction <- rep(NA, length(x))
    prediction[x > 4] <- 1
    prediction[x <= 4] <- 0
    return(factor(prediction, levels = c("1", "0")))
  }
>
# conf_small and acc_small have been calculated for you
> conf_small <- table(emails_small$spam, spam_classifier(emails_small$avg_capital_seq))
> acc_small <- sum(diag(conf_small)) / sum(conf_small)
> acc_small
[1] 0.7692308
>
# Apply spam_classifier to emails_full and calculate the confusion matrix: conf_full
> conf_full <- table(emails_full$spam, spam_classifier(emails_full$avg_capital_seq))
>
# Calculate acc_full
> acc_full <- sum(diag(conf_full)) / sum(conf_full)
>
# Print acc_full
> acc_full
[1] 0.7259291
```

The model no longer fits the small dataset perfectly but it fits the big dataset better. You increased the bias on the model and caused it to generalize better over the complete dataset. While the first classifier overfits the data, an accuracy of 73% is far from satisfying for a spam filter.

<div id="classification"></div>

---

## Classification

The task of automatically classifying fields given features.

`Observation`: vector of features, with a class.

The classification model will automatically assign a class based on previous observations.

`Binary classification`: Two classes.

`Multiclass classification`: More than two classes.

**Example**

*   a dataset consisting of persons
*   features: age, weight and income
*   class: - binary: happy or not happy - multiclass: happy, satisfied, not happy
*   features can be numerical - height - age
*   features can be categorical - travel class

**Decision Trees**

Suppose you want a patient as sick or not sick (1 or 0).

Best task would be to start asking some questions.

Eg. are they young or old?
If old, have you smoked more than 10 years?
If young, is the patient vaccinated against measles?

These questions will begin to form a tree.

The tree consists of nodes and edges.

The start of the tree is the roots and the ends are the leafs.

There is also a parent-child relation.

The questions on the tree are simply queries about the features.

**Categorical feature**

*   Can be a feature test on itself
*   travelClass: coach, business or first

**Learn a tree**

*   use a training set
*   come up with queries (feature tests) at each node
*   at each node - iterate over different feature tests - choose the best one
*   comes down to two parts - make a list - choose the best one

**Construct list of tests**

*   categorical - people/categories who haven't used the test yet
*   numerical - choose feature - choose threshold for split
*   choose best feature test - more complex - use splitting criteria to decide which is the best to use - `information gain` - entropy

**Information Gain**

Defines how much info you gain about your training instances when you perform the split based on the feature test.

If tests lead to nicely divided classees -> high information gain.
If tests lead to scrambled classes -> low information gain.

Choose the test with the best information gain.

**Pruning**

*   number of nodes influences the chance of overfit.
*   restrict size - higher bias - decreases the chance of an overfit

<div id="classification1"></div>

### ---- Learn a Decision Tree

To test your classification skills, you can build a decision tree that uses a person's age, gender, and travel class to predict whether or not they survived the Titanic. The titanic data frame has already been divided into training and test sets (named train and test).

In this exercise, you'll need train to build a decision tree. You can use the rpart() function of the rpart package for this. Behind the scenes, it performs the steps that Vincent explained in the video: coming up with possible feature tests and building a tree with the best of these tests.

Finally, a fancy plot can help you interpret the tree. You will need the rattle, rpart.plot, and RColorBrewer packages to display this.

```
# The train and test set are loaded into your workspace.
>
# Set random seed. Don't remove this line
> set.seed(1)
>
# Load the rpart, rattle, rpart.plot and RColorBrewer package
> library(rpart)
> library(rattle)
> library(rpart.plot)
> library(RColorBrewer)
>
# Fill in the ___, build a tree model: tree
> tree <- rpart(Survived ~ ., train, method="class")
>
# Draw the decision tree - this in the console generates the decision tree
> fancyRpartPlot(tree)
```

Remember how Vincent told you that a tree is learned by separating the training set step-by-step? In an ideal world, the separations lead to subsets that all have the same class. In reality, however, each division will contain both positive and negative training observations. In this node, 76% of the training instances are positive and 24% are negative. The majority class thus is positive, or 1, which is signaled by the number 1 on top. The 36% bit tells you which percentage of the entire training set passes through this particular node. On each tree level, these percentages thus sum up to 100%. Finally, the Pclass = 1,2 bit specifies the feature test on which this node will be separated next. If the test comes out positive, the left branch is taken; if it's negative, the right branch is taken.

<div id="classification2"></div>

### ---- Classify with the Decision Tree

The previous learning step involved proposing different tests on which to split nodes and then to select the best tests using an appropriate splitting criterion. You were spared from all the implementation hassles that come with that: the rpart() function did all of that for you.

Now you are going to classify the instances that are in the test set. As before, the data frames titanic, train and test are available in your workspace. You'll only want to work with the test set, though.

```
# The train and test set are loaded into your workspace.
>
# Code from previous exercise
> set.seed(1)
> library(rpart)
> tree <- rpart(Survived ~ ., train, method = "class")
>
# Predict the values of the test set: pred
> pred <- predict(tree, test, type="class")
>
# Construct the confusion matrix: conf
> conf <- table(test$Survived, pred)
>
# Print out the accuracy
> sum(diag(conf)) / sum(conf)
[1] 0.7990654
```

Looking good! What does the accuracy tell you? Around 80 percent of all test instances have been classified correctly. That's not bad!

<div id="classification3"></div>

### ---- Pruning the Tree

```
# Calculation of a complex tree
> set.seed(1)
> tree <- rpart(Survived ~ ., train, method = "class", control = rpart.control(cp=0.00001))
>
# Draw the complex tree
> fancyRpartPlot(tree)
>
# Prune the tree: pruned
> pruned <- prune(tree, cp=0.01)
>
# Draw pruned
> fancyRpartPlot(pruned)
```

Another way to check if you overfit your model is by comparing the accuracy on the training set with the accuracy on the test set. You'd see that the difference between those two is smaller for the simpler tree. You can also set the `cp` argument while learning the tree with `rpart()` using `rpart.control`.

### ---- Gini Criterion

`rpart` by default uses the `Gini Criterion` for making decision trees.

```
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Train and test tree with gini criterion
> tree_g <- rpart(spam ~ ., train, method = "class")
> pred_g <- predict(tree_g, test, type = "class")
> conf_g <- table(test$spam, pred_g)
> acc_g <- sum(diag(conf_g)) / sum(conf_g)
>
# Change the first line of code to use information gain as splitting criterion
> tree_i <- rpart(spam ~ ., train, method = "class", parms = list(split = "information"))
> pred_i <- predict(tree_i, test, type = "class")
> conf_i <- table(test$spam, pred_i)
> acc_i <- sum(diag(conf_i)) / sum(conf_i)
>
# Draw a fancy plot of both tree_g and tree_i
> fancyRpartPlot(tree_g)
> fancyRpartPlot(tree_i)
>
>
# Print out acc_g and acc_i
> acc_i
[1] 0.8963768
> acc_g
[1] 0.8905797
```

### ---- k-Nearest Neighbors

Getting acquinted with instance based learning.

*   Save training set in memory
*   No real model like `decision tree`
*   `Compare` unseen instances to training set
*   `Predict` using the `comparison` of `unseen data` and the `training set`

k-Nearest Neighbour example

2 features: x1, x2

*   all have red or blue class - binary classification problem

This will save the complete training set

Given unseen observation with features, it will compare the new features with the old training set. It will find the closest observation and assign the same class.

This is essentially a Euclidian distance measurement.

That is for k = 1.

If k = 5, it will use the 5 most similar observations (neighbours).

Distance metric is important. We can use the standard Euclidian Distance. We can also use the Manhattan distance:

Euclidian Distance: `sqr(sum((a[i]-b[i])**2))`
Manhattan Distance: `sum(abs(a[i] - b[i]))`

### ---- Scaling Example

*   Dataset with
    *   2 features: weight and height
    *   3 observations

1.  Normalize all features - eg rescale values between 0 and 1

*   this gives a better measurement between the distances
*   don't forget to scale the new observations accordingly

2.  Categorical features

*   How to use in distance metric?
*   Use `dummy` variables
*   eg mother tongue: Spanish, Italian or French.
    *   create new features with possible 1 or 0

```
> train_labels <- train$Survived
> test_labels <- test$Survived
>
# Copy train and test to knn_train and knn_test
> knn_train <- train
> knn_test <- test
>
# Drop Survived column for knn_train and knn_test
> knn_train$Survived <- NULL
> knn_test$Survived <- NULL
>
# Normalize Pclass
> min_class <- min(knn_train$Pclass)
> max_class <- max(knn_train$Pclass)
> knn_train$Pclass <- (knn_train$Pclass - min_class) / (max_class - min_class)
> knn_test$Pclass <- (knn_test$Pclass - min_class) / (max_class - min_class)
>
# Normalize Age
> min_age <- min(knn_train$Age)
> max_age <- max(knn_train$Age)
> knn_train$Age <- (knn_train$Age - min_age) / (max_age - min_age)
> knn_test$Age <- (knn_test$Age - min_age) / (max_age - min_age)
```

```
# knn_train, knn_test, train_labels and test_labels are pre-loaded
>
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Load the class package
> library(class)
>
# Fill in the ___, make predictions using knn: pred
> pred <- knn(train = knn_train, test = knn_test, cl = train_labels, k = 5)
>
# Construct the confusion matrix: conf
> conf <- table(test_labels, pred)
>
# Print out the confusion matrix
> conf
           pred
test_labels   1   0
          1  61  24
          0  17 112
```

```
# knn_train, knn_test, train_labels and test_labels are pre-loaded
>
# Set random seed. Don't remove this line.
> set.seed(1)
>
# Load the class package, define range and accs
> library(class)
> range <- 1:round(0.2 * nrow(knn_train))
> accs <- rep(0, length(range))
>
> for (k in range) {

    # Fill in the ___, make predictions using knn: pred
    pred <- knn(train = knn_train, test = knn_test, cl = train_labels, k = k)

    # Fill in the ___, construct the confusion matrix: conf
    conf <- table(test_labels, pred)

    # Fill in the ___, calculate the accuracy and store it in accs[k]
    accs[k] <- sum(diag(conf)/sum(conf))
  }
>
# Plot the accuracies. Title of x-axis is "k".
> plot(range, accs, xlab = "k")
>
# Calculate the best k
> which.max(accs)
[1] 73
```

### ---- Interpreting a Voronoi Diagram

A cool way to visualize how 1-Nearest Neighbor works with two-dimensional features is the Voronoi Diagram. It's basically a plot of all the training instances, together with a set of tiles around the points. This tile represents the region of influence of each point. When you want to classify a new observation, it will receive the class of the tile in which the coordinates fall. Pretty cool, right?

In the plot on the right you can see training instances that belong to either the blue or the red class. Each instance has two features: xx and yy. The top left instance, for example, has an xx value of around 0.05 and a yy value of 0.9.
