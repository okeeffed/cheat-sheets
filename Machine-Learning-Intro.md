# Intro to Machine Learning

## Table of Contents

<a href="#section">title</a>
---- <a href="#subsection">title</a>

<div id="section"></div>

***

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

***

## Classification, Regression, Clustering

These are the three common types of ML Problems.

__Classification__

Predicting category through historical classifying.

`Earlier Observations` -> _estimate_ -> `CLASSIFIER`

`Unseen Data` -> _CLASSIFIER_ -> `Class`

Application: Medical Diagnosis, Animal Recognition

Important: Qualitative Output, Predefined Classes

__Regression__

We are trying to estimate a function that will render the correct response.

Eg. knowing height and weight, is there a relationship? Is it linear? Can we predict a height given a weight?

`PREDICTORS` -> _Regression Function_ -> `RESPONSE`

Application: Modelling Payments for Credit Scores, YouTube Subscriptions over time, Job dependent on Grades.

Important: Quantitative Output, previous input-output observations

__Clustering__

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

__Performance of the model__

- Supervised learning
	- `Compare` real labels with `predicted` labels
- Unsupervised Learning
	- No real labels to compare
	- Techniques will be explained later down the track
	- Things aren't always black and white
- Semi-Supervised Learning
	- Mixed of unlabeled and labeled observationed
	- Eg clustering information and classes of labeled observations to assign a class to unlabeled observations
	- More labeled observations for `supervised learning`

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










































